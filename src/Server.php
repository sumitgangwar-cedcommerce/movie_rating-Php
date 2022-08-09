<?php
session_start();
    if (isset($_POST['title'])){ 
        $title = $_POST['title'];
        $rate = $_POST['rating'];
        $_SESSION['movie'][$title] = $rate;
        echo json_encode($_SESSION['movie']);
    }

    if (isset($_POST['delete_movie'])){ 
        $movie = $_POST['delete_movie'];
        unset($_SESSION['movie'][$movie]);
        echo json_encode($_SESSION['movie']);  
    }

    if (isset($_POST['sortAsec'])){
        if($_POST['sortAsec']=='t'){
            ksort($_SESSION['movie']);
            echo json_encode($_SESSION['movie']);
        }
        else{
            asort($_SESSION['movie']);
            echo json_encode($_SESSION['movie']);
        }
    }
    if (isset($_POST['sortDesc'])){
        if($_POST['sortDesc']=='t'){
            krsort($_SESSION['movie']);
            echo json_encode($_SESSION['movie']);
        }
        else{
            arsort($_SESSION['movie']);
            echo json_encode($_SESSION['movie']);
        }
    }

?>