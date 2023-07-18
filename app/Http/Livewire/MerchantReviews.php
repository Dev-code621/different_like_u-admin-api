<?php

namespace App\Http\Livewire;

use App\Business;
use App\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MerchantReviews extends Component
{
    public $reviews;
    public $sort;
    public $listeners = ['refreshReviews' => '$refresh'];

    public function updated()
    {
        $userBusiness = Business::where('user_id', Auth::id())->first()->id;
        $this->reviews = Review::with('user')->where('business_id', $userBusiness)->orderBy('created_at', 'desc')->get();
        if ($this->sort === 'asc') {
            $this->reviews = Review::with('user')->where('business_id', $userBusiness)->orderBy('created_at', 'asc')->get();
        } else if ($this->sort === 'desc')
        {
            $this->reviews = Review::with('user')->where('business_id', $userBusiness)->orderBy('created_at', 'desc')->get();
        }
    }

    public function mount()
    {
        $userBusiness = Business::where('user_id', Auth::id())->first()->id;
        $this->reviews = Review::with('user')->where('business_id', $userBusiness)->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {

        return view('livewire.merchant-reviews');
    }
}
