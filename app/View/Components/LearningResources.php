<?php

namespace App\View\Components;

use App\Post;
use Illuminate\View\Component;

class LearningResources extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $posts = Post::where('status', 'PUBLISHED')->with('user')->limit(2)->get();
        return view('components.learning-resources', ['posts' => $posts]);
    }
}
