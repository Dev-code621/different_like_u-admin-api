<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Business;
use Illuminate\Support\Facades\Auth;

class AccountSetting extends Component
{
    public $claimStatus;
    public $business;
    public $toggle;
    public $field;
    public $status;
    public $disable;

    protected $listeners = [
             'set:ToggleValue' => 'getToggleValue'
        ];

    public function render()
    {
        $this->status = '';
        $this->disable = '';
        $this->business = Business::where('user_id', Auth::id())->first();
        if(!empty($this->business)){
            $this->claimStatus = $this->business->claimed;
            if($this->claimStatus == 'Accepted'){
                if($this->business->email_notification == 1){
                    $this->status = 'checked';
                }
                else{
                    $this->status = '';
                }
            }
            else{
                $this->disable = 'disabled';
            }
        }
        else{
            $this->disable = 'disabled';
        }
        return view('livewire.account-setting');
    }

    public function getToggleValue($value)
    {
        $this->status = $value;

        $update = Business::where('user_id', Auth::id())
                    ->update(['email_notification' => $value]);
        $this->dispatchBrowserEvent('enableToggle');

    }
}
