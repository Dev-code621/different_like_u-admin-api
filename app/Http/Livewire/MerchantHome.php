<?php

namespace App\Http\Livewire;

use App\Business;
use App\BusinessProof;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MerchantHome extends Component
{
    public $claimStatus;
    public $reason;

    public function mount()
    {
        if (BusinessProof::where('user_id', Auth::id())) {
            $businessProof = BusinessProof::where('user_id', Auth::id())->first();
        }
        if (!isset($businessProof)) {
            $this->claimStatus = 'Unclaimed';
            clock('test');
        } else if ($businessProof->request_status) {
            $this->claimStatus = $businessProof->request_status;
            $this->reason = $businessProof->reject_reason;
            if($this->claimStatus == 'Rejected'){
                $place = Business::where([
                    ['id', '=', $businessProof->business_id],
                    ['claimed', '=', 'Accepted']
                ])->get();
                if($place->count() > 0){
                    $this->reason = 'Business is already link with other merchant. Please contact us for futher assistance.';
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.merchant-home');
    }
}
