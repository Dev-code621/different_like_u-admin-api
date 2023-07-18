<?php

namespace App\Http\Livewire;

use App\Business;
use App\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MerchantReviewsCompact extends Component
{
    public $claimStatus;
    public $reason;
    public function mount()
    {
        $userBusiness = Business::where('user_id', Auth::id())->first();
        if ($userBusiness) {
            $userBusinessId = $userBusiness->id;
            $this->reviews = Review::with('user')->where('business_id', $userBusinessId)->orderBy('created_at', 'desc')->get();
        }
    }

    public function render()
    {
        return view('livewire.merchant-reviews-compact');
    }
}
