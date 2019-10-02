<?php 
  include 'inc/teacher-header.php';
?>
    <div class="">
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                $teacherspwdreset = $teacher->teacherReset($_POST);
            }
          ?>
          
        <div class="login-container">
        <div class="form-container " >
          <!-- success and error message -->
            <?php 
                if (isset($teacherspwdreset)) {
                  echo $teacherReset;
                }
            ?>
          <h1>Reset Password</h1><br>
          <form action="" method="post">
              <div class="text-box">
                  <input class="email" name="email" value="" placeholder="Email Address">
              </div>
              <div class="text-box">
                  <input class="Password" name="password" value="" placeholder="New Password">
              </div>
              <!-- Remember Password -->
              <span>Remember Password<input type="checkbox" class="checkbox"></span>
              <button type="submit" name="submit" class="button" style="color: #fff;">Reset Password</button>
          </form>
    
           <br>
          <div class="footer">
            <p>Already have an account? <a href="teacher-login.php" style="color: #274970; text-decoration: none; font-weight: bold;">Log in</a></p><br>
        
          </div>        
        </div>
        
      </div>
   