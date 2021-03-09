<?php
class Employees extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('CommonModel', 'EmployeesModel'));
    }

    public function index()
    {


        $header =  array();
        $this->CommonModel->add_titie($header, "Employees");
        $this->load->view("Commons/Header", $header);


        $data = array();
        $data['employees'] = $this->EmployeesModel->getEmployeesFromDatabase();
        $this->load->view('Employees/Employees', $data);
        $this->load->view("Commons/Footer");

        return 1;
    }

    public function addEmployee()
    {


        $header =  array();
        $this->CommonModel->add_titie($header, "Employees");
        $this->load->view("Commons/Header", $header);

        $this->load->view('Employees/AddEmployees');
        $this->load->view("Commons/Footer");

        return 1;
    }

    // AJAX Methods

    public function addNewEmployee()
    {

        if ($_POST) {

            $emp = $this->CommonModel->getEmployeeFromArray($_POST);
            if ($emp->verifyForAdding()) {

                if ($this->EmployeesModel->addEmployeeToDatabase($emp)) {

                    echo 'done';
                } else {

                    echo 'failed';
                }
            } else {

                echo 'failed';
            }
        } else {
            echo "Something went wrong";
        }
    }
}
