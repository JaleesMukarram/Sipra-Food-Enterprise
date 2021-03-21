<?php

class StockModel extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    public function getThisProduct($id)
    {

        $query = $this->db->get_where(TABLE_PRODUCTS, array('id' => $id));

        if ($query->result()) {
            return $query->result(Product::class)[0];
        } else {
            return null;
        }
    }

    public function getThisStock($id)
    {

        $query = $this->db->get_where(TABLE_STOCKS, array('id' => $id));

        if ($query->result()) {
            return $query->result(Stock::class)[0];
        } else {
            return null;
        }
    }

    public function getStocksOfThisProduct($product_id)
    {

        $query = $this->db->get_where(TABLE_STOCKS, array('product_id' => $product_id));
        return $query->result(Product::class);
    }

    public function getCheckInsOfThisStock($stock_id)
    {

        $query = $this->db->get_where(TABLE_STOCK_IN, array('stock_id' => $stock_id));
        return $query->result(CheckIn::class);
    }


    public function getCheckOutsOfThisStock($stock_id)
    {

        $query = $this->db->select("SO.*, E.name,  SOR.return_date, SOR.status")
            ->join(TABLE_EMPLOYEE . " E", "SO.employee_id = E.id")
            ->join(TABLE_STOCK_OUT_RETURN . " SOR", "SO.id = SOR.stock_out_id", 'left')
            ->get_where(TABLE_STOCK_OUT . " SO", array('stock_id' => $stock_id));

        return $query->result(CheckOut::class);
    }


    public function getAllWorkingEmployees()
    {

        $this->load->model('EmployeesModel');
        return $this->EmployeesModel->getAllWorkingEmployees();
    }

    public function addProductInDatabase(Product $product)
    {
        $result = $this->db->insert(TABLE_PRODUCTS, $product);
        if ($result) {

            return new CustonResponse('done', 'Product Added Successfully');
        } else {

            return new CustonResponse('error', $this->db->error());
        }
    }

    public function addStockInDatabase(Stock $stock)
    {
        $result = $this->db->insert(TABLE_STOCKS, $stock);
        if ($result) {

            return new CustonResponse('done', 'Stock Added Successfully');
        } else {

            return new CustonResponse('error', $this->db->error());
        }
    }

    public function addCheckInInDatabase($cin)
    {
        $result = $this->db->insert(TABLE_STOCK_IN, $cin);
        if ($result) {

            return new CustonResponse('done', 'StockIn Added Successfully');
        } else {

            return new CustonResponse('error', $this->db->error());
        }
    }

    public function addCheckOutInDatabase($cout)
    {
        $result = $this->db->insert(TABLE_STOCK_OUT, $cout);
        if ($result) {

            return new CustonResponse('done', 'StockOut Added Successfully');
        } else {

            return new CustonResponse('error', $this->db->error());
        }
    }

    public function addCheckOutReturnInDatabase($coutr)
    {
        $result = $this->db->insert(TABLE_STOCK_OUT_RETURN, $coutr);
        if ($result) {

            return new CustonResponse('done', 'StockOut Return Added Successfully');
        } else {

            return new CustonResponse('error', $this->db->error());
        }
    }


    public function updateProductInDatabase(Product $product)
    {

        $this->db->where('id', $product->id);
        $result = $this->db->update(TABLE_PRODUCTS, $product);
        if ($result) {

            return new CustonResponse('done', 'Product Added Successfully');
        } else {

            return new CustonResponse('error', $this->db->error());
        }
    }

    public function getProductsFromDatabase()
    {

        $query = $this->db->get(TABLE_PRODUCTS);
        return $query->result(Product::class);
    }


    public function deleteCheckInInDatabase($cin)
    {
        $this->db->where('id', $cin->id);
        $result = $this->db->delete(TABLE_STOCK_IN);
        if ($result) {

            return new CustonResponse('done', 'CheckIn Deleted Successfully');
        } else {

            return new CustonResponse('error', $this->db->error());
        }
    }

    public function deleteCheckOutInDatabase($cout)
    {
        $this->db->where('id', $cout->id);
        $result = $this->db->delete(TABLE_STOCK_OUT);
        if ($result) {

            return new CustonResponse('done', 'CheckOut Deleted Successfully');
        } else {

            return new CustonResponse('error', $this->db->error());
        }
    }
}
