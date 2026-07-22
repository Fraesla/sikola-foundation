<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public string $name;

    public string $title;

    public string $maxWidth;

    public function __construct(
        string $name,
        string $title = '',
        string $maxWidth = '2xl'
    ) {
        $this->name = $name;
        $this->title = $title;
        $this->maxWidth = $maxWidth;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.modal');
    }
}