


<?php

require_once('final.model.php');

//no implemento el view pero lo dejo representado
require_once('final.view.php');


class TuVot{
    private $model;
    private $view;
    public function __construct(Type $var = null) {
        //modelo
        $this->model = new modelFinal();

        //vista
        $this->view = new viewFinal();

    }

    public function insertEncuesta(){
        //verifico que esten los datos

        if (isset($_request['dni']) && isset($_request['fecha']) && isset($_request['id_candidato']) && isset($_request['imagen'])) {

             $dni = $_REQUEST['dni'];
             $fecha = $_REQUEST['fecha'];
             $id_candidato = $_REQUEST['id_candidato'];
             $img = $_REQUEST['imagen'];

             //verifico mediante el dni de el votante y el id de candidato que no haya votado al mismo candidato
             $voto = $this->model->getVotoEncuesta($dni,$candidato);
        }

        if(!$voto){
            //inserto el voto
            $this->model->insertVotoEncuesta($dni,$fecha,$id_candidato,$img);

        }else{
            echo 'ya votaste a este candidato';
        }

    }


    public function obtImagenCandidato(){
        //Obtener la imagen de un candidato determinado (dar % de imagen positiva y negativa).

        if (isset($_REQUEST['id_candidato'])) {
            $idCandidato = $_REQUEST['id_candidato'];

            //obtengo a el candidato
            $candidato =$this->model->getCandidato($idCandidato);
            $partidoCandidato = $this->model->getPartidoCandidato($candidato->id_partido);
        }else{
            echo 'id de candidato invalido';
        }

        if ($candidato) {

            
            $imgPositiva = $this->model->getImagenPositiva($idCandidato);
            $imgNegativa = $this->model->getImagenNegativa($idCandidato);
            $cantVotos =   $this->model->getCantVotos($idCandidato);
            
            
            
            // (a/total) *100 ;
            
            //porcentaje positivo
            $porcentajePositivo = ($imgPositiva/$cantVotos) * 100;
            
            //porcentaje negativo
            $porcentajeNegativo = ($imgNegativa/$cantVotos) * 100;

            $this->view->getImagenCandidato($candidato->nombre, $candidato->edad ,$partidoCandidato->nombre ,$porcentajePositivo, $porcentajeNegativo);

        }else{
            echo 'no se encontro al candidato';
        }

    } 

}