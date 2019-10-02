<?php 
  include 'inc/student-header.php';
?>

    
    <div class="">
      <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $studentLogin = $student->studentLogin($_POST);
        }
      ?>
      <div class="login-container">
        <div class="form-container " >
          <!-- success and error message -->
          <?php 
              if (isset($studentLogin)) {
                echo $studentLogin;
              }
          ?>
            <h1>Log In As Student</h1>
            <form action="" method="post">
                <div class="text-box">
                    <input class="email" type="email" name="email" placeholder="Email Address">
                </div>
                <div class="text-box">
                    <input type="password" class="Password" name="password" placeholder="password">
                </div>
                <input type="submit" class="button" name="submit" value="Sign In" style="color: #fff;">
                <input type="checkbox" class="checkbox" required style="margin-right: 0;">  <span style="margin: 0; padding: 0;">Remember Password</span>
            </form>

            
            <br>
            <div class="footer">
                <p1>Don't have an account ?<a href="student_sign_up.php" style="color: #274970; text-decoration: none; font-weight: bold;"> Sign Up</a></p1>
            </div>
        </div>
        <div class="picture-cont" >
            <img src="images/teacher.png" class="picture">
        </div>
      </div>
    </div>
  </div>
    <div class="col-md-4">

    </div>
    <img src="images/Ellipse2.png" class="Ellipse2">
    <img src="images/x.png" class="x">

<script src="js/main.js"></script>
</body>
</html>