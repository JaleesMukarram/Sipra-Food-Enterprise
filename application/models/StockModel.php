<?php

class StockModel extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    public function addProductToDatabase(Product $product)
    {
        $result = $this->db->insert(TABLE_PRODUCTS, $product);
        return $result;
    }
}
