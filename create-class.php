<?php include 'teachers-dashboard-header.php'; ?>

      <h4>Create New Class</h4>
      
      <br><br>

    <div class="col-lg-12" style="padding-top: 10px" class="panel panel-primary">
    <?php
      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
          $addClass = $class->addNewClass($_POST);
      }
    ?>
    <?php 
        if (isset($addClass)) {
          echo $addClass;
        }
    ?> 
            
      <form role="form" action="" method="post">
        <!---<label>Create class</label><br>-->
        <div class="form-group">
          <input type="text" class="form-control" name="className" placeholder="Class Name" required> <br>
        </div>
        <button type="submit" name="submit" class="btn btn-success">Create Class</button>
      </form>
      </div>
    </div>
  </div>
</div>
</div>
</body>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</html>
