<?php
session_start();
//import model

require_once "../config/define.php";
require_once "include-model.php";

$page['page'] = 'programmers';
$page['sub_page'] = isset($_GET['sub_page']) ? $_GET['sub_page'] : $page['page'];
$page['f'] = isset($_GET['f']) ? $_GET['f'] : '';

if (isset($_SESSION['_SessionId'])) {
    try {
        if (isset($_GET['f'])) {
            new Methods($page);
        } else {
            new Programmers($page);
        }
    } catch (Throwable $e) {
        http_response_code(404);
        echo '<h1>ERROR 404</h1>';
        echo $e->getMessage();
    }
} else {
    header("Location: ./login.php");
}



class Programmers
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

    function programmers()
    {
        $active_page = "Programmers";
        $model = new SelectModel();

        $projects = is_array($model->GetAllProgrammers())
            ? $model->GetAllProgrammers()
            : [];
        require_once VIEWS_PAGES_PATH . "/programmers.php";
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



    public function AddNewProject()
    {
        $model = new InsertModel();

        $project_name = isset($_POST['project_name']) ? $_POST['project_name'] : '';

        $result = $model->InsertProjectName($project_name);

        header("location: ./project.php");
    }

    public function UpdateProject()
    {
        header('Content-Type: application/json; charset=utf-8');

        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data || empty($data['project_id']) || empty($data['project_name'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid request'
            ]);
            exit; // 🔴 REQUIRED
        }

        $model = new UpdateModel();
        $success = $model->UpdateProject(
            (int)$data['project_id'],
            trim($data['project_name'])
        );

        echo json_encode([
            'success' => $success
        ]);
        exit; // 🔴 REQUIRED — prevents header/footer rendering
    }

    public function DeleteProject()
    {
        header('Content-Type: application/json');

        try {
            // 1. Validate input
            if (!isset($_POST['project_id']) || empty($_POST['project_id'])) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Missing Project ID.'
                ]);
                return;
            }

            $projectId = (int) $_POST['project_id'];

            // 2. Call model (adjust to your model name)
            $model = new DeleteModel(); // or $this->model
            $deleted = $model->deleteProjectById($projectId);

            if ($deleted) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Project deleted successfully.'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to delete project.'
                ]);
            }
        } catch (Throwable $e) {
            // 3. Catch fatal errors
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Server error.',
                'error' => $e->getMessage() // remove in production
            ]);
        }
    }
}
