<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dropdown extends Component
{
    /**
     * Alignment dropdown.
     */
    public string $align;

    /**
     * Width dropdown.
     */
    public string $width;

    public function __construct(
        string $align = 'right',
        string $width = '56'
    ) {
        $this->align = $align;
        $this->width = $width;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.dropdown');
    }
}