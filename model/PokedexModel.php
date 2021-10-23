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

        $respond = $this->database->query($query);

        $data["pokemons"] = $respond;

        return $data;
    }

    public function search($search): array {
        $query = "SELECT p.id, numero, nombre, t1.imagen as tipo1, t2.imagen as tipo2 FROM pokemon p"
                . " JOIN tipo t1 ON p.tipo1 = t1.id"
                . " LEFT JOIN tipo t2 on p.tipo2 = t2.id"
                . " WHERE nombre LIKE '%" .$search
                . "%' OR numero LIKE  '%" .$search. "%' OR tipo1 LIKE '%" .$search
                . "%' OR tipo2 LIKE '%" .$search. "%' ORDER BY numero";

        $respond = $this->database->query($query);

        $data[] = [];

        if (empty($respond)) {
            $data["error"] = true;
            $data = array_merge($data, $this->getPokemons());
        } else {
            $data["pokemons"] = $respond;
        }

        return $data;
    }

    public function getPokemonById($id): array {
        $query = "SELECT numero, nombre, t1.imagen as tipo1, t2.imagen as tipo2, p.imagen, descripcion FROM pokemon p "
                . "JOIN tipo t1 ON p.tipo1 = t1.id "
                . "LEFT JOIN tipo t2 on p.tipo2 = t2.id "
                . "WHERE p.id = '" .$id. "' "
                . "ORDER BY numero";


        $respond= $this->database->query($query);

        $data["pokemons"]= $respond;

        return $data;
    }

    public function nuevo($nombre, $numero, $tipo, $tipo2, $descripcion, $imagen){
       $query = "insert into pokemon (numero, nombre, tipo1, tipo2, descripcion, imagen)"
                ."values('$numero', '$nombre', '$tipo', '$tipo2', '$descripcion', '$imagen')";

       $this->database->execute($query);
    }
}