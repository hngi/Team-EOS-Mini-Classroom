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
    <link rel="icon" href="Mini-class App designs/mathisi logo.png" type="image/png">
    <link rel="stylesheet" href="css/addItems.css">
    <title>Add items</title>
    <style type="text/css">
      .success {
        background: #274970;
        color: white;
        padding: 10px;
        z-index: 30;
        width: 100%;
        margin: 40px auto;
      }
      .error {
        background: #C63305;
        color: white;
        padding: 10px;
        z-index: 30;
        width: 100%;
        margin: 40px auto;
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
      .select-item {
        display: inline-block;
        text-decoration: none;
        background-color: #C63305;
        color: #000;
        padding: 12px 15px;
        border-radius: 30px;
        color: #fff;
      }
    </style>
</head>
<body>
    <?php
        if (isset($_GET['action']) && $_GET['action'] == 'logout') {
            Session::destroy();
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $addItem = $class->addNewItem($_POST, $_FILES);
        }
    ?>  
    <header>
        <a href="index.html"><img src="Mini-class App designs/Logo.svg" class="logo" alt="Logo" width="15%"></a>
            <a href="?action=logout" class="sign-out-btn">Sign Out</a>
    </header>
    <main>
        <div class="container">
            <div class='row'>
                <div class='column'>
                    <div class='column-left'>
                        <!-- greeting -->
                        <h4 class="greeting">
                            Hello teacher <?php echo Session::get('teacherName'); ?>!
                        </h4>
                        <!-- End of greeting -->

                        <h2>Add Items</h2>
                        <!-- success/error message -->
                        <?php 
                            if (isset($addItem)) {
                                echo $addItem;
                            }
                        ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <!-- Select class drop down menu -->
                            <select class="choose-item" name="classId" required>  

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
                            <br>

                            <!-- select file to add to class -->
                            <div style="margin-top: 15px;">
                                <input type="file" name="classFile" class="select-item" accept=".pdf, .doc, .ppt" required>
                            </div>

                            <div class="btn">
                                <button name="submit" class="add-btn">Add Item</button>
                            </div>
                        </form>
                        <!-- Back button -->
                        <!-- <a href="create-class.php" class="add-btn"><< Back</a> -->
                    </div>
                </div>
                <div class="line"></div>
                <div class='column'>
                    <div class='column-right'>
                        <table id="items" class="main-section">
                            <tr>
                                <th>Class</th>
                                <th>Item(s)</th>
                            </tr>
                    <?php
                        $getAllClasses2 = $class->selectAllClasses();
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
                                    <td class="mr"><?php echo $count['items_count']; ?></td>
                                </tr>
                    <?php } } ?>

                            <tr class="last">
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>