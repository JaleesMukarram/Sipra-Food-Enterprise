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
        $this->CommonModel->addTitie($header, "Employees");
        $this->load->view("Commons/Header", $header);


        $data = array();
        $data['employees'] = $this->EmployeesModel->getEmployeesFromDatabase();
        $this->load->view('Employees/Employees', $data);
        $this->load->view("Commons/Footer");
    }

    public function addEmployee()
    {

        $header =  array();
        $this->CommonModel->addTitie($header, "Employees");
        $this->load->view("Commons/Header", $header);

        $data = array();

        if ($this->input->get('id')) {

            $data['employee'] = $this->EmployeesModel->getThisEmployee($this->input->get('id'));
        }

        $this->load->view('Employees/AddEmployees', $data);
        $this->load->view("Commons/Footer");

        return 1;
    }

    public function employee()
    {

        $employeeID = $this->input->get('id');
        $employee = $this->EmployeesModel->getThisEmployee($employeeID);



        $header =  array();
        $this->CommonModel->addTitie($header, "Employees");
        $this->load->view("Commons/Header", $header);


        $data = array();
        $data['employee'] = $employee;
        $data['id'] = $employeeID;
        $this->load->view('Employees/Employee', $data);
        $this->load->view("Commons/Footer");
    }

    // AJAX Methods

    public function addNewEmployee()
    {

        if ($_POST) {

            $emp = $this->CommonModel->getEmployeeFromArray($_POST);

            if ($emp->verifyForAdding()) {

                if ($this->CommonModel->forEdit($emp)) {

                    print_r($this->EmployeesModel->updateEmployeeToDatabase($emp)->toJSON());
                } else {

                    print_r($this->EmployeesModel->addEmployeeToDatabase($emp)->toJSON());
                }
            } else {

                print_r(json_encode(new CustonResponse('error', 'Employee data failed to be verified')));
            }
        } else {
            print_r(json_encode(new CustonResponse('error', 'Wrong Method Invocation')));
        }
    }
}
