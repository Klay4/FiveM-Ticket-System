<?php

    session_start();

    $con = mysqli_connect('127.0.0.1', 'root', '', 'ticket');

    if(!$con) {
        echo 'Not Connected to Server';
    }

    $title = $_GET['title'];
    $content = $_GET['content'];
    $identifier = $_SESSION["identifier"];
    $name = $_SESSION["name"];

    $sql = "INSERT INTO users (identifier, name, title, content) VALUES ('$identifier', '$name', '$title', '$content')";

    if(!mysqli_query($con, $sql)) {
        echo 'FAIL';
    } else {
        echo 'OK';
    }

?>