<?php

class modelFinal{
    private db;
    public function __construct() {
        $this->db = new PDO('mysql:host=localhost'.'dbname=TuVot;charset=utf-8', 'root' ,'');       
    }


    public function getVotoEncuesta($dni, $id_candidato){
        $query= this->db->prepare('SELECT * from encuesta WHERE dni=? and id_candidato=?')
        $query->execute([$dni,$id_candidato]);

        return $query->fetchAll(PDO::FETCH_OBJ);

    }

    public function insertVotoEncuesta($dni,$fecha,$id_candidato,$img){
        $query = $this->db->prepare('INSERT INTO encuesta(dni, fecha, imagen, id_candidato) values(?,?,?,?)');
        $query->execute([$dni,$fecha,$id_candidato,$img]);
        return $this->db->lastInsertId();

    }

    public function getCandidato($idCandidato){
        $query = $this->db->prepare('SELECT * FROM candidato where id=?');
        $query->execute([$idCandidato]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function getPartidoCandidato($id_partido){
        $query = $this->db->prepare('SELECT * FROM partido where id=?');
        $query->execute([$id_partido]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getImagenPositiva($id_candidatos){
        $query = $this->db->prepare('SELECT COUNT(*) FROM encuestas where imagen =positiva and id_candidato=? ');
        $query->execute([$id_candidato]);
        return $query->fetchColumn();
    
    }

    public function getImagenNegativa($id_candidatos){
        $query = $this->db->prepare('SELECT COUNT(*) FROM encuestas where imagen =negativa and id_candidato=? ');
        $query->execute([$id_candidato]);
        return $query->fetchColumn();
    
    }

    public function getCantVotos($id_candidatos){
        $query = $this->db->prepare('SELECT COUNT(*) FROM encuestas where id_candidato=? ');
        $query->execute([$id_candidato]);
        return $query->fetchColumn();
    
    }


    function getAllCandidatoOrdenado($ord){
        $query = $this->db->prepare("SELECT * FROM  candidatos ORDER BY imagen=positiva $ord");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

  
}