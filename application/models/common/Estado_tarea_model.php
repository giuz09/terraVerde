<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Estado_tarea_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get estado_tarea by idEstado
     */
    function get_estado_tarea($idEstado)
    {
        return $this->db->get_where('estado_tarea',array('idEstado'=>$idEstado))->row_array();
    }
        
    /*
     * Get all estado_tarea
     */
    function get_all_estado_tarea()
    {
        $this->db->order_by('idEstado', 'desc');
        return $this->db->get('estado_tarea')->result_array();
    }
        
    /*
     * function to add new estado_tarea
     */
    function add_estado_tarea($params)
    {
        $this->db->insert('estado_tarea',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update estado_tarea
     */
    function update_estado_tarea($idEstado,$params)
    {
        $this->db->where('idEstado',$idEstado);
        return $this->db->update('estado_tarea',$params);
    }
    
    /*
     * function to delete estado_tarea
     */
    function delete_estado_tarea($idEstado)
    {
        return $this->db->delete('estado_tarea',array('idEstado'=>$idEstado));
    }
}
