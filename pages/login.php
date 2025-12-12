<?php
session_start();
//import model

$page['page'] = 'login';
$page['sub_page'] = isset($_GET['sub_page']) ? $_GET['sub_page'] : 'login';
$page['f'] = isset($_GET['f']) ? $_GET['f'] : '';

if (!isset($_SESSION['_SessionId'])) {
    try {
        if (isset($_GET['f'])) {
            new LoginActive($page);
        } else {
            new Login($page);
        }
    } catch (Throwable $e) {
        echo '<h1>ERROR 404</h1>';
        echo $e->getMessage();
    }
} else {
    header("Location: ./dashboard.php");
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
        $this->{$page['sub_page']}(); //login();
    }

    function login()
    {
        $active_page = "Login";
        require_once "../views/login.php";
    }
}

class LoginActive
{
    private $page = '';
    private $sub_page = '';
    private $function = '';

    function __construct($page)
    {
        //assign variable value
        $this->page = $page['page'];
        $this->sub_page = $page['sub_page'];
        $this->function = $page['f'];

        //this will look execute a function inside this class
        $this->{$page['f']}();
    }

    function validation()
    {

        if (isset($_POST['_username']) && isset($_POST['_password'])) {

            $username = $_POST['_username'];
            $password = $_POST['_password'];



            if ($username == "FSOV" || $password == "FSOV") {
                //set session
                $_SESSION['_SessionId'] = session_id();

                //redirect to dashboard
                header("Location: dashboard.php");
            } else {
                $msg = '<p class="text-red-500 text-sm">Invalid username or password.</p>';
                $active_page = "Login";
                require_once "../views/login.php";
            }
        } else {
            header("Location: ./login.php");
        }
    }
}
