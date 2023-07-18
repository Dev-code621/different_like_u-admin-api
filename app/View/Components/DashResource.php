<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashResource extends Component
{
    public $header;
    public $subhead;
    public $link;
    public $disabled;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($header, $subhead, $link, $disabled)
    {
        $this->header = $header;
        $this->subhead = $subhead;
        $this->link = $link;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dash-resource');
    }
}
