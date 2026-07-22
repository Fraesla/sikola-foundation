<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Judul card.
     */
    public ?string $title;

    /**
     * Subtitle.
     */
    public ?string $subtitle;

    /**
     * Icon FontAwesome.
     */
    public ?string $icon;

    /**
     * Warna header.
     */
    public string $color;

    public function __construct(
        ?string $title = null,
        ?string $subtitle = null,
        ?string $icon = null,
        string $color = 'blue'
    ) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->icon = $icon;
        $this->color = $color;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.card');
    }
}