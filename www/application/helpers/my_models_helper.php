<?php  
// if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Users{
    var $__table_name__ = 'users';
    var $userid = 'id';
    var $username = 'username';
    var $password = 'password';
}
// class My_models{

//     public function doit(){
//         // self::$users = new Users;
//         $this->users = 123;
//         return $this;
//     }

// }
// $models = new My_models();

class My_models{
    public function __construct() {
        $this->users = new Users();
    }

}

function get_my_models(){

    $my_models = array(
        "users"=>array(
            "__table_name__"=> "users",
            "userid"=> "id",
            "username"=> "username",
            "password"=> "password",
            ),
        );

    // return $my_models;
    return new My_models();
}

?>