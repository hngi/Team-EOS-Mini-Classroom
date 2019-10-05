<?php 
  include 'inc/student-header.php';
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
  <div class="background">

    </div>
    <div class="register-container">
        
        <div class="orangeBox"></div>
        <div class="formContainer">
           <h1> Sign up as a student </h1>
            
            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                      $studentSignUp = $student->studentSignUp($_POST);
                }
              ?>
              <?php 
                  if (isset($studentSignUp)) {
                    echo $studentSignUp;
                  }
              ?>
            <form action="" method="post" id="signupForm">
              <label for="name"></label>
                <input type="text" id="name" placeholder="Full Name" name="name" required> <br>
            
                <label for="email"></label>
                <input type="text" id="email" placeholder="Email Address" name="email" required>
            
                <label for="psw"></label>
                <input type="password" id="psw" placeholder="Password" name="password" required><br>

                <label for="psw2"></label>
                <input type="password" id="psw2" placeholder="Password" name="password2" required> <br>

                <button type="submit" name="submit" class="signupbtn">Sign Up</button>
                <div class="terms">
                  <input type="checkbox" name="" required> I agree to the <a href="terms.html">Terms and Conditions</a>
                </div>
            </form>
              
              
              <p> Have an account already? <a href="student-login.php">Log In</a></p>

        </div>
        
    </div>
<script src="js/main.js"></script>
</body>
</html>