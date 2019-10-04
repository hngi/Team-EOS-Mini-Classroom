<?php    
  include 'lib/Session.php';
  Session::checkTeacherSession();
  spl_autoload_register(function($class){
    include_once "classes/".$class.".php";
  });
 
  $student = new Student();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="pro.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <!-- Datatable files -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css">

	<title>Mathisi - Banned Students</title>
	<link rel="stylesheet" type="text/css" href="css/banned.css">
</head>
<body>
  <!--Table-->
<div class="container">
  <div class="row">
    <div class="grid">
    	<div class="sidebar">
    		<div class="TechieTeelogo">
    			<a href="index.html">
            <img src="images/Logo.svg" alt="profile pics" style="height:200px; width: 200px; border-radius:50%;">
    			  <div class="name-tag">Mathisi Banned Students</div> 
          </a>
    		</div>
    		<div class="list" style="color:#ffffff;">
    			<ul>
    				<li><a href="Announcements.html"><i class="fa fa-bell" aria-hidden="true"></i>  Announcements</a></li>
    				<li><a href="Students.html"><i class="fa fa-graduation-cap" aria-hidden="true"></i>  Students</a>
    					<ul><li><a href="Banned.html"><i class="fa fa-ban" aria-hidden="true"></i>  Banned Students</a></li></ul>
    				<li><a href="Classes"><i class="fa fa-laptop" aria-hidden="true"></i>  Classes</a>
    				<li><a href="Materials"><i class="fa fa-book" aria-hidden="true"></i>  Materials</a>
    			</ul> 
    		</div>
    	</div>
    	<div class="content" style="padding-left:10%;">
    		<div class="SD"> Students Data </div> <br>

<!-- Algorithm to ban, pardon and expell -->
<?php
  if (isset($_GET['ban'])){
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['ban']);
    $ban = $student->banStudent($id);
  }

  if (isset($_GET['pardon'])){
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['pardon']);
    $pardon = $student->pardonStudent($id);
  }

  if (isset($_GET['expell'])){
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['expell']);
    $expell = $student->expellStudent($id);
  }

  // display the appropriate success or error messages
  if (isset($ban)) {
    echo $ban;
  }

  if (isset($pardon)) {
    echo $pardon;
  }
?>

    <div class="col-md-10">
      <!-- Do not tamper with the id of this table -->
      <table id="studentTable" class="table table-striped table-bordered" style="width:100%">

        <!--Table head-->
        <thead>
          <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
            
          </tr>
        </thead>
        <tbody>
              <!-- Show all students -->
              <?php
                $getAllStudents = $student->selectAllStudents();
                  if ($getAllStudents) {
                    $i = 0;
                      while ($result = $getAllStudents->fetch_assoc()) {
                        $i++;
              ?> 
            <tr>             
              <td><?php echo $i; ?></td>
              <td><?php echo $result['name']; ?></td>
              <td><?php echo $result['email']; ?></td>
              <td>
                <?php
                  if ($result['status'] == 0) {
                    echo "Enrolled";
                  } elseif ($result['status'] == 1) {
                    echo "<span style='color: red; font-weight: bold;'>Banned</spa>";
                  } else {
                    echo "Expelled";
                  }
                ?>                
              </td>
              <td>
                <!-- ban button -->
                <a href="?ban=<?php echo $result["id"]; ?>" type="button" name="expell_student" class="btn btn-primary btn-sm">Ban</a> 
                 <!-- pardon button -->
                <a href="?pardon=<?php echo $result["id"]; ?>" type="button" name="expell_student" class="btn btn-info btn-sm">Pardon</a>
                <!-- expell button -->
                <a href="?expell=<?php echo $result["id"]; ?>" type="button" name="expell_student" class="btn btn-danger btn-sm">Expell</a>
              </td>
            </tr>
          <?php } } ?>
        </tbody>
        <tfoot>
          <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
<!--Table-->
	</div>
</div>
<script src="js/jquery-3.3.1.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#studentTable').DataTable( {
                scrollY: true,
                scrollX: true
            });
        } );
    </script>
</body>
</html>