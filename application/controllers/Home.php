<?php
class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
    }

    public function index()
    {

        $header =  array();
        $this->CommonModel->add_titie($header, "Home");
        $this->load->view("Commons/Header", $header);


        $this->load->view('Home/Home');
        $this->load->view("Commons/Footer");
    }
}
