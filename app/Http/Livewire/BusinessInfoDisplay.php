<?php

namespace App\Http\Livewire;

use App\Business;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BusinessInfoDisplay extends Component
{
    public $business;
    public $opening_hours;
    public function mount() {
        $this->business = Business::where('user_id', Auth::id())->first();
        $this->opening_hours = json_decode($this->business->opening_hours);
    }
    public function render()
    {
        return view('livewire.business-info-display');
    }
}
