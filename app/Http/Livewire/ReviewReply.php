<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ReviewReply extends Component
{
    public $reply;
    public $review;
    public function render()
    {
        return view('livewire.review-reply');
    }
}
