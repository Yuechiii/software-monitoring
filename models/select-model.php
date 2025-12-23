<?php

class SelectModel extends Connector
{
    public function __construct()
    {
        parent::__construct();
    }


    public function GetAllProjects()
    {
        try {
            $sql = "SELECT * FROM projects_tbl";

            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function GetAllProgrammersWorkload()
    {
        try {
            $sql = "SELECT * FROM programmers_tbl";

            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function GetAllProgrammers()
    {
        try {
            $sql = "SELECT * FROM programmers_tbl";

            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function GetAllUpcomingDeadlines()
    {
        try {
            $sql = "SELECT * FROM upcoming_deadlines ORDER BY `deadline` ASC";

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
