<?php
session_start();


        // Enabling error reporting
        error_reporting(-1);
        ini_set('display_errors', 'On');

        require_once __DIR__ . '/firebase.php';
        require_once __DIR__ . '/push.php';

        $firebase = new Firebase();
        $push = new Push();

        // optional payload
        $payload = array();
        $payload['app'] = 'Firebase Notify';
        $payload['version'] = '1.2';

        // notification title
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        
        // notification message
        $message = isset($_POST['message']) ? $_POST['message'] : '';
        
        // push type - single user / topic
        $push_type = isset($_POST['push_type']) ? $_POST['push_type'] : '';
        
        // whether to include to image or not
       // $include_image = isset($_POST['include_image']) ? TRUE : FALSE;
       
        $target_dir = "image/";
        $push->setTitle($title);
        $push->setMessage($message);
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
       
        if(isset($_POST["submit"])){
            
           
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $push->setImage("https://localhost/firebase/".$target_file);
            }else {
                $push->setImage('');
            }

        }else {
            $push->setImage('');
          }

          
       
        $push->setIsBackground(FALSE);
        $push->setPayload($payload);


        $json = '';
        $response = '';

        if ($push_type == 'topic') {
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $json);
            
            $_SESSION["response"] = $response;
            $_SESSION["json"] = $json;
            header('location: index.php');
        } 
        ?>