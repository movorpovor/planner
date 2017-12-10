<?php   
    class ActionController {

        private $db;

        public function __construct($answer){
            include_once 'config/database.php';
            include_once 'objects/action.php';
            $this->db = new Database($answer);
        }

        public function get($answer){
            $stmt = $this->db->getActions();

            if ($stmt){
                $answer->setResponse(Action::make_action_list_from_db($stmt));
            } else {
                $answer->setError('unable to execute query');
            }
        }

        function route($keys, $answer){
            if (count($keys) == 1) {
                switch($keys[0]) {
                    case 'get':
                        $this->get($answer);
                    break;
                    default:
                        $answer->setError('no such method');
                    break;
                }
            } else {
                $answer->setError('wrong controller');
            }
        }
    }
?>