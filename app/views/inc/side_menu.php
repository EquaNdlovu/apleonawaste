<?php
switch($_SESSION['user_type']) {
    case "Super User": //Supervisor User
        //require_once('side_menu_user.php');
        require_once APPROOT . '/views/inc/side_menu_admin.php';  
        break;
    case "User": //Regular User
        //require_once('side_menu_user.php');
        require_once APPROOT . '/views/inc/side_menu_admin.php';
        break;
    case "Admin": //admin nav
        //require_once('side_menu_supervisor.php');
        require_once APPROOT . '/views/inc/side_menu_admin.php';
        break;
    case "Client": //admin nav
        //require_once('side_menu_supervisor.php');
        require_once APPROOT . '/views/inc/side_menu_supervisor.php';
        break;
    //etc and default nav below
}
?>