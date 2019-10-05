   <?php 
  include 'inc/student-header.php';
?>

    
    <div class="">
      <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $studentLogin = $student->studentLogin($_POST);
        }
      ?>
      <div class="toggle">
        <input type="checkbox" id="toggle" />
        <label for="toggle"></label>
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
                  <input class="email" name="email" value="" placeholder="Email Address">
              </div>
              <div class="text-box">
                  <input class="Password" name="password" value="" placeholder="Password">
              </div>
              <!-- Remember Password -->
              <input type="checkbox" class="checkbox" required>  <span style="">Remember Password</span>
              <button type="submit" name="submit" class="button" style="color: #fff;">Sign In</button>
          </form>
    
           <br>
          <div class="footer">
            <p>Don't have an account ?<a href="student_sign_up.php" style="color: #274970; text-decoration: none; font-weight: bold;"> Sign Up</a></p><br>
            <p><a href="student-reset.php" style="color: #274970; text-decoration: none; font-weight: bold;">Forgot Password?</a></p>
          </div>        
        </div>
        <div class="picture-cont" >
            <img src="images/teacher.png" class="picture">
        </div>
      </div>
    

    </div>
    

  <script src="js/main.js"></script>
</body>
</html>