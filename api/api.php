<?php

include_once "../models/connector.php";
include_once "../models/select-model.php";

class API
{
    private string $baseUrl = 'http://192.168.23.66/software-daily-report-php/public.api.php';
    private int $connectionTimeout = 1;
    private int $timeout = 1;

    public function __construct()
    {
        // Get action from GET parameter
        $action = $_GET['action'] ?? '';

        // Stop if action is empty
        if ($action === '') {
            $this->respond(['error' => 'No action specified']);
            exit;
        }

        // Stop if method does not exist
        if (!method_exists($this, $action)) {
            $this->respond(['error' => 'Invalid action']);
            exit;
        }

        // Call the requested method
        $result = $this->{$action}();

        // Respond with JSON
        $this->respond($result);
    }

    /* ---------------------------------------------------------
     | INTERNAL CURL HELPER
     |---------------------------------------------------------*/
    private function request(string $method, string $action, array $data = []): array
    {
        $url = $this->baseUrl . '?action=' . $action;

        $ch = curl_init($url);

        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => $this->connectionTimeout,
            CURLOPT_TIMEOUT        => $this->timeout,
        ];

        if ($method === 'POST') {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = http_build_query($data);
            $options[CURLOPT_HTTPHEADER] = [
                'Content-Type: application/x-www-form-urlencoded'
            ];
        }

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);

        if ($response === false) {
            curl_close($ch);
            $model = new SelectModel(); // graceful fallback
            switch ($action) {
                case "getUniqueGroupName":
                    // return $model->getUniqueGroupName();
                case "getProjectNames":
                    $group = $data['group_name'] ?? '';
                    // return $model->getProjectNames($group);
            }
        }

        curl_close($ch);

        $decoded = json_decode($response, true);

        return is_array($decoded['j'] ?? null) ? $decoded['j'] : [];
    }

    /* ---------------------------------------------------------
     | HELPER TO SEND JSON RESPONSE
     |---------------------------------------------------------*/
    private function respond($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /* ---------------------------------------------------------
     | GET UNIQUE GROUP NAMES
     |---------------------------------------------------------*/
    public function getGroupNames(): array
    {
        $data = $this->request('GET', 'getUniqueGroupName');

        $groups = [];
        foreach ($data as $row) {
            if (isset($row['group_name'])) {
                $groups[] = ['group_name' => $row['group_name']];
            }
        }
        return $groups;
    }

    /* ---------------------------------------------------------
     | GET PROJECT NAMES BY GROUP
     |---------------------------------------------------------*/
    public function getProjectNames(): array
    {
        // Expect group_name from GET or POST
        $groupName = $_GET['group_name'] ?? $_POST['group_name'] ?? '';
        if ($groupName === '') return [];

        return $this->request('POST', 'getProjectNames', ['group_name' => $groupName]);
    }
}

// Instantiate API to automatically handle the request
new API();
