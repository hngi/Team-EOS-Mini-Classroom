<?php    
  include 'lib/Session.php';
  Session::checkTeacherSession();

  spl_autoload_register(function($class){
    include_once "classes/".$class.".php";
  });

  $class = new ClassApp();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> Mathisi</title>
        <link rel="icon" href="Mini-class App designs/mathisi logo.png" type="image/png">
        <link rel="stylesheet" href="css/createClass.css">
        <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <style type="text/css">
          .success {
            background: #274970;
            color: white;
            padding: 10px;
            z-index: 30;
            width: 100%;
            margin: 20px auto;
          }
          .error {
            background: #C63305;
            color: white;
            padding: 10px;
            z-index: 30;
            width: 100%;
            margin: 20px auto;
          }
          .add {
            color: #fff; 
            padding: 20px;
            display: block;
            text-decoration: none;
            font-size: 20px;
          }
          .greeting {
            color: #C63305;
          }
    </style>
    </head>
    <body> 
        <?php
            if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                Session::destroy();
            }
        ?>  
                <!-- Header -->
                <header>
                    <a href="index.html"><img src="./Mini-class App designs/Logo.svg" class="logo" alt="Logo" width="15%">
                    </a>

                    <a href="?action=logout" class="sign-out-btn">Sign Out</a>

                </header>
                
                <div class="content">
                <!-- Body -->                 

                    <div class="content-field">
                        <!-- greeting -->
                        <h4 class="greeting">
                            Hello teacher <?php echo Session::get('teacherName'); ?>!
                        </h4>
                        <!-- End of greeting -->
                        <h2>Create Class</h2>

                        <?php
                            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                                $addClass = $class->addNewClass($_POST);
                            }
                          ?>
                          <?php 
                              if (isset($addClass)) {
                                echo $addClass;
                              }
                          ?>
                        <form class="cc-form" action="" method="POST">
                        <!---<label>Create class</label><br>-->
                            <input type="text" name="className" placeholder="Class Name" required> <br>
                            <button name="submit" class="create">Create</button>
                        </form>
                        <!-- Add items button -->
                        <button class="create">
                            <a href='add-items.php' style="text-decoration: none; color: #fff;">Add Items >></a>
                        </button>
                    </div>
                    <div class="content-img">
                        <img src="Mini-class App designs/undraw_teaching_f1cm.svg" width="60%">
                    </div>
                </div>
            <br>
    </body>
</html>