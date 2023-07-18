<?php

namespace App\Http\Livewire;

use App\FlaggedContent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ContentFlag extends Component
{
    public $review;
    public $reply;
    public $flagged;
    public $flaggedReasons = [
        'Racist language',
        'Harassment or bullying',
        'Spam',
        'Sexist slurs',
        'Hate speech or symbols',
        'Nudity or Pornography',
        'Violence or threat of violence',
        'Self injury',
        'Sale or promotion of firearms',
        'Sale or promotion of drugs',
        'Fraud / Fake Information',
        'Vulgarity / Foul language',
        'Inappropriate Photo',
    ];
    public function flag($reason)
    {
        if (isset($this->review)) {
            $flaggedContent = new FlaggedContent();
            $flaggedContent->user_id = Auth::user()->id;
            $flaggedContent->business_id = $this->review->business_id;
            $flaggedContent->type = 'REVIEW';
            $flaggedContent->status = 'PENDING';
            $flaggedContent->review_id = $this->review->id;
            $flaggedContent->reason = $reason;
            $flaggedContent->save();
        } else if (isset($this->reply)) {
            $flaggedContent = new FlaggedContent();
            $flaggedContent->user_id = Auth::user()->id;
            $flaggedContent->business_id = $this->reply->review->business_id;
            $flaggedContent->type = 'REVIEW';
            $flaggedContent->status = 'PENDING';
            $flaggedContent->review_id = $this->reply->review->id;
            $flaggedContent->reply_id = $this->reply->id;
            $flaggedContent->reason = $reason;
            $flaggedContent->save();
        }
        if (isset($this->review)) {
            $this->flagged = FlaggedContent::where('review_id', $this->review->id)->exists();
        } else if (isset($this->reply)) {
            $this->flagged = FlaggedContent::where('reply_id', $this->reply->id)->exists();
        }

    }
    public function mount()
    {
        if (isset($this->review)) {
            $this->flagged = FlaggedContent::where('review_id', $this->review->id)->exists();
        } else if (isset($this->reply)) {
            $this->flagged = FlaggedContent::where('reply_id', $this->reply->id)->exists();
        }
    }

    public function render()
    {
        return view('livewire.content-flag');
    }
}
