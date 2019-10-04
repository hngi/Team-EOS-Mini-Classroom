<?php    
  include 'lib/Session.php';
  //Session::checkTeacherSession();
  spl_autoload_register(function($class){
    include_once "classes/".$class.".php";
  });
 
  $student = new Student();
?>


<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/attendance-style.css">
	<title>Mathisi-student-attendance-Page</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-xs-12 col-sm-12">
				<div class="attendance-topic">
					<img src="images/Logo.svg" class="logo" alt="mathisi">
					<span class="text">Students Attendance</span>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-9">
				<div class="students">
					<p class="registered">All registered Students</p>
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Student Names</th>
								<th scope="col"> Email</th>
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
				            </tr>
				          <?php } } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-3">
				<div class="dates">
					<p class="registered-dates">Check by date</p>
					<div class="form-group">
						<input type="date" id="datepicker" class="form-control">
					</div>
				</div>
			</div>	
		</div>
	</div>
	<script type="text/javascript">
		$(function() {
			$( "#date").datepicker();
		});
	</script>
</body>
</html>