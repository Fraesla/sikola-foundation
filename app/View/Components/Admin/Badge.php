<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    /**
     * Nilai badge.
     */
    public string $value;

    /**
     * Uppercase / Capitalize.
     */
    public bool $capitalize;

    public function __construct(
        string $value,
        bool $capitalize = true
    ) {
        $this->value = $value;
        $this->capitalize = $capitalize;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.badge');
    }
}