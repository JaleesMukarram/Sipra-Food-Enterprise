<?php
class CommonModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function add_titie(&$array, $headerTitle)
    {

        $array['title'] = $headerTitle;
    }

    public function getEmployeeFromArray($array): Employee
    {

        return Employee::makeEmployeeFromArray($array);
    }

    public function getProductFromArray($array)
    {

        return Product::makeProductFromArray($array);
    }

    public function uploadThisImage($FILES, $html_name, $path)
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

            print_r($this->upload->display_errors());


            return false;
        } else {

            return base_url('includes/uploads/' . $path . '/' . $file_name);
        }
    }


    public function getCompleteFileName($file_name)
    {

        $array = explode('.', $file_name);

        $time = time();

        if (count($array) > 1) {

            return $time . "." . $array[count($array) - 1];
        } else {

            return $time;
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

    public static function   makeEmployeeFromArray($array): Employee
    {

        $emp = new Employee();

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
    public string  $description;
    public string $image_link;
    public float $price;

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
            !$this->price
        ) {
            return false;
        }

        return true;
    }
}
