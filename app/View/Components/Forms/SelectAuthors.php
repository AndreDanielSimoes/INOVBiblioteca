<?php

namespace App\View\Components\Forms;

use Closure;
use App\Models\Author;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class SelectAuthors extends Component
{
    public $authors;

    public function __construct()
    {
        $this->authors = Author::orderBy('name')->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.forms.select-authors');
    }
}
