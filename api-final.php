

<?php

/*ruteo*/

$route->addRoute('candidato' , 'GET', 'apiFinalController' , 'getAllCandidatos');
$route->addRoute('candidato/:ID' , 'GET', 'apiFinalController', 'getCandidato');
$route->addRoute('candidato/eliminar/:ID', 'DELETE' , 'apiFinalController', 'eliminarCandidato');

//por get se ingresa el orden
$route->addRoute('candidato/imagen', 'GET','apiFinalController','getCandidatosOrdenados');



class apiFinalController{

    public function getCandidato($params = null){
        if(isset($params[':ID'])){
            $idCandidato = $params[':ID'];
        }
        $candidato = $this->model->getCandidato($idCandidato);

        if ($candidato) {
            
            $this->view->response($candidato);

        }else{
            $this->view->response('error');
        }
        

    }

    public function getCandidatosOrdenados(){
        
        $orden = $_GET['orden'];
        //obtengo todos los candidatos 
        if ($orden == 'asc' || $orden =='desc') {
            //mostrar ordenado
            $candidato = $this->model->getAllCandidatoOrdenado($orden);
            
        }

        if ($candidato) {
            $this->view->response($candidato);
        }else{
            $this->view->response('error');
        }

    }
}