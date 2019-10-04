<?php 
  include 'inc/teacher-header.php';
?>
    <div class="">
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                $resetPassword = $teacher->resetPassword($_POST);
            }
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
        <div class="login-container">
        <div class="form-container " >
          <!-- success and error message -->
            <?php 
                if (isset($resetPassword)) {
                  echo $resetPassword;
                }
            ?>
          <h1>Reset Password</h1><br>
          <form action="" method="post">
              <div class="text-box">
                  <input class="email" name="email" placeholder="Email Address" required>
              </div>
              <div class="text-box">
                  <input class="Password" name="password" placeholder="New Password" required>
              </div>
              <button type="submit" name="submit" class="button" style="color: #fff;">Reset Password</button>
          </form>
    
           <br>
          <div class="footer">
            <p>Have you remebered your password? <a href="teacher-login.php" style="color: #274970; text-decoration: none; font-weight: bold;">Log in</a></p><br>
        
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
   