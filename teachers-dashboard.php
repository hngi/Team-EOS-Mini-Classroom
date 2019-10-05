<?php include 'teachers-dashboard-header.php'; ?>

      <h4>Add Announcement</h4>
      <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $addAnnouncement = $student->addAnnouncement($_POST);
          }
      ?>
      <!-- success/error message -->
      <?php 
          if (isset($addAnnouncement)) {
              echo $addAnnouncement;
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
      <form role="form" action="" method="post">
        <div class="form-group">
          <input class="form-control" required placeholder="Title" name="title"></input>
        </div>
        <div class="form-group mt-3">
          <textarea class="form-control" rows="5" required placeholder="Add Announcement..." style="resize: none;" name="content"></textarea>
        </div>
        <input type="hidden" name="teacher_id" value="<?php echo Session::get('teacherId'); ?>">
        <button type="submit" name="submit" class="btn btn-success">Post Announcement</button>
      </form>
      <br><br>

    <div class="col-lg-12" style="padding-top: 10px" class="panel panel-primary">
      <div style="float: center">
            <h2><strong  class="label label-default">NOTICE BOARD</strong></h2>
      </div>
  
      <hr>
      <?php
        $getAllAnnouncements = $student->selectAllAnnouncements();
          if ($getAllAnnouncements) {
            while ($result = $getAllAnnouncements->fetch_assoc()) {
      ?>
       
      <h3><span class="label label-primary"><?php echo $result['title']; ?></span></h3>
      <h5><span class="glyphicon glyphicon-time"></span> Post by Teacher: <?php echo $result['name']; ?>, <?php echo $fm->formatDate($result['dates']); ?>.</h5>
      <br>
     
     <!--  <h5><span class="label label-danger">Food</span> <span class="label label-primary">Ipsum</span></h5><br> -->
      <p><?php echo $result['content']; ?></p>
      <br><br>
      
      <hr>
    <?php } } ?>
  </div>
</div>


</body>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</html>
