<?php
class Stock extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("CommonModel", "StockModel"));
    }

    public function index()
    {

        $header =  array();
        $this->CommonModel->add_titie($header, "Stock");
        $this->load->view("Commons/Header", $header);


        $this->load->view('Stock/Stock');
        $this->load->view("Commons/Footer");
    }

    public function addProduct()
    {

        $header =  array();
        $this->CommonModel->add_titie($header, "Stock");
        $this->load->view("Commons/Header", $header);


        $this->load->view('Stock/AddProduct');
        $this->load->view("Commons/Footer");
    }

    // AJAX Methods

    public function addNewProduct()
    {

        if ($_POST) {
            
			if (isset($_FILES['product_image_file']['name'])) {

				$_POST['image_link'] =  $this->CommonModel->uploadThisImage($_FILES, "product_image_file", "images");

			}


            $prod = $this->CommonModel->getProductFromArray($_POST);

            if ($prod->verifyForAdding()) {

                if ($this->StockModel->addProductToDatabase($prod)) {

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
