<?php

namespace App\Http\Livewire;

use App\Business;
use App\BusinessProof;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class MerchantClaim extends Component
{
    use WithFileUploads;

    // protected $listeners = ['open' => 'loadGalaxy'];


    public $photo, $photoUrl, $email, $phone, $imageWidth, $imageHeight, $imageSize, $fileName, $search, $selectedPlace, $searchResults = [], $proof, $business, $error=false, $files;


    public function mount()
    {
        if (isset($this->search)) {
            $this->searchResults = Http::get('https://maps.googleapis.com/maps/api/place/textsearch/json', [
                'query' => $this->search,
                'key' => env('ADDRESS_AUTOCOMPLETE_API_KEY', SECRET_MANAGER_DATA['ADDRESS_AUTOCOMPLETE_API_KEY']??'')
            ])->json()['results'];
        }
        clock($this->searchResults);

        $this->proof = BusinessProof::where('user_id', Auth::user()->id)->first();
        if ($this->proof) {
            $this->business = Business::where('id', $this->proof->business_id)->first();

            $imageName=explode("/",$this->proof->image);
            $this->search = $this->business->name;
            $this->photoUrl = Storage::disk('s3')->temporaryUrl($this->proof->image, now()->addMinutes(10));
            $this->imageSize = Storage::disk('s3')->size($this->proof->image)/1000;
            $this->email = $this->proof->email;
            $this->phone = $this->proof->phone;
            $this->fileName = end($imageName);
        }
    }

    public function addPlace($place)
    {
        $this->selectedPlace = $this->searchResults[$place];
        clock($this->selectedPlace);
    }

    protected $rules = [
        'search' => 'required',
        'phone' => 'required|numeric|digits_between:10,12',
        'email' => 'required|email',
        'photo' => 'required|image|max:1024'
    ];

    public function updatedFiles()
    {
        clock($this->files[0]);
        $this->photo =  $this->files[0];
        $this->imageSize = $this->photo->getSize() / 1000;
        $this->fileName = $this->photo->getFilename();
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024',
        ]);
        $this->imageSize = $this->photo->getSize() / 1000;
        $this->fileName = $this->photo->getFilename();
        $this->photoUrl = null;
    }


    public function deleteImage()
    {
        $this->photo = null;
        $this->files = null;
        $this->photoUrl = null;
    }


    public function validateForm()
    {
        $business = Business::where('user_id', Auth::id())->first();
        $place='';
        if(isset($business) && $business->claimed == 'Unclaimed'){
            $place = Business::where([
                ['google_id', '=', $business->google_id],
                ['claimed', '=', 'Accepted']
            ])->get();
            if($place->count() > 0){
                session()->flash('error-message', 'Business is already link with other merchant. Please check if you have selected correct business or  contact us for futher assistance.');
                return false;
            }
        }

        if(!$this->proof && !$this->photo) {
            $this->addError('photo', 'Business Proof is required');
        } else {
            $validatedData = $this->validate();
        }

        if(isset($this->proof) || !empty($this->proof)){
            $this->dispatchBrowserEvent('claimModal');
            $this->emit('claimModal');
        }
    }

    public function submitData()
    {
        $business = Business::where('user_id', Auth::id())->first();

        $business = new Business();
        if (!$this->proof) {
            $claimRequest = new BusinessProof();
        } else {
            $claimRequest = $this->proof;
        }

        if (!empty($this->selectedPlace)) {
            $businessData=Business::where('google_id', $this->selectedPlace['place_id'])->first();
            if(!isset($businessData) || empty($businessData)){
                $business_hours = '';
                if(isset($this->selectedPlace["opening_hours"])){
                    $placeData = $this->placeDetail($this->selectedPlace["place_id"]);
                    $business_hours = json_encode($placeData['opening_hours']['weekday_text']);
                }
                $business->google_id = $this->selectedPlace['place_id'];
                $business->name = $this->selectedPlace['name'];
                $business->about = $this->selectedPlace['name'];
                $business->image = null;
                if (isset($this->selectedPlace['photos'])){
                    $business->image = 'https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photo_reference=' . $this->selectedPlace['photos'][0]['photo_reference'] . '&key=' . env('ADDRESS_AUTOCOMPLETE_API_KEY', SECRET_MANAGER_DATA['ADDRESS_AUTOCOMPLETE_API_KEY']??'') ?? null;
                    clock($this->selectedPlace['photos']);
                }
                $business->links = $this->selectedPlace['website'] ?? null;
                $business->other_link = '';
                $business->claimed = 'Unclaimed';
                $business->default_address = $this->selectedPlace['formatted_address'];
                $business->latitude = $this->selectedPlace['geometry']['location']['lat'] ?? 'x';
                $business->longitude = $this->selectedPlace['geometry']['location']['lng'] ?? 'y';
                $business->types = implode(',', $this->selectedPlace['types']);
                $business->international_phone_number = $this->phone ?? $this->selectedPlace['formatted_phone_number'];
                $business->url = '';
                $business->website = $this->selectedPlace['website'] ?? null;
                $business->opening_hours = $business_hours;
                $business->save();

                //claim request
                $claimRequest->business()->associate($business->id);
                $claimRequest->request_status = 'Pending';
                $claimRequest->email = $this->email;
                $claimRequest->phone = $this->phone ?? $this->selectedPlace['formatted_phone_number'];
                $claimRequest->user_id = Auth::user()->id;
                if(!empty($this->photo)){
                    $claimRequest->image = $this->photo->store('photos', 's3');
                }
                else{
                    $claimRequest->image = $claimRequest['image'];
                }
                $claimRequest->save();

            }
            elseif(!empty($businessData)){
                if($businessData['claimed'] == 'Accepted'){
                    session()->flash('error-message', 'Business is already link with other merchant. Please check if you have selected correct business or  contact us for futher assistance.');
                    return false;
                }
                else{
                    $claimRequest->business()->associate($businessData->id);
                    $claimRequest->request_status = 'Pending';
                    $claimRequest->email = $this->email;
                    $claimRequest->phone = $this->phone ?? $this->selectedPlace['formatted_phone_number'];
                    $claimRequest->user_id = Auth::user()->id;
                    if(!empty($this->photo)){
                        $claimRequest->image = $this->photo->store('photos', 's3');
                    }
                    else{
                        $claimRequest->image = $claimRequest['image'];
                    }
                    $claimRequest->save();
                }
            }
            return redirect()->to('/merchant-dash/home');
        }

        elseif(($this->email || $this->phone) && $this->proof){
            $data['email'] = $this->email;
            $data['phone'] = $this->phone;
            $data['request_status'] = 'Pending';
            BusinessProof::where('user_id', Auth::user()->id)->update($data);
            session()->flash('message', 'Information saved successfully.');
        }

        if ($this->photo && $this->proof && empty($this->selectedPlace)) {
            $businessClaim = $this->proof;
            $businessClaim->update(['image' => $this->photo->store('photos', 's3')]);
            session()->flash('message', 'Information saved successfully.');
        }
        return redirect()->to('/merchant-dash/home');
    }

    public function submitNewData()
    {
        $this->validate();
        $this->validateForm();
        $this->submitData();
    }

    public function render()
    {
        if (isset($this->search)) {
            $this->searchResults = Http::get('https://maps.googleapis.com/maps/api/place/textsearch/json', [
                'query' => $this->search,
                'key' => env('ADDRESS_AUTOCOMPLETE_API_KEY', SECRET_MANAGER_DATA['ADDRESS_AUTOCOMPLETE_API_KEY']??'')
            ])->json()['results'];
        }

        return view('livewire.merchant-claim',
            [
                'places' => collect($this->searchResults)->take(7),
            ]);
    }

    public function placeDetail($placeId)
    {
        $placeData=Http::get('https://maps.googleapis.com/maps/api/place/details/json', [
                'place_id' => $this->selectedPlace["place_id"],
                'key' => env('ADDRESS_AUTOCOMPLETE_API_KEY', SECRET_MANAGER_DATA['ADDRESS_AUTOCOMPLETE_API_KEY']??'')
            ])->json()['result'];
        return $placeData;
    }
}