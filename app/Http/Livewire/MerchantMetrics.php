<?php

namespace App\Http\Livewire;

use App\Business;
use App\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MerchantMetrics extends Component
{

    public $reviews;
    public $reviewHigh = 0;
    public $reviewLow = 0;
    public $inclusivityScore;

    public function mount()
    {
        $userBusiness = Business::where('user_id', Auth::id())->first();

        if ($userBusiness) {
            $userBusinessId = $userBusiness->id;
            $this->reviews = Review::where('business_id', $userBusinessId)->orderBy('created_at', 'desc')->get();
            $this->reviewHigh = $this->reviews->where('overall_score', '>', 3)->count();
            $this->reviewLow = $this->reviews->where('overall_score', '<', 3)->count();
            $this->inclusivityScore = $this->reviews->avg('inclusive_score');
        }
    }

    public function render()
    {
        return view('livewire.merchant-metrics');
    }
}
