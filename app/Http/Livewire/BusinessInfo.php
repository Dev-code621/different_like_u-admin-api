<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Business;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helper;

class BusinessInfo extends Component
{

    use WithFileUploads;
    // use Helper;

    public $file;

    /** @var string */
    public $business_name = '';

    /** @var string */
    public $about = '';

    /** @var string */
    public $link_one = '';

    /** @var string */
    public $link_two = '';

    public function mount()
    {
        $data = Business::where('user_id', Auth::user()->id)->firstOrFail();
        $this->about = $data->about;
        $this->link_one = $data->links;
        $this->link_two = $data->other_link;
        $this->business_name = $data->name;
        if (strpos($data->image, 'googleapis') !== false) {
            $this->image = $data->image;
        }
        else{
            $this->image = Helper::getPrivateBucket($data->image);
        }
    }

    public function render()
    {
        return view('livewire.business-info-edit');
    }

    public function updatedFile()
    {
        if(gettype($this->file) == 'array'){
            $this->file = $this->file[0];
        }

        $this->validate([
            'file' => 'image|max:1024', // 1MB Max
        ]);
    }

    public function save()
    {
        if(!empty($this->file)){
            $data['image'] = $this->file->store('cover', 's3');
        }
        $data['about'] = $this->about;
        $data['links'] = $this->link_one;
        $data['other_link'] = $this->link_two;

        $user = Business::where('user_id', Auth::user()->id)->update($data);

        session()->flash('message', 'Business information successfully updated.');
    }
}
