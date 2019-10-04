<?php include 'teachers-dashboard-header.php'; ?>

<h4>All Registered Students</h4>
      
      <br><br>
<div class="col-lg-12" style="padding-top: 10px" class="panel panel-primary">
	<div class="row">
        <div class="col-md-6">
			<table id="studentTable" class="table table-striped table-bordered" style="width: 100%">

		    <!--Table head-->
			    <thead>
			      <tr>
			        <th>S/N</th>
			        <th>Name</th>
			        <th>Email</th>
			        <th>Attendance</th>
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
		              <td><button class="btn btn-danger">Present</button></td>
		            </tr>
		          <?php } } ?>
				</tbody>
			</table>
		</div>
		<div class="col-md-6 margin-top">
			<div class="dates">
				<h3>Check by date</h3>
				<div class="form-group">
					<input type="date" id="datepicker" class="form-control">
				</div>
			</div>	
		</div>
	</div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(function() {
		$( "#date").datepicker();
	});
</script>
</body>
</html>