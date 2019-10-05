<?php
include 'lib/Session.php';
Session::checkStudentSession();

include 'helpers/Format.php';

spl_autoload_register(function ($class) {
    include_once "classes/" . $class . ".php";
});

$class = new ClassApp();
$student = new Student();
$fm = new Format()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/student_profile.css">
    <title>Mathisi</title>
</head>

<body>
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        Session::destroy();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $enroll = $class->enrollToClass($_POST, Session::get('studentId'));
    }
    ?>

    <main class="view">
        <div class="sidebar">
            <div class="nav-name-display">
                <div class="nav-image">
                    <img src="./images/HT.jpg" alt="profile-image" class="p-image">
                </div>

                <div class="nav-name">
                    <p class="nav-name-text">
                        <!-- <span class="firstname">Name</span> <span class="lastname">Place</span> -->
                    </p>
                </div>

            </div>

            <div class="navigation">
                <a style="text-decoration: none;
                          color: white;" href="dashboard.html">
                    <p class="announcements nav-item"><img src="./images/ic-round-notifications-none.png" alt="announcements"> Announcements</p>
                </a>
                <a style="text-decoration: none;
                          color: white;" href="classroom.php">
                    <p class="classes nav-item"><img src="./images/mdi-teach.png" alt="classes"> Classes</p>
                </a>
                <a style="text-decoration: none;
                          color: white;" href="student-class.php">
                    <p class="materials nav-item"><img src="./images/foundation-book.png" alt="materials"> Materials</p>
                </a>
            </div>
        </div>

        <div class="profile-section">
            <div class="inner-profile">
                <div class="profile-section-image">
                    <p><img src="./images/HT.jpg" alt="profile-image" class="profile-image">
                        <!--<span class="change-profile-image link">Change Profile Image</span> -->
                    </p>
                </div>


                <div class="profile-info ">
                    <p class="name">
                        Name:
                        <span class="firstname plate"><?php echo Session::get('studentName'); ?></span>
                        <span class="lastname plate"></span>
                    </p>
                    <p class="email plate">Email: <?php echo Session::get('studentEmail'); ?> </p>
                    <p class="phone plate">Phone: 0123456789</p>
                </div>

                <div class="class-details">
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
                            <?php }
                            } ?>
                        </select>

                        <button class="select" name="submit">Enroll</button>
                    </form>
                    <!-- <table class="class-list">
                        <tr>
                            <th>Classes</th>
                            <th></th>
                            <th></th>
                        </tr>

                        <tr class="class-table-field">
                            <td class="class-title">English</td>
                            <td class="teacher-name">Faith Promise Ms.</td>
                            <td><input type="submit" value="Go To Class" class="class-action link"></td>
                        </tr>

                        <tr class="class-table-field">
                            <td class="class-title">Mathematics</td>
                            <td class="teacher-name">Collin Francis Mr.</td>
                            <td><input type="submit" value="Go To Class" class="class-action link"></td>
                        </tr>

                        <tr class="class-table-field">
                            <td class="class-title">Physics</td>
                            <td class="teacher-name">Margaret Chan Ms.</td>
                            <td><input type="submit" value="Go To Class" class="class-action link"></td>
                        </tr>

                        <tr class="class-table-field">
                            <td class="class-title">Chemistry</td>
                            <td class="teacher-name">James Javier Mr.</td>
                            <td><input type="submit" value="Go To Class" class="class-action link"></td>
                        </tr>
                    </table>

                    <td><input type="submit" value="Change Password" class="reset-action link"></td> -->

                </div>
            </div>

        </div>
    </main>

</body>

</html>