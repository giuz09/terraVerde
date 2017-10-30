<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Umbraculoplantas_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('common/plantas_model');
    }
    

    /**
     * OBTENER LAS PLANTAS QUE ESTAN ALOJADAS EN UN DETERMINADO UMBRÁCULO, CON SU RESPECTIVO NOMBRE LIMITE 3
     * @param  [type] $idUmbraculo EL ID DEL UMBRACULO SOBRE EL CUAL SE ESTÁ TRABAJANDO.
     * @author SAKZEDMK
     */
    function get_umbraculo_plantas($idUmbraculo)
    {
        return $this->db->get_where('umbraculo/planta',array('idUmbraculo'=>$idUmbraculo))->result_array();
    }

    /**
     * SI UNA PLANTA DEL MISMO ID YA SE ENCUENTRA REGISTRADA DENTRO DEL UMBRÁCULO, RETORNA LA FILA
     * SI NO LO ESTÁ, RETORNARÁ 'NULL'
     * @param  [type] $idUmbraculo EL ID DEL UMBRACULO SOBRE EL CUAL SE ESTÁ TRABAJANDO.
     * @param  [type] $idPlanta    EL ID DE LA PLANTA QUE SE ESTÁ INTENTADO REGISTRAR.
     * @author SAKZEDMK
     */
     function esta_registrada($params)
     {
        $query="SELECT * FROM `umbraculo/planta` WHERE `umbraculo/planta`.`idPlanta`=".$params['idPlanta']." AND `umbraculo/planta`.`idUmbraculo`=".$params['idUmbraculo'];
        return $this->db->query($query)->row_array();
     }

    /**
     * OBTENER LAS PLANTAS QUE ESTAN ALOJADAS EN UN DETERMINADO UMBRÁCULO, CON SU RESPECTIVO NOMBRE LIMITE 3
     * @param  [type] $idUmbraculo EL ID DEL UMBRACULO SOBRE EL CUAL SE ESTÁ TRABAJANDO.
     * @author SAKZEDMK
     */
    function get_umbraculo_plantas_nombre($idUmbraculo)
    {
        $query = "SELECT * FROM `umbraculo/planta` JOIN planta ON planta.idPlanta = `umbraculo/planta`.idPlanta WHERE `umbraculo/planta`.idUmbraculo=".$idUmbraculo." LIMIT 0,3";

        return $this->db->query($query)->result_array();
    }

    /**
     * OBTENER TODAS LAS PLANTAS QUE ESTAN ALOJADAS EN UN DETERMINADO UMBRÁCULO, CON SU RESPECTIVO NOMBRE 
     * @param  [type] $idUmbraculo EL ID DEL UMBRACULO SOBRE EL CUAL SE ESTÁ TRABAJANDO.
     * @author SAKZEDMK
     */
    function ver_plantas_umbraculo($idUmbraculo)
    {
        $query = "SELECT * FROM `umbraculo/planta` JOIN planta ON planta.idPlanta = `umbraculo/planta`.idPlanta WHERE `umbraculo/planta`.idUmbraculo=".$idUmbraculo;

        return $this->db->query($query)->result_array();
    }


    /*
     OBTENER PLANTAS UMBRACULO
     */
    function get_all_umbraculo_plantas()
    {
        $this->db->order_by('idUmbraculo', 'desc');
        return $this->db->get('umbraculo/planta')->result_array();
    }
        
    /*
     * function to add new umbraculo_plantas
     */
    function add_umbraculo_plantas($params)
    {
        $query = "INSERT INTO `umbraculo/planta`(`idPlanta`, `cantidad`, `idUmbraculo`) VALUES (".$params['idPlanta'].",".$params['cantidad'].",".$params['idUmbraculo'].")";
        $this->db->query($query);
    }
    
    /**
     * OBJETIVO : Actualizar la cantidad de una planta dentro de un umbraculo
     * @param  [type] $idUmbraculo Umbraculo seleccionad
     * @param  [type] $idPlanta    Planta seleccionada
     * @param  [type] $cantidad      Nueva cantidad
     * @author SAKZEDMK
     */
    function actualizar_cantidad_planta($idUmbraculo,$idPlanta,$cantidad)
    {
        $query="UPDATE `umbraculo/planta` SET `cantidad`=".$cantidad." WHERE `idPlanta`=".$idPlanta." AND `idUmbraculo`=".$idUmbraculo;
        $this->db->query($query);
    }

    /*
     * FUNCION PARA RETIRAR UNA PLANTA DENTRO DE UN DETERMINADO UMBRACULO
     */
    function retirar_planta_umbraculo($idUmbraculo,$idPlanta)
    {
        $query="DELETE FROM `umbraculo/planta` WHERE idPlanta = ".$idPlanta." AND idUmbraculo =".$idUmbraculo;
        return $this->db->query($query);
        //return $this->db->delete('umbraculo/planta',array('idUmbraculo'=>$idUmbraculo));
    }
}