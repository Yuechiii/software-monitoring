<?php
session_start();
//import model

require_once "../config/define.php";
require_once "../models/dashboard-model.php";

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
    header("Location: ./index.php");
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
        $model = new DashboardModel();

        if (empty($deadlines)) {
            $deadlines = [];
        }
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


    function delete_deadline()
    {
        // Set header so JS knows to expect JSON
        header('Content-Type: application/json');

        $id = $_POST['deadline_id'] ?? null;

        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'No ID provided.']);
            return;
        }

        // --- Database Logic Start ---
        // Replace this block with your actual SQL execution
        // Example:
        // $stmt = $this->db->prepare("DELETE FROM deadlines WHERE id = ?");
        // $executed = $stmt->execute([$id]);

        $executed = true; // Simulating success
        // --- Database Logic End ---

        if ($executed) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database deletion failed.']);
        }
        exit; // Prevent any further output from the script
    }
}
