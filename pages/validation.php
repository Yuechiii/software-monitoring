<?php

//import model

$page['page'] = 'login';
$page['sub_page'] = isset($_GET['sub_page']) ? $_GET['sub_page'] : 'login';
session_start();

if (!isset($_SESSION['user_id'])) {
    try {
        if (isset($_GET['function'])) {
            new LoginActive($page);
        } else {
            new Login($page);
        }
    } catch (Throwable $e) {
        echo '<h1>ERROR 404</h1>';
        echo $e->getMessage();
    }
} else {
    http_response_code(403);
    echo '<h1>ERROR 403 - FORBIDDEN</h1>';
}



class Login
{
    //default page info
    private $page = '';
    private $sub_page = '';

    function __construct($page)
    {
        //assign variable value
        $this->page = $page['page'];
        $this->sub_page = $page['sub_page'];

        //this will look and execute a function inside this class
        $this->{$page['sub_page']}();
    }

    function login()
    {
       
        include '../views/login.php';
    }
}

class LoginActive
{
    private $page = '';
    private $sub_page = '';

    function __construct($page)
    {
        //assign variable value
        $this->page = $page['page'];
        $this->sub_page = $page['sub_page'];

        //this will look execute a function inside this class
        $this->{$page['sub_page']}();
    }

    //NAVIGATION
  
}
