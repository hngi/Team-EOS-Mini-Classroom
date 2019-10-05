 <?php
    include 'lib/Session.php';
    Session::checkStudentSession();

    spl_autoload_register(function ($class) {
        include_once "classes/" . $class . ".php";
    });

    $class = new ClassApp();
    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="Mini-class App designs/mathisi logo.png" type="image/png">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="icon" href="https://res.cloudinary.com/dexcjehc5/image/upload/v1569397404/Logo" type="image/svg" sizes="16x16">
     <title>Mathisi Classroom</title>

     <style>
         @import url('https://fonts.googleapis.com/css?family=Lato&display=swap');

         body {
             background-image: url("Mini-class\ App\ designs/background.png");
             background-size: cover;
             background-position: top top;
             height: 100vh;
             font-family: 'Lato', sans-serif;
             position: relative;
         }

         .parent {
             display: grid;
             grid-template-columns: 0.5fr 9.5fr;
             grid-auto-rows: minmax(100px, auto);
         }

         header {
             display: flex;
             justify-content: space-between;
             align-items: center;
             padding: 30px 10%;
         }

         .sign-out-btn {
             text-decoration: none;
             background-color: #274970;
             color: #fff;
             padding: 9px 35px;
             border-radius: 30px;
         }

         .content {
             display: grid;
             grid-template-columns: 5.5fr 4.5fr;
             grid-auto-rows: minmax(100px, auto);
         }

         .chat-panel {
             border: 1px solid #274970;
             position: relative;
             margin-left: 25px;
             min-height: 650px;
             max-height: 650px;
             overflow: scroll;
         }

         #subject {
             font-family: Lato;
             color: #274970;
             margin: 25px auto 25px 25px;
             line-height: 29px;
         }

         hr {
             margin-right: 25px;
             border: 1px solid #274970;
         }

         .chat-item {
             background-image: url('https://res.cloudinary.com/dexcjehc5/image/upload/v1569406629/Rectangle.svg');
             background-repeat: no-repeat;
             background-size: contain;
             padding: 20px;
             background-size: contain;
             width: 60%;
             height: auto;
             float: left;
             margin-left: 15px;
         }

         .chat-form {
             position: absolute;
             bottom: 10px;
             width: 100%;
             height: 50px;
             display: grid;
             grid-template-columns: 4fr .5fr;
             grid-auto-rows: minmax(0px, auto);
             border: 1px solid #274970;
             border-left: none;
             border-right: none;
         }

         [placeholder] {
             font-family: Lato;
             font-size: 18px;
         }

         .chat-form button {
             background-color: #fff;
             border: none;
         }

         .chat-form input {
             border: none;
             padding: 5px;
         }

         .carousel {
             border: 1px solid #000;
             margin: 15px;
             width: auto;
         }

         #carousel-container {
             width: auto;
         }

         .arrows {
             display: flex;
             justify-content: center;
             align-items: center;
             cursor: pointer;
         }

         .arrows img {
             flex-shrink: 0;

         }

         .top-right {
             position: absolute;
             top: 0;
             right: 0;
         }

         .bottom-right {
             position: absolute;
             bottom: 0;
             right: 0;
         }

         /* Medium devices (landscape tablets, 768px and up) */
         @media only screen and (max-width: 768px) {
             .content {
                 display: flex;
                 flex-direction: column;
             }

             .chat-panel {
                 width: 100%;
             }

             #carousel-container {
                 width: 100%;
             }

             button.sign-out {
                 margin: 0 auto;
             }

         }

         .button {
             text-decoration: none;
             color: #fff;
         }

         .classes {
             display: block;
             width: 100%;
             margin: 20px auto;
         }

         .clear {
             clear: both;
         }

         .color {
             color: #fff;
             text-decoration: none;
             text-transform: uppercase;
             font-weight: bold;
             margin: 10px;
         }
     </style>
 </head>

 <body>
     <?php
        if (isset($_GET['action']) && $_GET['action'] == 'logout') {
            Session::destroy();
        }
        ?>

     <div class="parent">
         <div class="aside">
             <br />
         </div>

         <div class="main">
             <header>
                 <a href="index.html">
                     <img src="Mini-class App designs/Logo.svg" class="logo" alt="Logo" style="width: 100px; height: 100px;">
                 </a>
                 <a href="?action=logout" class="sign-out-btn">Sign Out</a>
                 <!-- <a href="student_profile.php" class="sign-out-btn">Your Dashbord</a> -->
             </header>

             <div class="content">
                 <div class="chat-panel">
                     <!-- greeting -->
                     <h4 class="greeting">
                         Hello <?php echo Session::get('studentName'); ?>!
                     </h4>
                     <!-- End of greeting -->

                     <!-- select class -->
                     <?php
                        $getAllClasses2 = $class->selectAllClassesEnrolled(Session::get('studentId'));
                        if ($getAllClasses2) {
                            while ($result2 = $getAllClasses2->fetch_assoc()) {
                                ?>
                             <div class="classes">
                                 <h2 id="subject">
                                     <?php echo $result2['class_name']; ?>
                                 </h2>
                                 <hr />
                                 <div class="chat-item">
                                     <br>
                                     <!-- download button -->
                                     <button class="sign-out-btn" style="margin-top: 20px;"><a href="student-class.php?classroom=<?php echo $result2['id']; ?>" class="color">Download Material</a></button><br>

                                 </div><br>
                             </div>
                             <div class="clear"></div>
                     <?php }
                        } else {
                            echo "<h1>You're not enrolled in any class, please click the button below to enroll in a class!</h1>";
                        } ?>
                     <div style="margin-top:10px; display: block !important;">
                         Interested in more Classes?
                         <button class="sign-out-btn" style="margin-top: 20px;"><a href="select-class.php" class="button">Enroll</a> </button>
                     </div>

                     <br><br>
                     <!-- <div class="chat-form">
                        
                        <input type="text" placeholder="Answer Questions"/>
                        <button><img src="https://res.cloudinary.com/dexcjehc5/image/upload/v1569419882/Vector"/></button>
                    
                    </div> -->
                 </div>
                 <div id="carousel-container">
                     <div class="carousel">
                         <img style="width:auto;" src="https://res.cloudinary.com/dexcjehc5/image/upload/v1569420981/classroom" alt="Classroom">

                     </div>

                     <span class="arrows">
                         <img src="https://res.cloudinary.com/dexcjehc5/image/upload/v1569421307/left" alt="">
                         <img src="https://res.cloudinary.com/dexcjehc5/image/upload/v1569421307/right" alt="">
                     </span>
                 </div>
             </div>
             <br><br><br><br><br>
         </div>

         <!-- <img src="https://res.cloudinary.com/dexcjehc5/image/upload/v1569422644/Ellipse"
        class="top-right" alt="">
        <img src="https://res.cloudinary.com/dexcjehc5/image/upload/v1569422643/x"
        class="bottom-right" alt=""> -->

     </div>

 </body>

 </html>