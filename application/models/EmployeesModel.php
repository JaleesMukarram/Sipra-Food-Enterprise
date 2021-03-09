<?php

class EmployeesModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function addEmployeeToDatabase(Employee $emp)
    {

        $result = $this->db->insert(TABLE_EMPLOYEE, $emp);
        return $result;
    }

    public function getEmployeesFromDatabase(){

        $query = $this->db->get(TABLE_EMPLOYEE);
        return $query->result(Employee::class);
    }
}
