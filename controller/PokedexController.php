<?php

class PokedexController{

    private $printer;

    public function __construct($printer)
    {
        $this->printer = $printer;
    }

    public function show()
    {
        echo $this->printer->render( "view/pokedexView.html");
    }
}