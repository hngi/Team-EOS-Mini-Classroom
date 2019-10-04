<?php    
  include 'lib/Session.php';
  spl_autoload_register(function($class){
    include_once "classes/".$class.".php";
  });
 
  $student = new Student();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Review Our Classroom App</title>
    <link rel="stylesheet" href="css/review.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <p id="mathisi">
                <a href="index.html" style="color: #fff; text-decoration: none;"><img src="images/mathisi logo.png" alt="mathisi_logo"> MATHISI</a>
            </p>
        </div>
        <div class="form-container">
            <p class="sucess-message"> your review has been sucessfully submitted</p>
        <!-- PHP Files here -->
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                
                $submitReview = $student->submitReview($_POST);
            }

            if (isset($submitReview)) {
                echo $submitReview;
            }
        ?>
            <form action="" method="post">
                <div class="details">
                    <fieldset>
                        <legend>
                            Your Details:
                        </legend>
                        <label>
                            Name:
                        </label>
                        <input class="input" type="text" name="name" size="30" maxlength="100">
                        <br />
                        <label>
                            Email:
                        </label>
                        <input class="input" type="email" name="email" size="30" maxlength="100">
                        <br />
                    </fieldset>
                <br />
            </div>
            <div class="review">
                <fieldset>
                    <legend>
                        Your Review:
                    </legend>
                    <p>
                        <label for="hear-about">
                            How did you hear about us?
                        </label>
                        <select name="referrer" id="hear-about">
                            <option value="google">Google</option>
                            <option value="friend">Friend</option>
                            <option value="advert">Advert</option>
                            <option value="other">Other</option>
                        </select>
                    </p>
                    <p>
                        Would you visit again?
                        <br />
                        <label>
                            <input type="radio" name="rating" value="yes">
                            Yes
                        </label>
                        <label>
                            <input type="radio" name="rating" value="no">
                            No
                        </label>
                        <label>
                            <input type="radio" name="rating" value="maybe" />
                            Maybe
                        </label>
                    </p>
                    <p>
                        <label for="comments">
                            Comments:
                        </label>
                        <br />
                        <textarea  class="comments" name="comment"></textarea>
                    </p>
                    <label>
                        <input type="checkbox" name="subscribe" checked="checked" />
                        Sign me up for email updates
                    </label>
                    <br />
                    <input type="submit" name="submit" value="Submit review" class="btn" />
                </fieldset>
            </div>
        </form>
    </div>
</div>
</body>
</html>