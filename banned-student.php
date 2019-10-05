<?php include 'teachers-dashboard-header.php'; ?>
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

<h4>Banned Students' Data</h4>
      
<br><br>

<div class="col-lg-12" style="padding-top: 10px" class="panel panel-primary">
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

    if (isset($expell)) {
      echo $expell;
    }
  ?>
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