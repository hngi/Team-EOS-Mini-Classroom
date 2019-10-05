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
    <link rel="stylesheet" href="./student_profile.css">
    <title>Mathisi</title>
</head>

<body>

    <main class="view">
        <div class="sidebar">
            <div class="nav-name-display">
                <div class="nav-image">
                    <img src="../person-placeholder.png" alt="profile-image" class="p-image">
                </div>

                <div class="nav-name">
                    <p class="nav-name-text">
                        <span class="firstname">Name</span> <span class="lastname">Place</span>
                    </p>
                </div>

            </div>

            <div class="navigation">
                <p class="announcements nav-item"><img src="../notifications-icon.png" alt="announcements"> Announcements</p>
                <p class="classes nav-item"><img src="../mdi-teach.png" alt="classes"> Classes</p>
                <p class="materials nav-item"><img src="../foundation-book.png" alt="materials"> Materials</p>
            </div>
        </div>

        <div class="profile-section">
            <div class="inner-profile">
                <div class="profile-section-image">
                    <p><img src="../person-placeholder.png" alt="profile-image" class="profile-image"><span class="change-profile-image link">Change Profile Image</span> </p>
                </div>


                <div class="profile-info ">
                    <p class="name">
                        Name:
                        <span class="firstname plate"><?php echo Session::get('studentName'); ?></span>
                        <span class="lastname plate"></span>
                    </p>
                    <p class="email plate">Email: <?php echo Session::get('studentEmail'); ?></p>
                    <p class="phone plate">Phone: 0123456789</p>
                </div>

                <div class="class-details">
                    <table class="class-list">
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

                    <td><input type="submit" value="Change Password" class="reset-action link"></td>

                </div>
            </div>

        </div>
    </main>

</body>

</html>