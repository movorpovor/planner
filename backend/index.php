<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");

    $keys = explode("/", key($_GET));
    include_once 'config/answer.php';
    $answer = new Answer();

    switch(array_shift($keys)) {
        case "actions":
            include_once 'controllers/actions_controller.php';
            $ac = new ActionController($answer);
            $ac->route($keys, $answer);
        break;
        default:
            $answer->setError('there is no such controller');
        break;
    }

    print_r(json_encode($answer));
?>