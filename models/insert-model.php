<?php

class InsertModel extends Connector
{
    public function __construct()
    {
        parent::__construct();
    }


    public function InsertDeadline($project_id, $deadline)
    {
        try {
            $sql = "INSERT INTO `upcoming_deadlines` (`project_id`, `deadline`) 
                VALUES (:project_id, :deadline)";

            $query = $this->conn->prepare($sql);
            $query->bindParam(':project_id', $project_id);
            $query->bindParam(':deadline', $deadline);

            $success = $query->execute(); // returns true on success, false on failure
            return $success;
        } catch (PDOException $e) {
            // Optionally log the error for debugging
            error_log("InsertDeadline Error: " . $e->getMessage());
            return false;
        }
    }
}
