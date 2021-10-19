<?php

class PokedexController{

    private $printer;
    private PokedexModel $model;

    public function __construct($printer, $model) {
        $this->printer = $printer;
        $this->model = $model;
    }

    public function show() {
        $data["pokemons"] = $this->model->getPokemons();

        /*foreach ($respond as $r) {
            $a = [
                "numero" => $r["numero"],
                "nombre" => $r["nombre"],
                "tipo1" => $r["tipo1"],
                "tipo2" => $r["tipo2"],
            ];

            array_push($data, $a);
        }*/

        echo $this->printer->render( "view/pokedexView.html", $data);
    }
}