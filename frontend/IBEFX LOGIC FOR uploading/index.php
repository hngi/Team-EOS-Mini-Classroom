<?php include 'filesLogic.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <title>Files Upload and Download</title>
</head>

<body>

    <h1>View <a href="downloads.php">Files</a></h1>

    <div class="container">
        <div class="row">
            <form action="index.php" method="post" enctype="multipart/form-data">
                <h3>Upload File</h3>
                <input type="file" name="myfile"> <br>
                <button type="submit" name="save">upload</button>
            </form>
        </div>
    </div>
</body>

</html>