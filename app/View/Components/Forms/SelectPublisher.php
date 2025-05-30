<?php

namespace App\View\Components\Forms;

use Closure;
use App\Models\Publisher;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class SelectPublisher extends Component
{
    public $publishers;

    public function __construct()
    {
        $this->publishers = Publisher::orderBy('name')->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.forms.select-publisher');
    }
}

