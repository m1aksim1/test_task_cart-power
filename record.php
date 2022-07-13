<?php
include 'config.php';
include "function.php";
if(isset($_POST['createTask'])){
    createTask($_POST['email'],$_POST['username'],$_POST['task']);
}
else if(isset($_POST['forAdmin'])) {
    if($_POST['admin_login'] == $admin_login and $_POST['admin_password'] == $admin_password){
        session_start();
        $_SESSION['admin_mode'] = 1;
    }
    goToPage(0);
}
else if(isset($_POST['forAdmin_exit'])){
    session_start();
    $_SESSION['admin_mode'] = 0;
    goToPage(0);
}
else if(isset($_POST['page_input'])) {
    $page = $_POST['page_input'];
    goToPage($page);
}
if(isset($_POST['sort'])) {
    session_start();
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['admin_edit'] = $_POST['admin_edit'];
    $_SESSION['completed'] = $_POST['completed'];
    goToPage(0);
}
if(isset($_POST['admin_edit'])){
    changeTask($_GET['id'],$_POST['task_text'],$_POST['completed']);
    goToPage(0);
}
?>