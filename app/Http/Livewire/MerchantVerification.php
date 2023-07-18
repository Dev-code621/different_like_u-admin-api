<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MerchantVerification extends Component
{
    public $emailSuccess = false;

    public function render()
    {
        return view('livewire.merchant-verification');
    }

    public function email()
    {
        return $this->emailSuccess = true;
    }
}
