<?php

namespace App\View\Components;

use App\Models\File;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BookCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public File $file)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.book-card');
    }
}
