<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/contact_us.css">
    <title>Mathisi</title>
</head>

<body>
    <main class="view">
        <div class="sidebar">
            <img src="/mathisi logo white.png" alt="Mathisi">
        </div>

        <div class="contact-section">
            <a href="index.html">HOME</a>
            <div class="contact-form-container">
                <p>Contact Us</p>

                <div class="contact-form">
                    <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                        
                        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
                            echo "Please fill all fields";
                        } else {
                            echo "Thank you for reaching out to us, we shall get in touch with you as soon ass possible.";
                        }
                    }
                ?>
                    <form action="" method="post">
                        <input type="text" id="name" name="name" placeholder="Name..">
                    
                        <input type="email" id="email" name="email" placeholder="E-mail..">
                    
                        <textarea id="subject" name="message" placeholder="Message.." style="height:200px"></textarea>
                    
                        <input type="submit" name="submit" value="Submit">
                    
                    </form>
                </div>
            </div>
        </div>
    </main>