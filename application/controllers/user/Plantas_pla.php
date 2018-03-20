<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Plantas_pla extends Public_Controller{
    function __construct()
    {
        parent::__construct();
        /* CARGA LA BASE DE DATOS O MODELO*/
        $this->load->model('common/Plantas_model');
                 if (!$this->ion_auth->logged_in() )
        {

        }
        else
        {
        $this->data['user_login']  = $this->prefs_model->user_info_login($this->ion_auth->user()->row()->id);
        }
    } 


    /*
     INDEX, LISTAR LAS PLANTAS
     */
        public function index()
        {
            if ( ! $this->ion_auth->logged_in())
            {
                redirect('auth/login', 'refresh');
            }
            else
            {
                /*$this->data['plantas'] = $this->Plantas_model->getPlantasEspecies();*/
                $this->data['plantasCon'] = $this->Plantas_model->get_all_plantas_con_umbraculo();
                $this->data['plantasSin'] = $this->Plantas_model->get_all_plantas_sin_umbraculo();
                /* Load Template */
                $this->template->user_render('public/plantas/index', $this->data);
            }
        }

    /*
     REGISTRAR UNA NUEVA PLANTA AL SISTEMA
     */
    function crear()
    {   
        if ( ! $this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
                $this->load->library('form_validation');

        		$this->form_validation->set_rules('unidadEspacioPlanta_m2','UnidadEspacioPlanta M2','required|is_natural');
        		$this->form_validation->set_rules('descripcionPlanta','DescripcionPlanta','required|max_length[255]|min_length[5]');
        		$this->form_validation->set_rules('nombreCientificoPlanta','NombreCientificoPlanta','required|max_length[50]|min_length[4]');
        		$this->form_validation->set_rules('nombrePlanta','NombrePlanta','required|max_length[50]|min_length[4]');
        		
        		if($this->form_validation->run())     
                {   
                    $params = array(
        				'idEspecie' => $this->input->post('idEspecie'),
        				'unidadEspacioPlanta_m2' => $this->input->post('unidadEspacioPlanta_m2'),
        				'descripcionPlanta' => $this->input->post('descripcionPlanta'),
        				'nombreCientificoPlanta' => $this->input->post('nombreCientificoPlanta'),
        				'nombrePlanta' => $this->input->post('nombrePlanta'),
                    );
                    
                    $planta_id = $this->Plantas_model->add_planta($params);
                    redirect('user/plantas_pla/index');
                }
                else
                {
        			$this->load->model('common/Especies_model');
        			$this->data['all_especies'] = $this->Especies_model->get_all_especies();
                    $this->template->user_render('public/plantas/crear', $this->data);
                }
        }
    }  

    /*
     EDITAR UN PLANTA YA REGISTRADA
     */
    function editar($idPlanta)
    {   
        if ( ! $this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
                // check if the planta exists before trying to edit it
                $this->data['planta'] = $this->Plantas_model->get_planta($idPlanta);
                
                if(isset($this->data['planta']['idPlanta']))
                {
                    $this->load->library('form_validation');

        			$this->form_validation->set_rules('unidadEspacioPlanta_m2','UnidadEspacioPlanta M2','required|is_natural');
        			$this->form_validation->set_rules('descripcionPlanta','DescripcionPlanta','required|max_length[255]|min_length[5]');
        			$this->form_validation->set_rules('nombreCientificoPlanta','NombreCientificoPlanta','required|max_length[50]|min_length[4]');
        			$this->form_validation->set_rules('nombrePlanta','NombrePlanta','required|max_length[50]|min_length[4]');
        		
        			if($this->form_validation->run())     
                    {   
                        $params = array(

        					'unidadEspacioPlanta_m2' => $this->input->post('unidadEspacioPlanta_m2'),
        					'descripcionPlanta' => $this->input->post('descripcionPlanta'),
        					'nombreCientificoPlanta' => $this->input->post('nombreCientificoPlanta'),
        					'nombrePlanta' => $this->input->post('nombrePlanta'),
                        );

                        $this->Plantas_model->update_planta($idPlanta,$params);            
                        redirect('user/plantas_pla/index');
                    }
                    else
                    {
        				$this->load->model('common/Especies_model');
        				$this->data['all_especies'] = $this->Especies_model->get_all_especies();
                        /*CARGA LA PLANTILLA CON EL FOIRMULARIO DE EDITAR */
                        $this->template->user_render('public/plantas/editar', $this->data);
                    }
                }
                else
                    show_error('La planta que usted está tratando de editar no existe.');
        }
    } 

    /**
     * Desactiva la planta, para que esta no pueda utilizarse utilizarse en cualquier otro modulo.
     * Ej.- 'Ya no se trabaja con dicha planta'
     * @param  [type] $idPlanta 
     * @return [type]           [description]
     * @author SAKZEDMK
     */
    function borrado_logico ($idPlanta)
    {
        $this->Plantas_model->desactivar_planta($idPlanta);
        redirect('user/plantas_pla/index');
    }

    /**
     * Activa la planta, para que pueda utilizarse en cualquier otro modulo.
     * @param  [type] $idPlanta [description]
     * @return [type]           [description]
     * @author SAKZEDMK
     */
    function activado_logico($idPlanta)
    {
        $this->Plantas_model->activar_planta($idPlanta);
        redirect('user/plantas_pla/index'); 
    }
    /**
     * Para ver lo detalles de la planta junto con los de las especie a la que pertenece.
     * @param  [type] $idPlanta [description]
     * @return [type]           [description]
     * @author SAKZEDMK
     */
    function ver ($idPlanta)
    {
        /*info_planta_especie($idPlanta)*/
        if ( ! $this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['detalles'] = $this->Plantas_model->info_planta_especie($idPlanta);
            $this->template->user_render('public/plantas/ver', $this->data);
        }
    }
}