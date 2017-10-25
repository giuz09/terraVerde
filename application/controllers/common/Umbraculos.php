<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Umbraculos extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
                /* Load :: Common */
        $this->lang->load('admin/umbraculos');
        /* Title Page :: Common */
        $this->page_title->push(lang('menu_umbraculo'));
        $this->data['pagetitle'] = $this->page_title->show();
        /* CARGA LA BASE DE DATOS O MODELO*/
        $this->load->model('common/Umbraculos_model');
        $this->load->model('common/Umbraculoplantas_model');
    }



/** CARGA EL INDEX DE LA SECCION ADMINISTRACIÓN DE UMBRACULOS*/
	public function index()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            /* CARGO EL LISTADO DE UMBRACULOS*/
            $this->data['umbraculos'] = $this->Umbraculos_model->get_all_umbraculos();
            $this->load->model('common/plantas_model');
            /* carga plantilla */
            $this->template->admin_render('admin/umbraculos/index', $this->data);

        }
    }


    /*
     * Adding a new umbraculos
     */
    function crear()
    {   
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {

            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            
            $this->load->library('form_validation');

            $this->form_validation->set_rules('nombreUmbraculo','NombreUmbraculo','required|max_length[50]|min_length[5]');
            $this->form_validation->set_rules('descripcionUmbraculo','DescripcionUmbraculo','required|max_length[255]|min_length[10]');
            $this->form_validation->set_rules('anchoUmbraculo_m','AnchoUmbraculo M','required|max_length[99]');
            $this->form_validation->set_rules('largoUmbraculo_m','LargoUmbraculo M','required|max_length[99]');
            $this->form_validation->set_rules('unidadEspacioTotal_m2','UnidadEspacioTotal M2','required');
            $this->form_validation->set_rules('temperaturaUmbraculo','TemperaturaUmbraculo','required|max_length[99]');
            $this->form_validation->set_rules('luzUmbraculo','LuzUmbraculo','required');
            $this->form_validation->set_rules('humedadUmbraculo','HumedadUmbraculo','required');
            $this->form_validation->set_rules('descripcionSustrato','DescripcionSustrato','max_length[50]');
            
            if($this->form_validation->run())     
            {   
                $params = array(
                    'nombreUmbraculo' => $this->input->post('nombreUmbraculo'),
                    'anchoUmbraculo_m' => $this->input->post('anchoUmbraculo_m'),
                    'largoUmbraculo_m' => $this->input->post('largoUmbraculo_m'),
                    'unidadEspacioTotal_m2' => $this->input->post('unidadEspacioTotal_m2'),
                    'unidadEspacioDisponible_m2' => $this->input->post('unidadEspacioDisponible_m2'),
                    'temperaturaUmbraculo' => $this->input->post('temperaturaUmbraculo'),
                    'luzUmbraculo' => $this->input->post('luzUmbraculo'),
                    'humedadUmbraculo' => $this->input->post('humedadUmbraculo'),
                    'descripcionSustrato' => $this->input->post('descripcionSustrato'),
                    'descripcionUmbraculo' => $this->input->post('descripcionUmbraculo'),
                );
                
                $umbraculos_id = $this->Umbraculos_model->add_umbraculos($params);
                redirect('common/umbraculos/index');
            }
            else
            {            
                $this->template->admin_render('admin/umbraculos/crear', $this->data);
            }
        }
    }  

    /*EDITAR UN UMBRÁCULO*/

    function editar($idUmbraculo)
    {   
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {

                /* Breadcrumbs */
                $this->data['breadcrumb'] = $this->breadcrumbs->show();
                // check if the umbraculos exists before trying to edit it
                $this->data['umbraculos'] = $this->Umbraculos_model->get_umbraculos($idUmbraculo);
                
                if(isset($this->data['umbraculos']['idUmbraculo']))
                {
                    $this->load->library('form_validation');

                    $this->form_validation->set_rules('nombreUmbraculo','NombreUmbraculo','required|max_length[50]|min_length[5]');
                    $this->form_validation->set_rules('descripcionUmbraculo','DescripcionUmbraculo','required|max_length[255]|min_length[10]');
                    $this->form_validation->set_rules('anchoUmbraculo_m','AnchoUmbraculo M','required|max_length[99]');
                    $this->form_validation->set_rules('largoUmbraculo_m','LargoUmbraculo M','required|max_length[99]');
                    $this->form_validation->set_rules('unidadEspacioTotal_m2','UnidadEspacioTotal M2','required');
                    $this->form_validation->set_rules('temperaturaUmbraculo','TemperaturaUmbraculo','required|max_length[99]');
                    $this->form_validation->set_rules('luzUmbraculo','LuzUmbraculo','required');
                    $this->form_validation->set_rules('humedadUmbraculo','HumedadUmbraculo','required');
                    $this->form_validation->set_rules('descripcionSustrato','DescripcionSustrato','max_length[50]');
                
                    if($this->form_validation->run())     
                    {   
                        $params = array(
                            'nombreUmbraculo' => $this->input->post('nombreUmbraculo'),
                            'anchoUmbraculo_m' => $this->input->post('anchoUmbraculo_m'),
                            'largoUmbraculo_m' => $this->input->post('largoUmbraculo_m'),
                            'unidadEspacioTotal_m2' => $this->input->post('unidadEspacioTotal_m2'),
                            'unidadEspacioDisponible_m2' => $this->input->post('unidadEspacioDisponible_m2'),
                            'temperaturaUmbraculo' => $this->input->post('temperaturaUmbraculo'),
                            'luzUmbraculo' => $this->input->post('luzUmbraculo'),
                            'humedadUmbraculo' => $this->input->post('humedadUmbraculo'),
                            'descripcionSustrato' => $this->input->post('descripcionSustrato'),
                            'descripcionUmbraculo' => $this->input->post('descripcionUmbraculo'),
                        );

                        $this->Umbraculos_model->update_umbraculos($idUmbraculo,$params);            
                        redirect('common/umbraculos/index');
                    }
                    else
                    {
                        $this->template->admin_render('admin/umbraculos/editar', $this->data);
                    }
                }
                else
                    show_error('El umbráculo que esta intentando editar no existe.');
        }
    } 

    /* CONSULTAR INFORMACIÓN UMBRÁCULO*/


    public function ver($idUmbraculo)
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Data */
            $this->data['id'] = $idUmbraculo = (int) $idUmbraculo;

             $this->data['info_umbraculo'] = $this->Umbraculos_model->get_umbraculos($idUmbraculo);
             $this->data['umbraculo_plantas'] = $this->Umbraculoplantas_model->get_umbraculo_plantas_nombre($idUmbraculo);
            /* CARGAR INFORMARCION */
           // $this->load->view('admin/umbraculos/umbraculos_plantas/index',$this->data);

            /* Load Template */
            $this->template->admin_render('admin/umbraculos/ver', $this->data);
        }
    }

    public function agregarPlanta($idUmbraculo)
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Data */
            $idUmbraculo = (int) $idUmbraculo;
            $this->data['id'] = $idUmbraculo; 

            /*CARGA LA INFORMACION DEL UMBRACULO PARA HACER LAS COMPRACIONES NECESARIAS*/
            $this->data['info_umbraculo'] = $this->Umbraculos_model->get_umbraculos($idUmbraculo);
            /* muestra las plantas registradas (si las hay) dentro del umbraculo seleccionado*/
            //$this->data['umbraculo_plantas'] = $this->Umbraculoplantas_model->get_umbraculo_plantas_nombre($idUmbraculo);
            /* CARGAR INFORMARCION DE LAS PLANTAS REGISTRADAS*/
            $this->data['all_plantas'] = $this->plantas_model->get_all_plantas();
            

            /* Load Template */
            $this->template->admin_render('admin/umbraculos/umbraculos_plantas/add', $this->data);
        }
    }

    function add()
    {   
        $this->load->library('form_validation');

        $this->form_validation->set_rules('idPlanta','IdPlanta','required');
        $this->form_validation->set_rules('cantidad','Cantidad','required');
        $this->form_validation->set_rules('idUmbraculo','idUmbraculo','required');      
        if($this->form_validation->run())     
        {   
            $params = array(
                'idUmbraculo' => $this->input->post('idUmbraculo'),
                'idPlanta' => $this->input->post('idPlanta'),
                'cantidad' => $this->input->post('cantidad'),
            );
            
            $umbraculo_plantas_id = $this->Umbraculoplantas_model->add_umbraculo_plantas($params);
            redirect('common/umbraculos/ver/'.$this->input->post('idUmbraculo'));
        }
        else
        {
            /* Breadcrumbs */
            //$this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* CARGA VISTA CON PLANTILLA */
            $this->template->admin_render('admin/umbraculos/umbraculos_plantas/add', $this->data);
        }
    } 
    /*
     * Deleting umbraculos

    function remove($idUmbraculo)
    {
        $umbraculos = $this->Umbraculos_model->get_umbraculos($idUmbraculo);

        // check if the umbraculos exists before trying to delete it
        if(isset($umbraculos['idUmbraculo']))
        {
            $this->Umbraculos_model->delete_umbraculos($idUmbraculo);
            redirect('umbraculos/index');
        }
        else
            show_error('The umbraculos you are trying to delete does not exist.');
    }*/
    

}
