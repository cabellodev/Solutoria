<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indicadores extends CI_Controller {


	public function chargeData()
	{
		$json = file_get_contents('http://localhost/tarea/assets/css/response.json');
        $this->IndicadoresModel->chargeData($json);
	}


	public function create()
	{     

		$data=$this->input->post('register');
        $ok=true;
		if(empty($data['value'])){$ok=false;}
		if(empty($data['name'])){$ok=false;}
		if(empty($data['code'])){$ok=false;}
		if(empty($data['measure'])){$ok=false;}
		if(empty($data['date'])){$ok=false;}

		if($ok){

           if($this->IndicadoresModel->create($data)){
               $this->response->sendJSONResponse(array('msg'=>'El registro fue almacenado con exito'));
		   }else{
			$this->response->sendJSONResponse(array('msg'=>'El registro no ha sido almacenado, vuelva a intentar'),404);
		   }

		}else{
			$this->response->sendJSONResponse(array('msg'=>'Complete los datos del formulario'),404);
		}
        
       
      
	}


	public function get()
	{
        
      if($data= $this->IndicadoresModel->get()){
		$this->response->sendJSONResponse($data);
	  }else{
		$this->response->sendJSONResponse(array("msg"=>"No es posible obtener la listade indicadores"),400);
	  }
      
	}

	public function update($id)
	{
        $data=$this->input->post('register');
	
        $ok=true;
		if(empty($data['value'])){$ok=false;}
		if(empty($data['name'])){$ok=false;}
		if(empty($data['code'])){$ok=false;}
		if(empty($data['measure'])){$ok=false;}
		if(empty($data['date'])){$ok=false;}

		if($ok){

           if($this->IndicadoresModel->update($data,$id)){
               $this->response->sendJSONResponse(array('msg'=>'El registro fue almacenado con exito'));
		   }else{
			$this->response->sendJSONResponse(array('msg'=>'El registro no ha sido almacenado, vuelva a intentar'),404);
		   }

		}else{
			$this->response->sendJSONResponse(array('msg'=>'Complete los datos del formulario'),404);
		}
        
       
      
	}
	public function delete($id)
	{
		if($data= $this->IndicadoresModel->delete($id)){
			$this->response->sendJSONResponse(array('msg'=>'Registro elimnado con éxito'));
		  }else{
			$this->response->sendJSONResponse(array("msg"=>"No es posible obtener la listade indicadores"),400);
		  }
		  
      
	}
}
