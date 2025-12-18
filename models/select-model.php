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

    public function GetAllUpcomingDeadlines()
    {
        try {
            $sql = "SELECT * FROM upcoming_deadlines AS ud LEFT JOIN `projects_tbl` AS p ON ud.project_id = p.project_id ORDER BY `ud`.`deadline` ASC";

            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}
