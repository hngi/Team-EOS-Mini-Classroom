<?php include 'teachers-dashboard-header.php'; ?>

<h4>Add Materials To Class</h4>
      
      <br><br>

    <div class="col-lg-12" style="padding-top: 10px" class="panel panel-primary">
        <div class="row">
            <div class="col-md-6">
                <?php
                  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                        $addItem = $class->addNewItem($_POST, $_FILES);
                    }
                ?>
                <!-- success/error message -->
                <?php 
                    if (isset($addItem)) {
                        echo $addItem;
                    }
                ?>
         
                <form action="" method="post" enctype="multipart/form-data" role="form">
                    <!-- Select class drop down menu -->
                    <div class="form-group">
                        <select class="form-control" name="classId" required>  

                            <option>Select Class</option>
                            <!-- get all classes -->
                        <?php
                            $getAllClasses = $class->selectAllClasses();
                            if ($getAllClasses) {
                                while ($result = $getAllClasses->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $result['id']; ?>"><?php echo $result['class_name']; ?></option>
                        <?php } } ?>
                        </select>
                    </div>
                    <br>

                    <!-- select file to add to class -->
                    <div class="form-group">
                        <input type="file" name="classFile" class="form-control" accept=".pdf, .doc, .ppt, .txt" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">Add Item</button>
                </form>
            </div>
            <div class="col-md-6 margin-top">
                <h3>Number of materials in each class</h3>
                <table id="items" class="table table-striped table-bordered">
                    <tr>
                        <th>Class</th>
                        <th>Item(s)</th>
                    </tr>
                    <?php
                        $getAllClasses2 = $class->selectAllClasses();
                        if ($getAllClasses2) {
                            while ($result2 = $getAllClasses2->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $result2['class_name']; ?></td>
                            <?php
                                // id from the class table
                                $id2 = $result2['id'];
                                // we use the id to get the number of items on each class
                                $getAllItems = $class->selectAllItemsOfaClass($id2);
                                $count = $getAllItems->fetch_array();

                            ?>
                                    <td class="mr"><?php echo $count['items_count']; ?></td>
                                </tr>
                    <?php } } ?>
                </table>
            </div>
      </div>
    </div>
  </div>
</div>
</div>
</body>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</html>