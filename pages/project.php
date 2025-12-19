<?php
session_start();
//import model

require_once "../config/define.php";
require_once "include-model.php";

$page['page'] = 'project';
$page['sub_page'] = isset($_GET['sub_page']) ? $_GET['sub_page'] : $page['page'];
$page['f'] = isset($_GET['f']) ? $_GET['f'] : '';

if (isset($_SESSION['_SessionId'])) {
    try {
        if (isset($_GET['f'])) {
            new Methods($page);
        } else {
            new Project($page);
        }
    } catch (Throwable $e) {
        http_response_code(404);
        echo '<h1>ERROR 404</h1>';
        echo $e->getMessage();
    }
} else {
    header("Location: ./login.php");
}



class Project
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

    function project()
    {
        $active_page = "Project";
        $model = new SelectModel();
        $deadlines = is_array($model->GetAllUpcomingDeadlines())
            ? $model->GetAllUpcomingDeadlines()
            : [];

        $projects = is_array($model->GetAllProjects())
            ? $model->GetAllProjects()
            : [];
        require_once VIEWS_PAGES_PATH . "/project.php";
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
}
