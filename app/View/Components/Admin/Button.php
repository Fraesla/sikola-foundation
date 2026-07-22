<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public string $variant;

    public string $size;

    public bool $loading;

    public string $type;

    public function __construct(
        string $variant = 'primary',
        string $size = 'md',
        bool $loading = false,
        string $type = 'button'
    ) {
        $this->variant = $variant;
        $this->size = $size;
        $this->loading = $loading;
        $this->type = $type;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.button');
    }
}