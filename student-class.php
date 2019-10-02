<?php    
  include 'lib/Session.php';
  Session::checkStudentSession();

  spl_autoload_register(function($class){
    include_once "classes/".$class.".php";
  });

  $class = new ClassApp();

  if (isset($_GET['classroom']) && $_GET['classroom'] != "") {
      $classId = $_GET['classroom'];
  } else {
    header("Location: classroom.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../frontend/Mini-class App designs/mathisi logo.png" type="image/png">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/downloadItems.css">
    <title>Signup For A Class</title>
    <style type="text/css">
        
      .greeting {
        color: #C63305;
        margin-left: 150px;
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
    </style>
</head>
<body>
    <?php
        if (isset($_GET['action']) && $_GET['action'] == 'logout') {
            Session::destroy();
        }

        // if (isset($_GET['student']) && $_GET['student'] == 'enroll') {
        //     $classId = $_GET['id'];
        //     $studentId = Session::get('studentId');

        //     $enrollToClass = $class->enrollToClass($classId, $studentId);
        // }
    ?> 

    <header>
        <a href="index.html"><img src="./Mini-class App designs/Logo.svg" class="logo" alt="Logo" width="13%"></a>
        <a href="?action=logout" class="sign-out-btn">Sign Out</a>
    </header>
    
    <main>  
        
        <h1>Student Dashboard</h1>

        <table id="items" class="main-section">
            <!-- greeting -->
        <h4 class="greeting">
            Hello <?php echo Session::get('studentName'); ?>!
        </h4>
        <!-- End of greeting -->
        <!-- success/error message -->
            <?php
                if (isset($enrollToClass)) {
                    echo $enrollToClass;
                }
            ?>
            <tr>
                <th>Class</th>
                <th>Items</th>
<!-- ======================== We display the class item name ========-->
                <?php
                    // we use the id to get the number of items on each class
                    $getAllItems3 = $class->selectAllItems($classId);
                    if ($getAllItems3) {
                            $i = 0;
                            while ($row2 = $getAllItems3->fetch_assoc()) {
                                    $i++;
               
                // If items are greater than 1 display more than one heading 
                        echo "<th>Download Item ".$i."</th>";
                    } }
                ?>
            </tr>
            <!-- get all classes student enrolled in -->
            <?php
                        $getAllClasses2 = $class->selectAllClassesEnrolled(Session::get('studentId'));
                            if ($getAllClasses2) {
                                while ($result2 = $getAllClasses2->fetch_assoc()) {
                       
                    ?>
                            <tr>
                                <td><?php echo $result2['class_name']; ?></td>
                            <?php
                                // id from the class table
                                $id2 = $result2['id'];
                                // we use the id to get the number of items on each class
                                $getAllItems = $class->selectAllItemsOfaClass($id2);
                                $count = $getAllItems->fetch_array();

                            ?>
                                    <!-- items -->
                                    <td class="mr">Items (<?php echo $count['items_count']; ?>)</td>
                                    
                                    <!-- download button -->
                                    <?php 
                                        $download = $class->selectAllItems($classId);
                                        if ($download) {
                                            while ($downloadItem = $download->fetch_assoc()) {
                                    ?>
                                        <td><a href="class-files/<?php echo $downloadItem['item']; ?>" class="Download-btn" target="_blank">Download</a></td>
                                    <?php } } else { echo "<td>No Material Available For Download</td>"; } ?>
                                </tr>
                    <?php } } ?>
        </table>
    </main>
</body>
</html>