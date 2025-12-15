<?php
session_start();
//import model

require_once "../config/define.php";

$page['page'] = 'dashboard';
$page['sub_page'] = isset($_GET['sub_page']) ? $_GET['sub_page'] : $page['page'];
$page['f'] = isset($_GET['f']) ? $_GET['f'] : '';

if (isset($_SESSION['_SessionId'])) {
    try {
        if (isset($_GET['f'])) {
            new Methods($page);
        } else {
            new Dashboard($page);
        }
    } catch (Throwable $e) {
        http_response_code(404);
        echo '<h1>ERROR 404</h1>';
        echo $e->getMessage();
    }
} else {
    header("Location: ./login.php");
}



class Dashboard
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

    function dashboard()
    {
        $active_page = "Dashboard";
        $programmers_tbl = null;
        $programmers_tbl = [
            ['Programmer' => 'Alice', 'TOTAL_PROJECTS' => 5],
            ['Programmer' => 'Bob', 'TOTAL_PROJECTS' => 3],
            ['Programmer' => 'Charlie', 'TOTAL_PROJECTS' => 8],
        ];
        require_once VIEWS_PAGES_PATH . "/dashboard.php";
    }
}

class Methods
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

        //this will look and execute a function inside this class
        $this->{$page['f']}(); //validation();
    }
}
