<?php

class PokedexModel {
    private MyDatabase $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getPokemons(): array {
        $query = "SELECT p.id, numero, nombre, t1.imagen as tipo1, t2.imagen as tipo2 FROM pokemon p "
                . "JOIN tipo t1 ON p.tipo1 = t1.id "
                . "LEFT JOIN tipo t2 on p.tipo2 = t2.id "
                . "ORDER BY numero";

        $response = $this->database->query($query);

        $data["pokemons"] = $response;

        return $data;
    }

    public function search($search): array {
        $query = "SELECT p.id, numero, nombre, t1.imagen as tipo1, t2.imagen as tipo2 FROM pokemon p"
                . " JOIN tipo t1 ON p.tipo1 = t1.id"
                . " LEFT JOIN tipo t2 on p.tipo2 = t2.id"
                . " WHERE nombre LIKE '%" .$search
                . "%' OR numero LIKE  '%" .$search. "%' OR tipo1 LIKE '%" .$search
                . "%' OR tipo2 LIKE '%" .$search. "%' ORDER BY numero";

        $response = $this->database->query($query);

        $data[] = [];

        if (empty($response)) {
            $data["error"] = true;
            $data = array_merge($data, $this->getPokemons());
        } else {
            $data["pokemons"] = $response;
        }

        return $data;
    }

    public function getPokemonById2($id): array {
        $query = "SELECT * FROM pokemon "
            . "WHERE id = $id";


        return $this->database->query($query)[0];
    }

    public function getPokemonById($id): array {
        $query = "SELECT p.id, numero, nombre, t1.id as tipo1Id, t1.imagen as tipo1, t2.id as tipo2Id, t2.imagen as tipo2, p.imagen, descripcion FROM pokemon p "
                . "JOIN tipo t1 ON p.tipo1 = t1.id "
                . "LEFT JOIN tipo t2 on p.tipo2 = t2.id "
                . "WHERE p.id = '" .$id. "' "
                . "ORDER BY numero";

        $response = $this->database->query($query);

        if (!empty($response)){
            $data["pokemon"] = $response[0];
        } else {
            $data["pokemon"] = [];
        }

        return $data;
    }

    public function nuevo($nombre, $numero, $tipo, $tipo2, $descripcion, $imagen) {
       $query = "INSERT INTO pokemon (numero, nombre, tipo1, tipo2, descripcion, imagen)"
                ." VALUES($numero, '$nombre', $tipo, $tipo2, '$descripcion', '$imagen')";

       $this->database->execute($query);
    }

    public function getTiposData(): array|bool {
        $query = "SELECT * FROM tipo";

        return $this->database->query($query);
    }

    public function checkTipoId($id): bool {
        $query = "SELECT * FROM tipo WHERE id = '" .$id. "'";

        return !empty($this->database->query($query));
    }

    public function loginCheck() {

        if(isset($_GET["logout"])){
            session_unset();
        }

        if (isset($_SESSION['role'])) {
         //   $data["logged"] = true;
            $data["logged"]= $_SESSION["role"];
                
        }   else {
          //  $data["notLogged"] = true;
            $data["notLogged"]= true;
            
        }
        return $data;

    }

    public function editar($id, $nombre, $numero, $tipo1, $tipo2, $descripcion, $imagen = "") {
        if (!empty($imagen)) {
            $query = "UPDATE pokemon SET numero = $numero, nombre='$nombre' ,tipo1= $tipo1, tipo2= $tipo2,descripcion='$descripcion', imagen = '$imagen' WHERE id = $id";
        } else {
            $query = "UPDATE pokemon SET numero = $numero, nombre='$nombre' ,tipo1= $tipo1, tipo2= $tipo2,descripcion='$descripcion' WHERE id = $id";
        }

        $this->database->execute($query);

        header("location: /");
    }

    public function eliminar($id) {
        $query = "DELETE FROM pokemon WHERE id = $id";
        $this->database->execute($query);
    }

    public function getTiposDataOrderByPokemonId($tipoId): array {
        $query = "SELECT * FROM tipo ORDER BY CASE WHEN id = $tipoId then id END DESC";

        return $this->database->query($query);
    }
}