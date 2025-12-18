<?php
session_start();
//import model
require_once '../models/connector.php';
require_once "../config/define.php";
require_once "../models/select-model.php";
require_once "../models/insert-model.php";
require_once "../models/update-model.php";

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
        $model = new SelectModel();

        $deadlines = is_array($model->GetAllUpcomingDeadlines())
            ? $model->GetAllUpcomingDeadlines()
            : [];

        $projects = is_array($model->GetAllProjects())
            ? $model->GetAllProjects()
            : [];


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


    public function AddDeadline()
    {
        $model = new InsertModel();

        $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : '';
        $deadline = isset($_POST['deadline']) ? $_POST['deadline'] : '';

        $result = $model->InsertDeadline($project_id, $deadline);

        header("location: ./dashboard.php");
    }

    public function UpdateDeadline()
    {

        header('Content-Type: application/json');

        // Get JSON data
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data || !isset($data['id'], $data['project_id'], $data['deadline'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }

        $model = new UpdateModel();
        $success = $model->UpdateDeadline($data['id'], $data['project_id'], $data['deadline']);

        echo json_encode(['success' => $success]);
    }
}
