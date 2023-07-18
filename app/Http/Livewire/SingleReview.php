<?php

namespace App\Http\Livewire;

use App\Reply;
use App\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SingleReview extends Component
{
    public $review;
    public $reviewDate;
    public $canReply;
    public $replies  = [];
    public $reviewExp;
    public $reviewReply;

    protected $rules = [
        'reviewReply' => 'min:6',
    ];

    public function mount()
    {
        $now = Carbon::now();
        $this->reviewDate = Carbon::parse($this->review->created_at);
        $this->reviewExp = Carbon::parse($this->review->created_at)->addHours(48);
        $this->replies = $this->review->reply->sortBy('created_at');
        $this->canReply = $this->review->overall_score < 3 && $this->review->created_at->diffInMinutes($now) <= 2880 && $this->review->reply->count() === 0;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function postReply()
    {
        $reply = new Reply;
        $reply->comment = $this->reviewReply;
        $reply->review_id = $this->review->id;
        $reply->type = 'MERCHANT_REPLY';
        $reply->status = 'PUBLISHED';
        $reply->user_id = Auth::id();
        $this->review->reply()->save($reply);
        $review = Review::find($this->review->id);
        $this->replies = $review->reply;
        $now = Carbon::now();
        $this->canReply = $review->overall_score < 3 && $review->created_at->diffInMinutes($now) <= 2880 && $review->reply->count() === 0;
        $this->emitUp('refreshReviews');
    }



    public function render()
    {

        return view('livewire.single-review');
    }
}
