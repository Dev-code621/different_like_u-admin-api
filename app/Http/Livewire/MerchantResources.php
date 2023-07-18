<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\TrainingResource;
use App\Post;
use Illuminate\Support\Facades\Storage;

class MerchantResources extends Component
{

    public $filter = [
        "category" => "",
    ];
    public $posts = [];

    public $activeClass = '';
    public $oldCatName = '';

    public function render()
    {
        return view('livewire.merchant-resources');
    }

    public function mount()
    {
        $this->trainingData = TrainingResource::all();
        $this->loadList($categoryName = null);
    }

    public function loadList($categoryName)
    {
        if ($this->oldCatName == $categoryName) {
            $categoryName = "";
            $this->oldCatName = "";
        } elseif (empty($this->oldCatName)) {
            $this->oldCatName = $categoryName;
        }
        if (!empty($categoryName)) {
            $objects = Post::where('status', 'PUBLISHED')->with('user')->where('category', $categoryName)->get();
        } else {
            $objects = Post::where('status', 'PUBLISHED')->with('user')->get();
        }
        $this->posts = $objects;
    }
}
