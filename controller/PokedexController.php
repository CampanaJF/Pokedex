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

    public function descripcion(){
        $id= $_GET["id"] ;

        $data = $this->model->getPokemonById ($id);

      echo $this->printer->render ("view/pokemonDescripcion.html", $data);

    }
    public function nuevo(){

        echo $this->printer->render ("view/nuevoPokemon.html");
    }

    public function agregar(){

        $nombre= $_POST["nombrePokemon"] ;
        $numero= $_POST["numPokemon"];
        $tipo= $_POST["tipo"];
        $tipo2= $_POST["tipo2"];
        $descripcion=$_POST["descripcion"];

        if ($_FILES ["imagen"]["error"] > 0){

            echo "el archivo no se subio";

        } else {
            move_uploaded_file($_FILES["imagen"]["tmp_name"], "/public/img/". $nombre . ".png");
        }

        $this->model->nuevo($nombre, $numero,$tipo,$tipo2,$descripcion,$nombre. ".png");

        header("location:/pokedex");

    }

}