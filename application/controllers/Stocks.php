<?php
class Stocks extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("CommonModel", "StockModel"));
    }

    public function index()
    {

        $header =  array();
        $this->CommonModel->addTitie($header, "Stock");
        $this->load->view("Commons/Header", $header);

        $data = array();
        $data['products'] = $this->StockModel->getProductsFromDatabase();

        $this->load->view('Stocks/Stock', $data);
        $this->load->view("Commons/Footer");
    }

    public function addProduct()
    {

        $header =  array();
        $this->CommonModel->addTitie($header, "Stock");
        $this->load->view("Commons/Header", $header);


        $this->load->view('Stocks/AddProduct');
        $this->load->view("Commons/Footer");
    }

    public function product()
    {

        $productID = $this->input->get('id');
        $product = $this->StockModel->getThisProduct($productID);

        if ($product == null) {

            echo "Bad Request";
            return;
        }

        $header =  array();
        $this->CommonModel->addTitie($header, "Stock");
        $this->load->view("Commons/Header", $header);

        $data['product'] = $product;
        $data['stocks'] = $this->StockModel->getStocksOfThisProduct($productID);


        $this->load->view('Stocks/Product', $data);
        $this->load->view("Commons/Footer");
    }

    public function checkOut()
    {

        $stockId = $this->input->get('id');


        $stock = $this->StockModel->getThisStock($stockId);
        if ($stock == null) {
            echo "Bad Request";
            return;
        }

        $product = $this->StockModel->getThisProduct($stock->product_id);
        if ($product == null) {
            echo "Bad Request";
            return;
        }


        $header =  array();
        $this->CommonModel->addTitie($header, "Stock");
        $this->load->view("Commons/Header", $header);

        $data['product'] = $product;
        $data['stock'] = $stock;
        $data['checkOuts'] = $this->StockModel->getCheckOutsOfThisStock($stockId);
        $data['employees'] = $this->StockModel->getAllWorkingEmployees();

        foreach ($data['checkOuts'] as  $c) {

            echo "<br>";
            print_r($c);
            echo "<br>";
        }




        $this->load->view('Stocks/CheckOut', $data);
        $this->load->view("Commons/Footer");
    }


    public function checkIn()
    {

        $stockId = $this->input->get('id');


        $stock = $this->StockModel->getThisStock($stockId);
        if ($stock == null) {
            echo "Bad Request";
            return;
        }

        $product = $this->StockModel->getThisProduct($stock->product_id);
        if ($product == null) {
            echo "Bad Request";
            return;
        }


        $header =  array();
        $this->CommonModel->addTitie($header, "Stock");
        $this->load->view("Commons/Header", $header);

        $data['product'] = $product;
        $data['stock'] = $stock;
        $data['checkIns'] = $this->StockModel->getCheckInsOfThisStock($stockId);


        $this->load->view('Stocks/CheckIn', $data);
        $this->load->view("Commons/Footer");
    }


    // AJAX Methods

    public function addNewProduct()
    {

        if ($_POST) {

            if (isset($_FILES['product_image_file']['name'])) {

                $customTask = $this->CommonModel->uploadThisImage($_FILES, "product_image_file", "images");

                if ($customTask->hasError()) {

                    print_r((new CustonResponse('error', $customTask->error()))->toJSON());
                    return;
                } else {

                    $_POST['image_link'] = $customTask->data;
                }
            }

            $product = $this->CommonModel->getProductFromArray($_POST);

            if ($product->verifyForAdding()) {

                if ($this->CommonModel->forEdit($product)) {

                    print_r($this->StockModel->updateProductInDatabase($product)->toJSON());
                } else {

                    print_r($this->StockModel->addProductInDatabase($product)->toJSON());
                }
            } else {

                print_r(json_encode(new CustonResponse('error', 'Product data failed to be verified')));
            }
        } else {
            print_r(json_encode(new CustonResponse('error', 'Wrong Method Invocation')));
        }
    }

    public function addNewStock()
    {

        if ($_POST) {

            $stock = $this->CommonModel->getStockFromArray($_POST);

            if ($stock->verifyForAdding()) {

                print_r($this->StockModel->addStockInDatabase($stock)->toJSON());
            } else {

                print_r(json_encode(new CustonResponse('error', 'Stock data failed to be verified')));
            }
        } else {
            print_r(json_encode(new CustonResponse('error', 'Wrong Method Invocation')));
        }
    }

    public function addCheckIn()
    {

        if ($_POST) {

            $cin = $this->CommonModel->getCheckInFromArray($_POST);


            if ($cin->verifyForAdding()) {


                print_r($this->StockModel->addCheckInInDatabase($cin)->toJSON());
            } else {

                print_r(json_encode(new CustonResponse('error', 'Stock data failed to be verified')));
            }
        } else {
            print_r(json_encode(new CustonResponse('error', 'Wrong Method Invocation')));
        }
    }

    public function addCheckOut()
    {

        if ($_POST) {

            $cout = $this->CommonModel->getCheckOutFromArray($_POST);

            if ($cout->verifyForAdding()) {

                print_r($this->StockModel->addCheckOutInDatabase($cout)->toJSON());
            } else {

                print_r(json_encode(new CustonResponse('error', 'Stock data failed to be verified')));
            }
        } else {
            print_r(json_encode(new CustonResponse('error', 'Wrong Method Invocation')));
        }
    }

    public function addCheckOutReturn()
    {

        if ($_POST) {

            $coutr = $this->CommonModel->getCheckOutReturnFromArray($_POST);

            if ($coutr->verifyForAdding()) {

                print_r($this->StockModel->addCheckOutReturnInDatabase($coutr)->toJSON());
            } else {

                print_r(json_encode(new CustonResponse('error', 'Stock data failed to be verified')));
            }
        } else {
            print_r(json_encode(new CustonResponse('error', 'Wrong Method Invocation')));
        }
    }

    public function deleteCheckIn()
    {

        if ($_POST) {

            $cin = $this->CommonModel->getCheckInFromArray($_POST);

            if ($cin->verifyForDeleting()) {

                print_r($this->StockModel->deleteCheckInInDatabase($cin)->toJSON());
            } else {

                print_r(json_encode(new CustonResponse('error', 'CheckIn data failed to be verified')));
            }
        } else {
            print_r(json_encode(new CustonResponse('error', 'Wrong Method Invocation')));
        }
    }

    public function deleteCheckOut()
    {

        if ($_POST) {

            $cout = $this->CommonModel->getCheckInFromArray($_POST);

            if ($cout->verifyForDeleting()) {

                print_r($this->StockModel->deleteCheckOutInDatabase($cout)->toJSON());
            } else {

                print_r(json_encode(new CustonResponse('error', 'CheckOut data failed to be verified')));
            }
        } else {
            print_r(json_encode(new CustonResponse('error', 'Wrong Method Invocation')));
        }
    }
}
