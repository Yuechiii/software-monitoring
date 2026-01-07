<?php

class SelectModel extends Connector
{
    public function __construct()
    {
        parent::__construct();
    }



    function getUpcomingDeadlines()
    {
        try {
            $sql = "SELECT 
                        task_id,
                        programmer_idno,
                        programmer_name,
                        group_name,
                        project_name,
                        project_code,
                        status,
                        created_at,
                        deadline,
                        DATEDIFF(deadline, CURDATE()) AS remaining_days
                    FROM task_tbl
                    WHERE 
                        CURDATE() >= DATE_SUB(
                            deadline,
                            INTERVAL CEIL(DATEDIFF(deadline, created_at) * 0.30) DAY
                        )
                        AND CURDATE() <= deadline
                        AND status <> 'Completed'
                    ORDER BY remaining_days ASC;";

            $query = $this->conn->prepare($sql);
            $query->execute();

            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }


    function getOverview()
    {
        try {
            $sql = "SELECT * FROM overview";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    function getTasks()
    {
        try {
            $sql = "SELECT COUNT(*) as number_of_task FROM software_monitoring.task_view;";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    function getTaskOverview()
    {
        try {
            $sql = "SELECT * FROM software_monitoring.task_view;";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    function getDelayedOverview()
    {
        try {
            $sql = "SELECT * FROM software_monitoring.delayed_view;";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    function getProgrammerDetails($programmer_idno)
    {
        try {
            $sql = "SELECT * FROM task_tbl WHERE programmer_idno = :programmer_idno ORDER BY deadline ASC";
            $query = $this->conn->prepare($sql);
            $query->bindParam(':programmer_idno', $programmer_idno);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    function getCompletedThisWeek()
    {
        try {
            $sql = "SELECT *
                    FROM task_tbl
                    WHERE status = 'Completed'
                    AND YEARWEEK(completed_at, 1) = YEARWEEK(CURDATE(), 1);
                    ";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    // Get Pending Overview
    function getPendingOverview()
    {
        try {
            $sql = "SELECT *
                    FROM pending_view
                    ORDER BY deadline ASC;
                    ";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }


    // API SECTION

    public function getUniqueGroupName()
    {
        try {
            $sql = "SELECT DISTINCT group_name FROM software_monitoring.group_section order by group_name = 'GENERAL' DESC";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function getProjectNames($group_name) // Add parameter here
    {
        try {
            $sql = "SELECT DISTINCT project_name
                FROM software_monitoring.group_section
                WHERE group_name = :group_name";

            $query = $this->conn->prepare($sql);
            $query->bindParam(':group_name', $group_name);
            $query->execute();

            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}
