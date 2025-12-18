<?php

class UpdateModel extends Connector
{
    public function __construct()
    {
        parent::__construct();
    }


    public function UpdateDeadline($id, $project_id, $deadline)
    {
        try {
            $sql = "UPDATE `upcoming_deadlines` 
                SET `project_id` = :project_id, `deadline` = :deadline
                WHERE `upcoming_deadline_id` = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':project_id', $project_id);
            $stmt->bindParam(':deadline', $deadline);
            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("UpdateDeadline Error: " . $e->getMessage());
            return false;
        }
    }
}
