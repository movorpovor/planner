<?php
    /*
        Объект action в представлении jSon имеет следующую структуру:
        {
            "id": 1,
            "day": {
                "id": 1,
                "date": "2017:26:11",
                "type": {
                    "id": 1,
                    "name": "period"
                },
                "dayOff": true
            },
            "action": {
                "id": 1,
                "name": "имя действия",
                "description": "описание действия",
                "type": {
                    "id": 1,
                    "name": "имя типа",
                    "description": "описание действия",
                    "color": "0x213445"
                }
            },
            "duration": 120
        }
    */
    class Action {
        public $id;
        public $day;
        public $action;
        public $duration;

        public function __construct($id, $day, $action, $duration){
            $this->id = $id;
            $this->day = $day;
            $this->action = $action;
            $this->duration = $duration;
        }

        public static function make_action_list_from_db($stmt){
            $actions_arr = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
        
                $action_type = Action::make_at_object($at_id, 
                                                     $at_name, 
                                                     $at_description,
                                                     $at_color);

                $action = Action::make_action_object($a_id, 
                                                    $a_name, 
                                                    $a_description, 
                                                    $action_type);
                    
                $type_of_day = Action::make_tod_object($tod_id, $tod_name);

                $day = Action::make_day_object($d_id,
                                              $d_date,
                                              $d_dayOff,
                                              $type_of_day);

                $days_action = new Action($da_id,
                                          $day,
                                          $action,
                                          $da_duration);

                array_push($actions_arr, $days_action);
            }

            return $actions_arr;
        }

        private static function make_at_object($id, $name, $description, $color){
            return array(
                "id" => $id,
                "name" => $name,
                "description" => $description,
                "color" => $color    
            );
        }

        private static function make_action_object($id, $name, $description, $type){
            return array(
                "id" => $id,
                "name" => $name,
                "description" => $description,
                "type" => $type
            );
        }

        private static function make_tod_object($id, $name){
            return array(
                "id" => $id,
                "name" => $name
            );
        }

        private static function make_day_object($id, $date, $dayOff, $type_of_day){
            return array(
                "id" => $id,
                "date" => $date,
                "dayOff" => $dayOff,
                "type" => $type_of_day
            );
        }
    }
?>