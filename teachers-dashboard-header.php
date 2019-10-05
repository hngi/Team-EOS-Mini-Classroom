<?php    
  include 'lib/Session.php';
  Session::checkTeacherSession();
  include 'helpers/Format.php';

  spl_autoload_register(function($class){
    include_once "classes/".$class.".php";
  });

  $class = new ClassApp(); 
  $student = new Student();
  $fm = new Format()
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mathisi Announcement</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/hh.css">
 
</head>
<body>
  <?php
    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        Session::destroy();
    }
  ?>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">

     

      <img src="./images/logo.png" alt="Avatar" class="profile">
      <p class="pn"><strong>Mathisi Teacher Dashboard</strong> </p>
      <ul class="nav nav-pills nav-stacked" style="padding-top: 20px">
        <li class="active" style="color: white"><a href="teachers-dashboard.php"> <img class="side" src="./images/ic-round-notifications-none.png"> Announcements</a></li>
        <li><a href="banned-student.php" class="cl"> <img  class="side" src="./images/whh-student.png"> Students</a></li>
        <li><a href="create-class.php" class="cl"> <img class="side" src="./images/mdi-teach.png"> Classes</a></li>
        <li><a href="add-items.php" class="cl"> <img class="side" src="./images/foundation-book.png"> Materials</a></li>
      </ul><br>
      </div> 

    <div class="col-lg-9" style="padding-top: 50px">
       <img src="./images/logo.png" alt="Mathisi Logo" class="logo">
       <!-- logout button -->
       <a href="?action=logout" title="Logout"><img src="./images/feather-settings.png" class="set"></a>
     
      <hr>
      <!-- greeting -->
      <h3 class="label label-danger">Hello teacher <?php echo Session::get('teacherName'); ?>!</h3>
      <button class="btn btn-warning"><a href="attendance.php" title="Students' Attendance Page" class="btn btn-warning">Check Students' Attendance</a></button>
      <hr>