<?php

namespace App\Http\Livewire;

use App\Like;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ContentLike extends Component
{
    public $review;
    public $reply;
    public $likeCount;
    public $userLiked;

    public function like()
    {
        if (isset($this->review)) {
            $like = new Like();
            $like->user_id = Auth::user()->id;
            $like->review_id = $this->review->id;
            $like->save();
        } else if (isset($this->reply)) {
            $like = new Like();
            $like->user_id = Auth::user()->id;
            $like->review_id = $this->reply->review->id;
            $like->reply_id = $this->reply->id;
            $like->save();
        }
        if (isset($this->review)) {
            $contentLikes = Like::where('review_id', $this->review->id)->get();
            $this->likeCount = $contentLikes->count();
        } else if (isset($this->reply)) {
            $contentLikes =  Like::where('reply_id', $this->reply->id)->get();
            $this->likeCount = $contentLikes->count();
        }
        $this->userLiked = $contentLikes->where('user_id',  Auth::user()->id)->count();
    }
    public function mount()
    {
        if (isset($this->review)) {
            $contentLikes = Like::where('review_id', $this->review->id)->get();
            $this->likeCount = $contentLikes->count();
        } else if (isset($this->reply)) {
            $contentLikes =  Like::where('reply_id', $this->reply->id)->get();
            $this->likeCount = $contentLikes->count();
        }
        $this->userLiked = $contentLikes->where('user_id',  Auth::user()->id)->count();
    }
    public function render()
    {
        return view('livewire.content-like');
    }
}
