 <?php    
  include 'lib/Session.php';
  Session::checkStudentSession();

  spl_autoload_register(function($class){
    include_once "classes/".$class.".php";
  });

  $class = new ClassApp();
?>

<!DOCTYPE html>
 <html lang=" en">
     <head>
         <title>Mini-Classroom | Select A Class</title>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <link rel="icon" href="Mini-class App designs/mathisi logo.png" type="image/png">
         <link href="css/selectclass.css" rel="stylesheet">
         <style type="text/css">
             .choose-item {
                display: inline-block;
                text-decoration: none;
                background-color: #C63305;
                color: #000;
                padding: 12px 25px;
                border-radius: 30px;
                color: #fff;
              }
              .success {
                background: #274970;
                color: white;
                padding: 10px;
                z-index: 30;
                width: 100%;
                margin: 40px auto 20px 10px;
              }
              .error {
                background: #C63305;
                color: white;
                padding: 10px;
                z-index: 30;
                width: 100%;
                margin: 40px auto;
              }
              .color {
                color: #C63305;
                text-decoration: none;
                text-transform: uppercase;
                font-weight: bold;
                margin: 10px;
              }
         </style>
     </head>
     <body>
     <div class="toggle">
        <input type="checkbox" id="toggle" />
        <label for="toggle"></label>
        <em>Enable dark mode!</em>
    </div>
     <script>
        const toggle = document.getElementById('toggle');
        const body = document.body;

        toggle.addEventListener('input', e => {
        const isChecked = e.target.checked;

        if (isChecked) {
        body.classList.add('dark-theme');
             } else {
         body.classList.remove('dark-theme');
         }
          });
      </script>
        <?php
            if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                Session::destroy();
            }

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                $enroll = $class->enrollToClass($_POST, Session::get('studentId'));
            }
        ?>
        <header>
         <a href="index.html">
          <img src="Mini-class App designs/Logo.svg" class="logo" alt="Logo" style="width: 100px; height: 100px;">
        </a>
            <a href="?action=logout" class="sign-out-btn">Sign Out</a>
        </header>
            
    <div class="content">
        <div class="content-field">
            <h2>Select Class</h2>
            <?php
                if (isset($enroll)) {
                    echo $enroll;
                }
            ?>
            <form class="cc-form" action="" method="post">
                <!---<label>Create class</label><br>-->
                <select class="choose-item" name="classId">  

                    <option>Select Class</option>
                    <!-- get all classes -->
                <?php
                    $getAllClasses = $class->selectAllClasses();
                    if ($getAllClasses) {
                        while ($result = $getAllClasses->fetch_assoc()) {
                ?>
                    <option value="<?php echo $result['id']; ?>"><?php echo $result['class_name']; ?></option>
                <?php } } ?>
                </select>

                <button class="select" name="submit">Enroll</button>
            </form>
        </div>
        <div class="content-img">
            <img src="./Mini-class App designs/undraw_exams_g4ow.svg" width="60%">
        </div>
    </div>
    <br>
     </body>
</html>