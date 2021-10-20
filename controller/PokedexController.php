<?php

class PokedexController{

    private $printer;
    private PokedexModel $model;

    public function __construct($printer, $model) {
        $this->printer = $printer;
        $this->model = $model;
    }

    public function show() {
        $data = $this->model->getPokemons();

        echo $this->printer->render( "view/pokedexView.html", $data);
    }

    public function search() {
        $search = $_POST["search"] ?? "";

        $data = $this->model->search($search);

        echo $this->printer->render( "view/pokedexView.html", $data);
    }
}