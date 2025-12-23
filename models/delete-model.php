<?php

class DeleteModel extends Connector
{
    public function __construct()
    {
        parent::__construct();
    }

    public function deleteDeadlineById(int $id): bool
    {
        $sql = "DELETE FROM upcoming_deadlines WHERE upcoming_deadline_id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function  deleteProjectById(int $id)
    {
        $sql = "DELETE FROM projects_tbl WHERE project_id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
