<?php 
  include 'inc/teacher-header.php';
?>
    <div class="">
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                $teacherLogin = $teacher->teacherLogin($_POST);
            }
          ?>
          
        <div class="login-container">
        <div class="form-container " >
          <!-- success and error message -->
            <?php 
                if (isset($teacherLogin)) {
                  echo $teacherLogin;
                }
            ?>
          <h1>Teacher Log In</h1>
          <form action="" method="post">
              <div class="text-box">
                  <input class="email" name="email" value="" placeholder="Email Address">
              </div>
              <div class="text-box">
                  <input class="Password" name="password" value="" placeholder="Password">
              </div>
              <!-- Remember Password -->
              <input type="checkbox" class="checkbox" required style="margin-right: 0;">  <span style="margin: 0; padding: 0;">Remember Password</span>
              <!-- //Remember Password -->
              <button type="submit" name="submit" class="button" style="color: #fff;">Sign In</button>
          </form>
    
           <br>
          <div class="footer">
            <p1>Don't have an account ?<a href="teacher_sign_up.php" style="color: #274970; text-decoration: none; font-weight: bold;"> Sign Up</a></p1>
          </div>        
        </div>
        <div class="picture-cont" >
            <img src="images/teacher.png" class="picture">
        </div>
      </div>
    <div class="col-md-4">

    </div>
    <img src="images/Ellipse2.png" class="Ellipse2">
    <img src="images/x.png" class="x">

  <script src="js/main.js"></script>
</body>
</html>