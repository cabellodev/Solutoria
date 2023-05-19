<?php
class IndicadoresModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// funcion que carga toda la data del archivo json  a la tabla "indicadores" de la BD "tareas"
    public function chargeData($json){

        $data = json_decode($json, true);

        foreach($data as $row){
           if($row['codigoIndicador']=='UF'){
                $insert= array(
                "nombreIndicador" => $row['nombreIndicador'],
                "codigoIndicador"=>$row['codigoIndicador'],
                "unidadMedidaIndicador"=>$row['unidadMedidaIndicador'],
                "valorIndicador"=>$row['valorIndicador'],
                "fechaIndicador"=>$row['fechaIndicador'],
                "tiempoIndicador"=>$row['tiempoIndicador'],
                "origenIndicador"=>$row['origenIndicador'],
                );

                $query = "INSERT INTO indicadores (nombreIndicador, codigoIndicador,unidadMedidaIndicador,
                valorIndicador,fechaIndicador,tiempoIndicador,origenIndicador) VALUES (?,?,?,?,?,?,?)";
                $this->db->query($query,$insert);
           }
        }
    }

    // funcion de lectura que obtiene todos los indicadores de la tabla
    public function get(){
        $query = "SELECT id,nombreIndicador,codigoIndicador,unidadMedidaIndicador,
        valorIndicador,fechaIndicador,tiempoIndicador,origenIndicador FROM indicadores";
        return $this->db->query($query)->result();
    }


    public function create($data){

        $insert= array(
            "nombreIndicador" => $data['name'],
            "codigoIndicador"=>$data['code'],
            "unidadMedidaIndicador"=>$data['measure'],
            "valorIndicador"=>$data['value'],
            "fechaIndicador"=>$data['date'],
            "tiempoIndicador"=>$data['time'],
            "origenIndicador"=>$data['origin'],
            );

        $query = "INSERT INTO indicadores (nombreIndicador, codigoIndicador,unidadMedidaIndicador,
        valorIndicador,fechaIndicador,tiempoIndicador,origenIndicador) VALUES (?,?,?,?,?,?,?)";
        return $this->db->query($query,$insert);
    }

    public function update($data,$id){

        $update= array(
            "nombreIndicador" => $data['name'],
            "codigoIndicador"=>$data['code'],
            "unidadMedidaIndicador"=>$data['measure'],
            "valorIndicador"=>$data['value'],
            "fechaIndicador"=>$data['date'],
            "tiempoIndicador"=>$data['time'],
            "origenIndicador"=>$data['origin'],
            "id"=>$id
            );

        $query = "UPDATE indicadores SET nombreIndicador=?, codigoIndicador=?,unidadMedidaIndicador=?,
        valorIndicador=?,fechaIndicador=?,tiempoIndicador=?,origenIndicador=? WHERE id=?";
        return $this->db->query($query,$update);
    }


    public function delete($id){
        $query = "DELETE FROM indicadores WHERE id=?";
        return $this->db->query($query,$id);
        
    }
}