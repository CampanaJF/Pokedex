<?php

class PokedexController{

    private MustachePrinter $printer;
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

        $data = $this->model->getPokemonById($id);

        echo $this->printer->render ("view/pokemonDescripcion.html", $data);
    }

    public function nuevo() {
        echo $this->printer->render ("view/nuevoPokemon.html");
    }

    public function agregar(){
        $nombre= $_POST["nombrePokemon"] ;
        $numero= $_POST["numPokemon"];
        $tipo= "acero.jpeg";$_POST["tipo"];
        $tipo2= "acero.jpeg";$_POST["tipo2"];
        $descripcion=$_POST["descripcion"];

        $file = $_FILES["imagen"];
        if (isset($file)) {
            if ($file["error"] > 0) {
                die("Error: " . $file["error"] . "<br>");
            } else {
                $info = pathinfo($file["name"]);
                $name = $_POST["nombrePokemon"] ."." .$info["extension"];

                if (move_uploaded_file($file["tmp_name"], "public/img/" . $name)) {
                    $this->model->nuevo($nombre, $numero, $tipo, $tipo2, $descripcion, $nombre);

                    header("location: /pokedex/");
                } else {
                    die("Error al intentar guardar el archivo");
                }

            }
        }
    }

}