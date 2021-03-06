<?php

class Tipotareas_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get tipotarea by idTipoTarea
     */
    function get_tipotarea($idTipoTarea)
    {
        return $this->db->get_where('tipotarea',array('idTipoTarea'=>$idTipoTarea))->row_array();
    }

    /*
     * Get all tipotarea
     */
    function get_all_tipotarea()
    {
        $this->db->order_by('idTipoTarea', 'desc');
        return $this->db->get('tipotarea')->result_array();
    }

    /*
     * function to add new tipotarea
     */
    function add_tipotarea($params)
    {
        $this->db->insert('tipotarea',$params);
        return $this->db->insert_id();
    }

    /*
     * function to update tipotarea
     */
    function update_tipotarea($idTipoTarea,$params)
    {
        $this->db->where('idTipoTarea',$idTipoTarea);
        return $this->db->update('tipotarea',$params);
    }

    /*
     * function to delete tipotarea
     */
    function delete_tipotarea($idTipoTarea)
    {
        return $this->db->delete('tipotarea',array('idTipoTarea'=>$idTipoTarea));
    }
    
    function get_all_tipoTarea_sin_tareas()
    {
        $query="SELECT * FROM tipotarea WHERE NOT EXISTS (SELECT * FROM tarea WHERE tarea.idTipoTarea=tipotarea.idTipoTarea)";
        return $this->db->query($query)->result_array();
    }
    
    function get_all_tipoTarea_con_tareas()
    {
        $query="SELECT * FROM tipotarea WHERE EXISTS (SELECT * FROM tarea WHERE tarea.idTipoTarea=tipotarea.idTipoTarea)";
        return $this->db->query($query)->result_array();
    }
}
