<?php    
  include 'lib/Session.php';
  Session::checkTeacherLogin();

  spl_autoload_register(function($class){
    include_once "classes/".$class.".php";
  });

  $teacher = new Teacher();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://res.cloudinary.com/dexcjehc5/image/upload/v1569397404/Logo" type="image/svg"
        sizes="16x16">
    <title>Teachers</title>

    <link rel="stylesheet" href="css/main.css">
    <!-- login css-->
    <link rel="stylesheet" href="css/teacherlogin.css">
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="css/classroom.css">
     <link rel="stylesheet" href="css/ham.css">
    
</head>
<body>
   <header class="main-header desk-nav">
      <div class="brand-container">
        <a class="brand-link" href="index.html"><img class="brand-image" src="Mini-class App designs/Logo.svg" class="" alt="Logo" ></a>
      </div>

      <nav class="main-nav">
          <ul class="main-nav__items">
              <li class="main-nav__item"><a href="index.html">Home</a></li>
              <li class="main-nav__item"><a href="about.html">About</a></li>
              <li class="main-nav__item"><a href="teacher-login.php">Teachers</a></li>
          </ul>
      </nav>
    </header>

    <!-- Mobile -->
    <header class="mobile-nav-header">
      <div class="moblie-header-cont">
          <a class="navbar-brand" href="index.html"><img style="width: 100px" src="images/Logo.svg" class="" alt="Logo"></a>

          <button class="toggle-button">
              <span class="toggle-button__bar"></span>
              <span class="toggle-button__bar"></span>
              <span class="toggle-button__bar"></span>
          </button>
      </div>

      <nav class="mobile-nav">
            <ul class="mobile-nav__items">
                <li class="main-nav__item"><a href="index.html">Home</a></li>
                <li class="main-nav__item"><a href="about.html">About</a></li>
                <li class="main-nav__item"><a href="teacher-login.php">Teachers</a></li>
            </ul>
        </nav>
    </header>