<?php

//import model

require_once "../model/admin.model.php";

session_start();
$page['page'] = 'login';
$page['sub_page'] = isset($_GET['sub_page']) ? $_GET['sub_page'] : $page['page'];

if ($_SESSION["user_type"] == "admin") {
    if (isset($_GET['function'])) {
        try {
            new AuthActive($page);
        } catch (Throwable $e) {
            echo "Error 404: " . $e->getMessage();
        }
    } else {
        new Auth($page);
    }
} else {
    header("Location: ../index.php");
}


class Auth
{

    //default variables
    private $page = '';
    private $sub_page = '';

    function __construct($page)
    {
        //assign variable value
        $this->page = $page['page'];
        $this->sub_page = $page['sub_page'];

        //this will execute a function inside this class
        $this->{$page['sub_page']}();
    }


    function login(){
        include "../views/login.php";
    }
}

class AuthActive
{

    //default variables
    private $page = '';
    private $sub_page = '';

    function __construct($page)
    {
        //assign variable value
        $this->page = $page['page'];
        $this->sub_page = $page['sub_page'];

        //this will execute a function inside this class
        $this->{$page['sub_page']}();
    }


    function login(){
        include "../views/login.php";
    }
}

