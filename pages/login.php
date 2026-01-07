<?php

// Start a secure session
session_start([
    'cookie_secure' => isset($_SERVER['HTTPS']), // Only send cookie over HTTPS
    'cookie_httponly' => true,                   // JS cannot access session cookie
    'cookie_samesite' => 'Strict',              // Prevent CSRF
]);

//import model

require_once "../config/define.php";

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
        $active_page = "Login";
        if (isset($_POST['_username']) && isset($_POST['_password'])) {
            // $captcha = $_POST['cf-turnstile-response'];
            // $secretKey = '0x4AAAAAAAiTURhzxDj_vyra9lDTRn9w2MM';
            // $ip = $_SERVER['REMOTE_ADDR'];
            // if (!$captcha) {
            //     $message = "<div class='alert alert-error'>Please check the the captcha form.</div>";
            // } else {
            //     $url_path = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
            //     $data = array('secret' => $secretKey, 'response' => $captcha, 'remoteip' => $ip);

            //     $options = array(
            //         'http' => array(
            //             'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            //             'method' => 'POST',
            //             'content' => http_build_query($data)
            //         )
            //     );

            //     $stream = stream_context_create($options);
            //     $result = file_get_contents($url_path, false, $stream);
            //     $response = $result;
            //     $responseKeys = json_decode($response, true);

            //     if (intval($responseKeys["success"]) !== 1) {
            //         $message = "Failed, Captcha is incorrect.";
            //     } else {

            $url = 'http://idcsi-officesuites.com:8080/hrms/sso.php';

            $data = [
                'username' => $_POST['_username'],
                'password' => $_POST['_password'],
            ];

            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // form-data
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if ($response === false) {
                echo 'Curl error: ' . curl_error($ch);
            }

            curl_close($ch);

            //Decode the response
            $responseData = json_decode($response, true);

            $code = $responseData['code'] ?? null;
            $message = $responseData['message'] ?? '';
            $fullname = $responseData['message']['fullname'] ?? '';
            $department = $responseData['message']['department'] ?? '';

            if ($code === 0 && $department === "SOFTWARE") {
                // Successful login
                session_regenerate_id(true); // Regenerate ID and delete old one

                $_SESSION['_SessionId'] = session_id();
                $_SESSION['_Username'] = $fullname;
                header("Location: " . PAGES_PATH . "/dashboard.php");
                exit();
            }
            // }
            // }
        }
        require VIEWS_PAGES_PATH . '/login.php';
    }
}
