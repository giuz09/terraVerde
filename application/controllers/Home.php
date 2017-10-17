<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

    public function __construct()
    {
        parent::__construct();
         if (!$this->ion_auth->logged_in() )
        {

        }
        else
        {
        $this->data['user_login']  = $this->prefs_model->user_info_login($this->ion_auth->user()->row()->id);
    	}
    }


	public function index()
	{
		$this->load->view('public/home', $this->data);
	}
}
