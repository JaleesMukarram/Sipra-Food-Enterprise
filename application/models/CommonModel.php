<?php
class CommonModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function addTitie(&$array, $headerTitle): void
    {

        $array['title'] = $headerTitle;
    }

    public function getEmployeeFromArray($array): Employee
    {

        return Employee::makeEmployeeFromArray($array);
    }

    public function getProductFromArray($array): Product
    {

        return Product::makeProductFromArray($array);
    }

    public function getStockFromArray($array): Stock
    {

        return Stock::makeStockFromArray($array);
    }

    public function getCheckInFromArray($array): CheckIn
    {

        return CheckIn::makeCheckInFromArray($array);
    }

    public function getCheckOutFromArray($array): CheckOut
    {

        return CheckOut::makeCheckOutFromArray($array);
    }

    public function getCheckOutReturnFromArray($array): CheckOutReturn
    {

        return CheckOutReturn::makeCheckOutReturnFromArray($array);
    }

    public function uploadThisImage($FILES, $html_name, $path): CustomTask
    {

        $file_name = $this->getCompleteFileName($FILES[$html_name]['name']);


        $config['upload_path'] = './includes/uploads/' . $path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
        $config['max_size']  = '100000';
        $config['max_width']  = '102400';
        $config['max_height']  = '768000';
        $config['file_name'] = $file_name;


        $this->load->library('upload', $config);


        if (!$this->upload->do_upload('product_image_file')) {

            $returner =  new CustomTask(false);
            $returner->errorMessage = $this->upload->display_errors();
            return $returner;
        } else {

            $returner =  new CustomTask(true);
            $returner->data = base_url('includes/uploads/' . $path . '/' . $file_name);

            return $returner;
        }
    }

    public function getCompleteFileName($file_name): string
    {

        $array = explode('.', $file_name);

        $time = time();

        if (count($array) > 1) {

            return $time . "." . $array[count($array) - 1];
        } else {

            return $time;
        }
    }

    public function forEdit($object): bool
    {

        if (isset($object->id) && ($object->id > 0)) {
            return true;
        } else {
            return false;
        }
    }
}

class Employee
{

    public int $id = 0;
    public string $name = '';
    public string  $phone = '';
    public string $position = '';
    public float $salary = 0.0;
    public string $address = '';
    public string $joining_date = '';
    public bool $working = true;


    function __construct()
    {
    }

    public static function  makeEmployeeFromArray($array): Employee
    {

        $emp = new Employee();

        if (isset($array['id'])) {

            $emp->id = $array['id'];
        }

        if (isset($array['name'])) {

            $emp->name = $array['name'];
        }

        if (isset($array['phone'])) {

            $emp->phone = $array['phone'];
        }

        if (isset($array['position'])) {

            $emp->position = $array['position'];
        }

        if (isset($array['salary'])) {

            $emp->salary = $array['salary'];
        }

        if (isset($array['address'])) {

            $emp->address = $array['address'];
        }


        if (isset($array['joining_date'])) {

            $emp->joining_date = $array['joining_date'];
        }

        if (isset($array['working'])) {

            $emp->working = $array['working'];
        }


        return $emp;
    }

    public function verifyForAdding()
    {

        if (
            !$this->name ||
            !$this->phone ||
            !$this->position ||
            !$this->salary ||
            !$this->address ||
            !$this->joining_date
        ) {
            return false;
        }

        return true;
    }
}

class Product
{

    public int $id = 0;
    public string $name = '';
    public string  $description = '';
    public string $image_link = '';
    public float $price = -1;

    function __construct()
    {
    }

    public static function makeProductFromArray($array): Product
    {

        $product = new Product();


        if (isset($array['name'])) {

            $product->name = $array['name'];
        }

        if (isset($array['description'])) {

            $product->description = $array['description'];
        }

        if (isset($array['image_link'])) {

            $product->image_link = $array['image_link'];
        }

        if (isset($array['price'])) {

            $product->price = $array['price'];
        }


        return $product;
    }

    public function verifyForAdding()
    {

        if (
            !$this->name ||
            !$this->description ||
            !$this->image_link ||
            $this->price <= 0

        ) {
            return false;
        }

        return true;
    }
}

class Stock
{

    public $id = 0;
    public $amount = 0;
    public $name = '';
    public $product_id = 0;
    public $created_date = '';


    function __construct()
    {
    }

