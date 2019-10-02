<?php 
  include 'inc/student-header.php';
?>


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
            <form action="" method="post">
              <label for="name"></label>
                <input type="text" placeholder="Full Name" name="name" required>
            
                <label for="email"></label>
                <input type="text" placeholder="Email Address" name="email" required>
            
                <label for="psw"></label>
                <input type="password" placeholder="password" name="password" required><br>
                <button type="submit" name="submit" class="signupbtn">Sign Up</button>
            </form>
              
              
              <p> Have an account already? <a href="student-login.php">Log In</a></p>

        </div>
        
    </div>
<script src="js/main.js"></script>
</body>
</html>