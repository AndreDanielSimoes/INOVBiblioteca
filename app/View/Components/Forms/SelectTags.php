<?php

namespace App\View\Components\Forms;

use App\Models\Tag;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class SelectTags extends Component
{
    public $tags;

    public function __construct()
    {
        $this->tags = Tag::orderBy('name')->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.forms.select-tags');
    }
}