    public static function  makeStockFromArray($array): Stock
    {

        $stock = new Stock();

        if (isset($array['id'])) {

            $stock->id = $array['id'];
        }

        if (isset($array['amount'])) {

            $stock->amount = $array['amount'];
        }

        if (isset($array['name'])) {

            $stock->name = $array['name'];
        }

        if (isset($array['product_id'])) {

            $stock->product_id = $array['product_id'];
        }


        return $stock;
    }

    public function verifyForAdding()
    {

        if (
            !$this->name ||
            $this->product_id <= 0

        ) {
            return false;
        }

        return true;
    }
}

class CheckIn
{


    public $id = 0;
    public $amount = 0;
    public $stock_id = 0;
    public $stock_after = 0;
    public $detail = '';
    public $in_date = '';

    public static function makeCheckInFromArray($array): checkIn
    {

        $cin = new checkIn();


        if (isset($array['id'])) {

            $cin->id = $array['id'];
        }

        if (isset($array['amount'])) {

            $cin->amount = $array['amount'];
        }

        if (isset($array['stock_id'])) {

            $cin->stock_id = $array['stock_id'];
        }

        if (isset($array['detail'])) {

            $cin->detail = $array['detail'];
        }

        if (isset($array['in_date'])) {

            $cin->in_date = $array['in_date'];
        }



        return $cin;
    }

    public function verifyForAdding()
    {

        if (
            !$this->detail ||
            !$this->in_date ||
            $this->amount <= 0 ||
            $this->stock_id <= 0

        ) {
            return false;
        }

        return true;
    }

    public function verifyForDeleting()
    {

        if (
            !$this->id
        ) {
            return false;
        }

        return true;
    }
}

class CheckOut
{


    public $id = 0;
    public $amount = 0;
    public $stock_id = 0;
    public $stock_after = 0;
    public $detail = '';
    public $out_date = '';
    public $employee_id = 0;

    public static function makeCheckOutFromArray($array): CheckOut
    {

        $cout = new CheckOut();


        if (isset($array['id'])) {

            $cout->id = $array['id'];
        }

        if (isset($array['amount'])) {

            $cout->amount = $array['amount'];
        }

        if (isset($array['stock_id'])) {

            $cout->stock_id = $array['stock_id'];
        }

        if (isset($array['detail'])) {

            $cout->detail = $array['detail'];
        }

        if (isset($array['out_date'])) {

            $cout->out_date = $array['out_date'];
        }

        if (isset($array['employee_id'])) {

            $cout->employee_id = $array['employee_id'];
        }


        return $cout;
    }

    public function verifyForAdding()
    {

        if (
            !$this->detail ||
            !$this->out_date ||
            $this->amount <= 0 ||
            $this->stock_id <= 0 ||
            $this->employee_id <= 0

        ) {
            return false;
        }

        return true;
    }

    public function verifyForDeleting()
    {

        if (
            !$this->id
        ) {
            return false;
        }

        return true;
    }
}

class CheckOutReturn
{

    public $id = 0;
    public $amount = 0;
    public $status = '';
    public $detail = '';
    public $return_date = '';
    public $stock_out_id = 0;

    public static function makeCheckOutReturnFromArray($array): CheckOutReturn
    {

        $coutr = new CheckOutReturn();


        if (isset($array['id'])) {

            $coutr->id = $array['id'];
        }

        if (isset($array['amount'])) {

            $coutr->amount = $array['amount'];
        }

        if (isset($array['status'])) {

            $coutr->status = $array['status'];
        }

        if (isset($array['detail'])) {

            $coutr->detail = $array['detail'];
        }

        if (isset($array['return_date'])) {

            $coutr->return_date = $array['return_date'];
        }


        if (isset($array['stock_out_id'])) {

            $coutr->stock_out_id = $array['stock_out_id'];
        }


        return $coutr;
    }

    public function verifyForAdding()
    {

        if (
            !$this->detail ||
            !$this->return_date ||
            $this->amount < 0 ||
            $this->stock_out_id <= 0

        ) {
            return false;
        }

        return true;
    }
}



class CustonResponse
{

    public $status;
    public  $data;

    public function __construct($status, $data)
    {
        $this->status = $status;
        $this->data = $data;
    }

    public function toJSON()
    {
        return json_encode($this);
    }
}

class CustomTask
{

    public bool $success;
    public string $data = '';
    public string $errorMessage = '';


    public function __construct($success)
    {

        $this->success = $success;
    }

    public function hasError()
    {

        if ($this->errorMessage) {
            return true;
        } else {
            return false;
        }
    }

    public function error()
    {
        return $this->errorMessage;
    }
}
