<?php
class clients
{
    private $id;
    private $l_name;
    private $f_name;
    private $email;
    private $phone;
    private $city;
    private $postal_code;
    private $address;
    private $id_permission;
    private $check_account;

    function __construct($_id, $_l_name, $_f_name, $_email, $_phone, $_city, $_postal_code, $_address, $_id_permission, $_check_account){
        $this->id = $_id;
        $this->l_name = $_l_name;
        $this->f_name = $_f_name;
        $this->email = $_email;
        $this->phone = $_phone;
        $this->city = $_city;
        $this->postal_code = $_postal_code;
        $this->address = $_address;
        $this->id_permission = $_id_permission;
        $this->check_account = $_check_account;
    }

    public function getID(){
        return $this->id;
    }

    public function getLname(){
        return $this->l_name;
    }

    public function getFname(){
        return $this->f_name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function getCity(){
        return $this->city;
    }

    public function getPostalcode(){
        return $this->postal_code;
    }

    public function getAddress(){
        return $this->address;
    }

    public function getIDPermission(){
        return $this->id_permission;
    }

    public function getCheckAccount(){
        return $this->check_account;
    }

    public function setID($_id){
        $this->id = $_id;
    }

    public function setLname($_l_name = null){
        $this->l_name = $_l_name;
    }

    public function setFname($_f_name){
        $this->f_name = $_f_name;
    }

    public function setEmail($_email){
        $this->email = $_email;
    }

    public function setPhone($_phone){
        $this->phone = $_phone;
    }

    public function setCity($_city){
        $this->city = $_city;
    }

    public function setPostalcode($_postal_code){
        $this->postal_code = $_postal_code;
    }

    public function setAddress($_address){
        $this->address = $_address;
    }

    public function setIDPermission($_id_permission){
        $this->id_permission = $_id_permission;
    }

    public function setCheckAccount($_check_account){
        $this->check_account = $_check_account;
    }
}
?>