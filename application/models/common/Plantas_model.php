<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Plantas_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
         $this->load->model('common/Especies_model');
    }

    /*
     * Get planta by idPlanta
     */
    function get_planta($idPlanta)
    {
        return $this->db->get_where('planta',array('idPlanta'=>$idPlanta))->row_array();
    }

    function get_planta_especie($idPlanta)
    {
        $query = "SELECT especie.luzMax,especie.luzMin,especie.humedadMax,especie.humedadMax,especie.temperaturaMax,especie.temperaturaMin FROM `planta` JOIN especie ON planta.idEspecie=especie.idEspecie";
        return $this->db->query($query)->result_array();
    }

    function especiePlanta($idPlanta)
    {
        $query = "SELECT especie.luzMax,especie.luzMin,especie.humedadMax,especie.humedadMax,especie.temperaturaMax,especie.temperaturaMin,especie.active FROM `planta` JOIN especie ON planta.idEspecie=especie.idEspecie";
        return $this->db->query($query)->result_array();
    }

    /*ESTA FUNCION ARROJARA COMO RESULTADO UN ARRAY QUE CONTIENE LA INFORMACION
    DE LAS PLANTAS CON LA RESPECTIVA INFORMACIÓN DE SU ESPECIE, PARA REALIZAR LA COMPARACION DE CONDICIONES A LA HORA DE AGREGAR UNA PLANTA ADENTRO*/
    function obtener_plantas_especies()
    {
        $query = "SELECT especie.luzMax,especie.luzMin,especie.humedadMax,especie.humedadMin,especie.temperaturaMax,especie.temperaturaMin,especie.nombreEspecie,planta.idPlanta,planta.nombrePlanta,planta.unidadEspacioPlanta_m2,planta.active FROM `planta` JOIN especie ON planta.idEspecie=especie.idEspecie";
        return $this->db->query($query)->result_array();
    }

    /**
     * Reotorna la informacion de la planta, junto con la de su respectiva especie
     * @param  [type] $idPlanta [description]
     * @return [type]           [description]
     */
    function info_planta_especie($idPlanta)
    {

        $query="SELECT *
                FROM planta
                JOIN especie ON planta.idEspecie = especie.idEspecie
                WHERE planta.idPlanta =".$idPlanta;
        return $this->db->query($query)->row_array();

    }

        /**
         * FUNCION QUE RETORNA TODAS LAS PLANTAS COMPATIBLES CON LAS CONDICIONES DE UN DETERMINADO UMBRACULO
         * @param string $value [description]
         */
        public function plantas_compatibles ($hmin,$hmax,$lmin,$lmax,$tmin,$tmax)
        {
            $query= "SELECT *
                        FROM planta
                        JOIN especie ON planta.idEspecie = especie.idEspecie
                        WHERE
                        especie.humedadMin BETWEEN '0' and '".$hmin."'
                        AND
                        especie.humedadMax BETWEEN '".$hmin."' and '".$hmax."'
                        AND
                        especie.luzMin BETWEEN '0' and '".$lmin."'
                        AND
                        especie.luzMax BETWEEN '".$lmin."' and '".$lmax."'
                        AND
                        especie.temperaturaMin BETWEEN '0' and '".$tmin."'
                        AND
                        especie.temperaturaMax BETWEEN '".$tmin."' and '".$tmax."'";
            return $this->db->query($query)->result_array();
        }

                /**
         * FUNCION QUE RETORNA TODAS LAS PLANTAS COMPATIBLES CON LAS CONDICIONES DE UN DETERMINADO UMBRACULO
         * @param string $value [description]
         */
        function plantas_compatibles_params ($info_umbraculo)
        {

            $query="SELECT *,planta.active AS ea
                        FROM planta
                        JOIN especie ON planta.idEspecie = especie.idEspecie
                        WHERE
                        (especie.temperaturaMin <= ".$info_umbraculo['temperaturaUmbraculo'].") AND (especie.temperaturaMax >=".$info_umbraculo['temperaturaUmbraculo'].")
                        AND
                        (especie.luzMin <= ".$info_umbraculo['luzUmbraculo'].") AND (especie.luzMax >= ".$info_umbraculo['luzUmbraculo'].")
                        AND
                        (especie.humedadMin <= ".$info_umbraculo['humedadUmbraculo'].") AND (especie.humedadMax >= ".$info_umbraculo['humedadUmbraculo'].")";

            return $this->db->query($query)->result_array();
        }

    /*
     * Get all plantas
     */
    function no_existe_planta_umbraculo($idPlanta){
      $vector = $this->db->get_where('umbraculo/planta',array('idPlanta'=>$idPlanta))->row_array();
      if (($vector==null)){
      return true;
      }
      else {
        return false;}
    }

    /*
     * Get all plantas
     */
    function get_all_plantas()
    {
        $this->db->order_by('idPlanta', 'desc');
        return $this->db->get('planta')->result_array();
    }

    /*
     * Get all plantas
     */

    function getPlantasEspecies()
    {
      $query="SELECT *,`planta`.active AS pa,especie.active AS ea FROM `planta` JOIN especie ON `planta`.idEspecie=especie.idEspecie ORDER BY planta.active DESC";
      return  $this->db->query($query)->result_array();
    }
    /* todas las plantas fuera y dentro del umbraculo*/
    function get_all_plantas_no_en_umbraculo()
    {
        $query="SELECT *,`planta`.active AS pa,especie.active AS ea FROM planta JOIN especie ON `planta`.idEspecie=especie.idEspecie WHERE NOT EXISTS (SELECT * FROM `umbraculo/planta` WHERE planta.idPlanta=`umbraculo/planta`.idPlanta)";
        return $this->db->query($query)->result_array();
    }

    function get_all_plantas_en_umbraculo()
    {
        $query="SELECT *,`planta`.active AS pa,especie.active AS ea FROM planta JOIN especie ON `planta`.idEspecie=especie.idEspecie WHERE EXISTS (SELECT * FROM `umbraculo/planta` WHERE planta.idPlanta=`umbraculo/planta`.idPlanta)";
        return $this->db->query($query)->result_array();
    }
    /*todas las plantas fuera y dentro del umbraculo activas*/

    function get_all_plantas_active_en_umb()
    {
       $query="SELECT *,`planta`.active AS pa,especie.active AS ea FROM `planta` JOIN especie ON `planta`.idEspecie=especie.idEspecie WHERE (planta.`active`=1) AND EXISTS (SELECT * FROM `umbraculo/planta` WHERE planta.idPlanta=`umbraculo/planta`.idPlanta) ORDER BY planta.active DESC";
      return  $this->db->query($query)->result_array();
    }
    function get_all_plantas_active_no_en_umb()
    {
       $query="SELECT *,`planta`.active AS pa,especie.active AS ea FROM `planta` JOIN especie ON `planta`.idEspecie=especie.idEspecie WHERE (planta.`active`=1) AND NOT EXISTS (SELECT * FROM `umbraculo/planta` WHERE planta.idPlanta=`umbraculo/planta`.idPlanta) ORDER BY planta.active DESC";
      return  $this->db->query($query)->result_array();
    }

    /*todas las plantas fuera y dentro del umbraculo inactivas*/

    function get_all_plantas_inactive_en_umb()
    {
       $query="SELECT *,`planta`.active AS pa,especie.active AS ea FROM `planta` JOIN especie ON `planta`.idEspecie=especie.idEspecie WHERE (planta.`active`=0) AND EXISTS (SELECT * FROM `umbraculo/planta` WHERE planta.idPlanta=`umbraculo/planta`.idPlanta) ORDER BY planta.active DESC";
      return  $this->db->query($query)->result_array();
    }
    function get_all_plantas_inactive_no_en_umb()
    {
       $query="SELECT *,`planta`.active AS pa,especie.active AS ea FROM `planta` JOIN especie ON `planta`.idEspecie=especie.idEspecie WHERE (planta.`active`=0) AND NOT EXISTS (SELECT * FROM `umbraculo/planta` WHERE planta.idPlanta=`umbraculo/planta`.idPlanta) ORDER BY planta.active DESC";
      return  $this->db->query($query)->result_array();
    }
    /*todas las plantas fuera y dentro del umbraculo ordenads por unidad*/

    function get_all_plantas_unidad_en_umb()
    {
       $query="SELECT *,`planta`.active AS pa,especie.active AS ea FROM `planta` JOIN especie ON `planta`.idEspecie=especie.idEspecie WHERE  EXISTS (SELECT * FROM `umbraculo/planta` WHERE planta.idPlanta=`umbraculo/planta`.idPlanta) ORDER BY planta.unidadEspacioPlanta_m2 ASC";
      return  $this->db->query($query)->result_array();
    }
    function get_all_plantas_unidad_no_en_umb()
    {
       $query="SELECT *,`planta`.active AS pa,especie.active AS ea FROM `planta` JOIN especie ON `planta`.idEspecie=especie.idEspecie WHERE  NOT EXISTS (SELECT * FROM `umbraculo/planta` WHERE planta.idPlanta=`umbraculo/planta`.idPlanta) ORDER BY planta.unidadEspacioPlanta_m2 ASC";
      return  $this->db->query($query)->result_array();
    }
    /* plantas activas*/

    function get_all_plantas_active()
    {
       $query="SELECT *,`planta`.active AS pa,especie.active AS ea FROM `planta` JOIN especie ON `planta`.idEspecie=especie.idEspecie WHERE planta.`active`=1 ORDER BY planta.active DESC";
      return  $this->db->query($query)->result_array();
    }
    /*
     * Get all plantas inactivas
     */
    function get_all_plantas_inactive()
    {
      $query="SELECT *,`planta`.active AS pa,especie.active AS ea FROM `planta` JOIN especie ON `planta`.idEspecie=especie.idEspecie WHERE planta.`active`=0 ORDER BY planta.active DESC";
      return  $this->db->query($query)->result_array();
    }
    /*
     * Get all plantas
     */
    function get_all_plantas_unidad()
    {
        $query="SELECT *,`planta`.active AS pa,especie.active AS ea FROM `planta` JOIN especie ON `planta`.idEspecie=especie.idEspecie  ORDER BY planta.unidadEspacioPlanta_m2 ASC";
      return  $this->db->query($query)->result_array();
        $this->db->order_by('unidadEspacioPlanta_m2', 'asc');
        return $this->db->get('planta')->result_array();
    }


    /*
     * function to add new planta
     */
    function add_planta($params)
    {
        $this->db->insert('planta',$params);
        return $this->db->insert_id();
    }

    /*
     * function to update planta
     */
    function update_planta($idPlanta,$params)
    {
        $this->db->where('idPlanta',$idPlanta);
        return $this->db->update('planta',$params);
    }

    /*
     * function to delete planta
     */
    function delete_planta($idPlanta)
    {
        return $this->db->delete('planta',array('idPlanta'=>$idPlanta));
    }

    /**
     * Desactiva una planta, para que ya no pueda ser utilizada, por 'x' motivo
     * @param  [type] $idInsumo [description]
     * @return [type]           [description]
     */
    function desactivar_planta($idPlanta)
      {
        $query="UPDATE `planta` SET `active`=0 WHERE `planta`.`idPlanta`=".$idPlanta;
        $this->db->query($query);
      }

    /**
    * ACTIVAR UN INSUMO QUE NO ESTÉ SIENDO UTILIZADO.
    */
        function activar_planta($idPlanta)
        {
          $query="UPDATE `planta` SET `active`=1 WHERE `planta`.`idPlanta`=".$idPlanta;
          $this->db->query($query);
        }


}
