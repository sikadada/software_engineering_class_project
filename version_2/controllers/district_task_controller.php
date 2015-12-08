<?php
session_start();
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 11/25/15
 * Time: 10:51 AM
 */

if(filter_input (INPUT_GET, 'cmd')){
    $cmd = $cmd_sanitize = '';
    $cmd_sanitize = sanitize_string( filter_input (INPUT_GET, 'cmd'));
    $cmd = intval($cmd_sanitize);

    switch ($cmd){
        case 1:
            add_task_control();
            break;
        case 2:
            get_tasks_control();
            break;
        case 3:
            edit_task_control();
            break;
        case 4:
            get_task_control();
            break;
        default:
            echo '{"result":0, "message":"Invalid Command Entered"}';
            break;
    }
}

/**
 * function to get a particular task
 */
function get_task_control(){
    if( filter_input (INPUT_GET, 'id')){

        $obj = get_district_task_model();
        $id = sanitize_string(filter_input (INPUT_GET, 'id'));

        if ($obj->get_district_task($id)){
            echo '{"result":1, "district_tasks":[';
            $row = $obj->fetch();
            while($row){
                echo json_encode($row);
                if( $row = $obj->fetch()){
                    echo ',';
                }
            }
            echo ']}';
        }else{
            echo '{"result":0,"message": "query unsuccessful"}';
        }
    }
}

/**
 * function to get all tasks
 */
function get_tasks_control(){
    $obj = get_district_task();
    if ($obj->get_district_tasks_model()){
        echo '{"result":1, "district_tasks":[';
        $row = $obj->fetch();
        while($row){
            echo json_encode($row);
            if( $row = $obj->fetch()){
                echo ',';
            }
        }
        echo ']}';
    }else{
        echo '{"result":0,"message": "query unsuccessful"}';
    }
}

/**
 * controller method to add a task
 */
function add_task_control(){
    if( filter_input (INPUT_GET, 'task_title') && filter_input (INPUT_GET, 'task_desc')
        && filter_input (INPUT_POST, 'clinic') && filter_input (INPUT_POST, 'due_date')){

        $obj =  get_district_task_model();

        $taskTitle = sanitize_string(filter_input (INPUT_POST, 'task_title'));
        $taskDesc = sanitize_string(filter_input (INPUT_POST, 'task_desc'));
        $date = sanitize_string(filter_input (INPUT_POST, 'due_date'));
        $clinics  = sanitize_string(filter_input (INPUT_POST, 'clinic'));


        if ($obj->$obj->add_district_task($taskTitle, $taskDesc, $clinics, $date)){
            echo '{"result":1,"message": "task added successfully"}';
        }
        else
        {
            echo '{"result":0,"message": "unable to add task"}';
        }

    }
}




/**
 * @param $val
 * @return string
 */
function sanitize_string($val){
    $val = stripslashes($val);
    $val = strip_tags($val);
    $val = htmlentities($val);

    return $val;
}


/**
 * @return district_task
 */
function get_district_task_model(){
    require_once '../model/district_task.php';
    $obj = new district_task();
    return $obj;
}

