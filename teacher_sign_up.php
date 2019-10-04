<?php 
  include 'inc/teacher-header.php';
?>
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
    <div class="register-container">
        
        <div class="orangeBox"></div>
        <div class="formContainer">
          <h1 class="register-header"> Sign up As Teacher</h1>
              <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                      $teacherSignup = $teacher->teacherSignUp($_POST);
                }
              ?>
              <?php 
                  if (isset($teacherSignup)) {
                    echo $teacherSignup;
                  }
              ?>
              <form action="" method="post">

                  <label for="name"></label>
                  <input class="form-control type="text" placeholder="Full Name" name="name" required>
              
                  <label for="email"></label>
                  <input type="email" placeholder="Email Address" name="email" required>
              
                  <label for="psw"></label>
                  <input type="password" placeholder="Password" name="password" required><br>
                  <button type="submit" name="submit" class="signupbtn">Sign Up</button>
              </form>
              
              <p style="margin-top: 10px;"> Have an account already? <a href="teacher-login.php" style="color: #274970; text-decoration: none; font-weight: bold;">Log In</a></p>

        </div>
        
    </div>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>