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

        if ($result) {

            return new CustonResponse('done', 'Employee Edited Successfully');
        } else {

            return new CustonResponse('error', $this->db->error());
        }
    }

    public function updateEmployeeToDatabase(Employee $emp)
    {

        $this->db->where('id', $emp->id);
        $result = $this->db->update(TABLE_EMPLOYEE, $emp);
        if ($result) {

            return new CustonResponse('done', 'Employee Edited Successfully');
        } else {

            return new CustonResponse('error', $this->db->error());
        }
    }

    public function getEmployeesFromDatabase()
    {

        $query = $this->db->get(TABLE_EMPLOYEE);
        return $query->result(Employee::class);
    }

    public function getAllWorkingEmployees()
    {

        $query = $this->db->get_where(TABLE_EMPLOYEE, array('working' => 1));
        return $query->result(Employee::class);
    }


    
    public function getThisEmployee($id)
    {

        $query = $this->db->get_where(TABLE_EMPLOYEE, array('id' => $id));

        if ($query->result()) {
            return $query->result(Employee::class)[0];
        } else {
            return null;
        }
    }
}
