<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardLibro extends Component
{
    public $titulo;
    public $subtitulo;
    public $imagen;
    public $link;
    public $alt;
    
    public function __construct($titulo, $subtitulo, $imagen, $link, $alt)
    {
        $this->titulo = $titulo;
        $this->subtitulo = $subtitulo;
        $this->imagen = $imagen;
        $this->link = $link;
        $this-> alt = $alt;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-libro');
    }
}