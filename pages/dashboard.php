<?php
// Start a secure session
session_start([
    'cookie_secure' => isset($_SERVER['HTTPS']), // Only send cookie over HTTPS
    'cookie_httponly' => true,                   // JS cannot access session cookie
    'cookie_samesite' => 'Strict',              // Prevent CSRF
]);

//import model
require_once "../config/define.php";
require_once "include-model.php";

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
        $model = new SelectModel();

        $deadline_container = $model->getUpcomingDeadlines();
        $upcoming_deadlines = is_array($deadline_container) ? $deadline_container : [];

        // FOR NUMBER OF TASKS
        $task_overview = $model->getTaskOverview();
        $delayed_overview = $model->getDelayedOverview();
        $overview_container = $model->getOverview();

        $completed_this_week = $model->getCompletedThisWeek();
        $Completed_tasks  = count($completed_this_week);


        //PENDING TASK VIEW
        $pending_overview = $model->getPendingOverview();


        $Number_of_task   = $model->getTasks();
        $Delayed_tasks    = array_sum(array_column($overview_container, 'total_delayed'));
        $Pending_reviews  = array_sum(array_column($overview_container, 'total_pending'));




        // THIS IS FOR THE PROGRAMMER DETAILS 
        $temp_programmer_details = $model->getProgrammerDetails($_GET['id'] ?? '');
        $programmer_details = is_array($temp_programmer_details) ? $temp_programmer_details : [];


        $grouped_deadlines = [];

        foreach ($upcoming_deadlines as $row) {
            $key = $row['project_code']; // unique per project

            if (!isset($grouped_deadlines[$key])) {
                $grouped_deadlines[$key] = $row;
                $grouped_deadlines[$key]['programmers'] = [];
            }

            $grouped_deadlines[$key]['programmers'][] = $row['programmer_name'];
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

    public function AddNewProject()
    {
        $model = new InsertModel();

        $project_name = isset($_POST['project_name']) ? $_POST['project_name'] : '';

        $result = $model->InsertProjectName($project_name);

        header("location: ./dashboard.php");
    }

    public function DeleteDeadline()
    {
        header('Content-Type: application/json');

        try {
            // 1. Validate input
            if (!isset($_POST['deadline_id']) || empty($_POST['deadline_id'])) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Missing deadline ID.'
                ]);
                return;
            }

            $deadlineId = (int) $_POST['deadline_id'];

            // 2. Call model (adjust to your model name)
            $model = new DeleteModel(); // or $this->model
            $deleted = $model->deleteDeadlineById($deadlineId);

            if ($deleted) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Deadline deleted successfully.'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to delete deadline.'
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
