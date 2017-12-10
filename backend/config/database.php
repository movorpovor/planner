<?php
    class Database{
        private $dbInfo;
        public $conn;

        public function __construct($answer){
            $this->conn = null;
            include_once 'databaseInfo.php';
            $this->dbInfo = new DatabaseInfo();

            try{
                $this->conn = new PDO('mysql:host=' . $this->dbInfo->host . ';dbname=' . $this->dbInfo->db_name, 
                    $this->dbInfo->username, 
                    $this->dbInfo->password);
                $this->conn->exec('set names utf8');
            } catch(PDOException $exception) {
                $answer->setError('Connection error: ' . $exception->getMessage());
            }
        }

        public function getActions(){
            $query = "
                SELECT
                    a_id, a_description, a_name,
                    at_id, at_name, at_description, at_color,
                    tod_id, tod_name,
                    d_id, d_date, d_dayOff,
                    da_id, da_duration
                FROM
                    days_actions
                LEFT JOIN days ON days_actions.da_day = days.d_id
                LEFT JOIN types_of_days ON days.d_type = types_of_days.tod_id
                LEFT JOIN actions ON days_actions.da_action = actions.a_id
                LEFT JOIN action_types ON actions.a_id = action_types.at_id";

            $stmt = $this->conn->prepare($query);

            if ($stmt->execute()) {
                return $stmt;
            } else {
                return false;
            }                
        }
    }
?>