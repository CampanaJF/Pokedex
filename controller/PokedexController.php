<?php

class PokedexController{

    private MustachePrinter $printer;
    private PokedexModel $model;

    public function __construct($printer, $model) {
        $this->printer = $printer;
        $this->model = $model;
    }

    public function show() {

        if(isset($_POST["logout"])){
            session_unset();
        }
        $data  = $this->model->getPokemons();
    //    $data ["logged"]  = $_SESSION["role"]!=null;
    //    $data ["notLogged"]  = $_SESSION["role"]==null;
        

       $data  = array_merge($data,$this->model->loginCheck());

        echo $this->printer->render( "view/pokedexView.html", $data);
    }

    public function search() {
        $search = $_POST["search"] ?? "";

        $data = $this->model->search($search);
        $data += $this->model->loginCheck();

        echo $this->printer->render( "view/pokedexView.html", $data);
    }

    public function descripcion(){
        $id= $_GET["id"] ;

        $data = $this->model->getPokemonById($id);

        echo $this->printer->render ("view/pokemonDescripcion.html", $data);
    }

    public function nuevo() {
        $data = $this->model->getTiposData();
        echo $this->printer->render ("view/nuevoPokemon.html", $data);
    }

    public function agregar(){
        $nombre = $_POST["nombre"];

        if (!isset($nombre)) {
            die("El campo nombre debe estar completo");
        }

        $numero = $_POST["numero"];

        if (!isset($numero) || !is_int(intval($numero))) {
            die("El campo número no es válido");
        }

        $tipo1 = $_POST["tipo1"];

        if (!isset($tipo1) || !is_int(intval($tipo1)) || !$this->model->checkTipoId($tipo1)) {
            die("El tipo 1 no es válido");
        }

        $tipo2 = $_POST["tipo2"];

        if (!isset($tipo2) || $tipo2 == $tipo1) {
            die("El tipo 2 no es válido");
        } else {
            if (empty($tipo2)) {
                $tipo2 = "NULL";
            } else {
                if (!is_int(intval($tipo2)) || !$this->model->checkTipoId($tipo2)) {
                    die("El tipo 2 no es válido");
                }
            }
        }

        $descripcion = $_POST["descripcion"];

        if (!isset($descripcion)) {
            die("La descripción 2 no es válida");
        }

        $file = $_FILES["imagen"];
        if (isset($file)) {
            if ($file["error"] > 0) {
                die("Error: " . $file["error"]);
            } else {
                $info = pathinfo($file["name"]);
                $nombre_imagen = $_POST["nombre"] ."." .$info["extension"];

                if (move_uploaded_file($file["tmp_name"], "public/img/" . $nombre_imagen)) {
                    $this->model->nuevo($nombre, $numero, $tipo1, $tipo2, $descripcion, $nombre_imagen);

                    header("location: /pokedex/");
                } else {
                    die("Error al intentar guardar el archivo");
                }

            }
        }
    }

    public function editarPokemon() {
        $id = $_GET["id"];

        $data = $this->model->getPokemonById($id);
        $data += $this->model->getTiposData();

        echo $this->printer->render ("view/editarPokemon.html", $data);
    }

    public function editar() {
        $id = $_POST["id"];

        if (!isset($id) || !is_int(intval($id))) {
            die("Algo salió mal");
        }

        $nombre = $_POST["nombre"];

        if (!isset($nombre)) {
            die("El campo nombre debe estar completo");
        }

        $numero = $_POST["numero"];

        if (!isset($numero) || !is_int(intval($numero))) {
            die("El campo número no es válido");
        }

        $tipo1 = $_POST["tipo1"];

        if (!isset($tipo1) || !is_int(intval($tipo1)) || !$this->model->checkTipoId($tipo1)) {
            die("El tipo 1 no es válido");
        }

        $tipo2 = $_POST["tipo2"];

        if (!isset($tipo2) || $tipo2 == $tipo1) {
            die("El tipo 2 no es válido");
        } else {
            if (empty($tipo2)) {
                $tipo2 = "NULL";
            } else {
                if (!is_int(intval($tipo2)) || !$this->model->checkTipoId($tipo2)) {
                    die("El tipo 2 no es válido");
                }
            }
        }

        $descripcion = $_POST["descripcion"];

        if (!isset($descripcion)) {
            die("La descripción 2 no es válida");
        }

        $file = $_FILES["imagen"];

        if ($file["error"] == 0) {
            $info = pathinfo($file["name"]);
            $nombre_imagen = $_POST["nombre"] ."." .$info["extension"];

            if (move_uploaded_file($file["tmp_name"], "public/img/" . $nombre_imagen)) {
                $this->model->editar($id, $nombre, $numero, $tipo1, $tipo2, $descripcion, $nombre_imagen);

                header("location: /pokedex/");
            } else {
                die("Error al intentar guardar el archivo");
            }
        } else  {
            $this->model->editar($id, $nombre, $numero, $tipo1, $tipo2, $descripcion);
        }
    }

    public function eliminarPokemon() {
        $id = $_GET["id"];

        $this->model->eliminar($id);
        header("location: /");
    }
}