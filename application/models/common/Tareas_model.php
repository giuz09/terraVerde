<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */



class Tareas_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get tareas by idTarea
     */
    function get_tareas($idTarea)
    {
        return $this->db->get_where('tarea',array('idTarea'=>$idTarea))->row_array();
    }

    /*
     * Get all tareas
     */
    function get_all_tareas()
    {
        $this->db->order_by('idTarea', 'desc');
        return $this->db->get('tarea')->result_array();
    }

    /**
     * RETORNA EL LISTADO DE LAS TAREAS (CON UN LIMITE DE TRES ELEMENTOS, PARA SU PRESENTACIÓN EN EL "VER UMBRACULO")
     * JUNTO CON EL JOIN DE TODOS LOS CAMPOS RELACIONADOS A UNA TAREA.
     * @param  [type] $idUmbraculo EL UMBRACULO SELECCIONADO SOBRE EL CUAL SE REALIZA LA CONSULTA
     * @return [type]              [description]
     * @author SAKZEDMK
     */
    function obtener_tareas_umbraculo($idUmbraculo)
    {
        $query ="SELECT tt.nombreTipoTarea,et.nombreEstado,t.fechaCreacion,t.fechaComienzo,p.nombrePlanta,t.idTarea, CONCAT(u.first_name,' ',u.last_name) AS creador
                    FROM tarea t
                    JOIN tipotarea tt ON t.idTipoTarea = tt.idTipoTarea
                    JOIN estado_tarea et ON t.idEstado= et.idEstado
                    JOIN users u ON t.idUserCreador = u.id
                    JOIN planta p ON t.idPlanta = p.idPlanta
                    WHERE t.idUmbraculo=".$idUmbraculo." ORDER BY t.fechaCreacion DESC LIMIT 0,3";
        return $this->db->query($query)->result_array();
    }



    function all_estado_tareas()
    {
        $query ="SELECT *
                    FROM estado_tarea";
        return $this->db->query($query)->result_array();
    }

    function get_all_insumo()
    {
        $query ="SELECT *
                    FROM insumo";
        return $this->db->query($query)->result_array();
    }

    function get_tarea_join($idTarea)
    {
        $query ="SELECT tt.nombreTipoTarea,et.nombreEstado,t.fechaCreacion,t.fechaComienzo,p.nombrePlanta,t.idTarea, CONCAT(u.first_name,' ',u.last_name) AS creador,umb.nombreUmbraculo,umb.idUmbraculo,t.observacionEspecialista
                    FROM tarea t
                    JOIN tipotarea tt ON t.idTipoTarea = tt.idTipoTarea
                    JOIN estado_tarea et ON t.idEstado= et.idEstado
                    JOIN users u ON t.idUserCreador = u.id
                    JOIN planta p ON t.idPlanta = p.idPlanta
                    JOIN umbraculo umb ON t.idUmbraculo = umb.idUmbraculo
                    WHERE t.idTarea=".$idTarea."
                    LIMIT 0,1";

        return $this->db->query($query)->result_array();
    }



    function comprobar_existencia_tarea($id1, $id2, $id3,$id4)
    {
      //consulta de tareas en el umbraculo y en la misma planta con la misma fecha ingresada
      $vector = $this->db->get_where('tarea',array('idUmbraculo'=>$id1,'fechaComienzo'=>$id2,'idPlanta'=>$id3, 'idTipoTarea'=>$id4))->row_array();

      if (  ($vector==null)){
      return true;
      }
      else {
        return false;}
      }





    /**
     * RETORNA EL LISTADO DE TODAS LAS TAREAS PERTENECIENTES A UM UMBRACULO
     * JUNTO CON EL JOIN DE TODOS LOS CAMPOS RELACIONADOS A UNA TAREA.
     * @param  [type] $idUmbraculo EL UMBRACULO SELECCIONADO SOBRE EL CUAL SE REALIZA LA CONSULTA
     * @author SAKZEDMK
     */
    function listar_tareas_umbraculo($idUmbraculo)
    {
        $query ="SELECT tt.nombreTipoTarea,et.nombreEstado,et.idEstado,t.fechaCreacion,t.fechaComienzo,p.nombrePlanta,t.idTarea, CONCAT(u.first_name,' ',u.last_name) AS creador
        -- , ua.idUserAtencion
        -- ,CONCAT(ua.first_name,' ',ua.last_name) AS atencion
                    FROM tarea t
                    JOIN tipotarea tt ON t.idTipoTarea = tt.idTipoTarea
                    JOIN estado_tarea et ON t.idEstado= et.idEstado
                    JOIN users u ON t.idUserCreador = u.id
                    -- JOIN users ua ON t.idUserAtencion = ua.id
                    JOIN planta p ON t.idPlanta = p.idPlanta
                    WHERE t.idUmbraculo=".$idUmbraculo." ORDER BY t.fechaCreacion DESC";
        return $this->db->query($query)->result_array();
    }

    /*
     * function to add new tareas
     */
    function add_tareas($params)
    {

        $this->db->insert('tarea',$params);
        //$this->db->query($query);
        return $this->db->insert_id();
    }

    /*
     * function to update tareas
     */
    function update_tareas($idTarea,$params)
    {
        $this->db->where('idTarea',$idTarea);
        return $this->db->update('tarea',$params);
    }

    /*
     * function to delete tareas
     */
    function delete_tareas($idTarea)
    {
        return $this->db->delete('tarea',array('idTarea'=>$idTarea));
    }
}
