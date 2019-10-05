<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
	class ClassApp{
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function addNewClass($data){
			$className = $this->fm->validation($data['className']);

			$cleanClass = mysqli_real_escape_string($this->db->link, $className);

			// check if Class exists
			$checkClass = "SELECT * FROM tbl_class WHERE class_name = '$cleanClass' LIMIT 1";
			$reply = $this->db->select($checkClass);
			if ($reply != false) {
				$msg = "<div class='alert alert-danger'>Class had been created earlier, please try another class!</div>";
				return $msg;
			}

			$query = "INSERT INTO tbl_class (class_name) VALUES ('$cleanClass')";

	  		$inserted_row = $this->db->insert($query);

	  		// if data is inserted
			if ($inserted_row){
				$msg = "<div class='alert alert-success'>Class has been added successfully. You should Add Items to the new class you just created!<br>
					<a href='add-items.php' class='btn btn-danger'>Add Items</a>
				</div>";
				return $msg;
			}
			else {
				$msg = "<div class='alert alert-danger'>Registration Not Successful!</div>";
				return $msg;
			}
		}

		public function selectAllClasses(){
			$query = "SELECT * FROM tbl_class";
			$result = $this->db->select($query);
			return $result;
		}

		public function selectAllItemsOfaClass($id){
			$query = "SELECT count(*) AS items_count FROM tbl_class_items WHERE classId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function selectAllItems($id) {
			$query = "SELECT * FROM tbl_class_items WHERE classId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function addNewItem($data, $file){
			$classId = $this->fm->validation($data['classId']);

			$classId = mysqli_real_escape_string($this->db->link, $classId);

			$permited = array('pdf', 'doc', 'ppt');
		  	$file_name = $file['classFile']['name'];
		  	$file_size = $file['classFile']['size'];
		  	$file_temp = $file['classFile']['tmp_name'];

		  	$div = explode('.', $file_name);
		  	$file_ext = strtolower(end($div));
		  	// $unique_file = substr(md5(time()), 0, 10).'.'.$file_ext;
		  	$uploaded_file = "class-files/".$file_name;

		  	if ($classId == "") {
		  		$msg = "<span class='alert alert-danger'>Please select the Class you want to add the item to!</span>";
		  		return $msg;
			
			} elseif ($file_size > 3048567) {
		  		echo "<span class='alert alert-danger'>File Size should be less than 3MB</span>";
		  	
		  	} elseif (in_array($file_ext, $permited) === false) {
		  		echo "<span class='alert alert-danger'>You can upload only:-".implode(', ',$permited)."</span>";
		  	
		  	} else {
		  		move_uploaded_file($file_temp, $uploaded_file);
		      	$query = "INSERT INTO tbl_class_items (classId, item) VALUES ('$classId', '$file_name')";
		      	$result = $this->db->insert($query);
		  		if ($result) {
		  			$msg = "<span class='alert alert-success'>New File Added Successfully.</span><br><br>";
		  			return $msg;
		  		} else {
		  			$msg = "<span class='alert alert-danger'>File Not Added, Please Try Again!</span><br><br>";
		  			return $msg;
		  		}
		  	}
		}

		public function enrollToClass($classId, $studentId) {
			$classId = $this->fm->validation($_POST['classId']);

			$classId = mysqli_real_escape_string($this->db->link, $classId);
			$studentId = $this->fm->validation($studentId);

			$studentId = mysqli_real_escape_string($this->db->link, $studentId);

			$ask = "INSERT INTO tbl_enroll (classId, studentId) VALUES ('$classId', '$studentId')";

			$inserted_row = $this->db->insert($ask);

			if ($inserted_row) {
	  			$msg = "
	  			<div class='success'>
	  			Your Enrollment was successful. You now have access to the class and its materials!.<br>
	  			<a href='classroom.php' class='color'>Go to Classroom</a>
	  			</div>";
	  			return $msg;
			} else {
				$msg = "<span class='error'>Enrollment Failed, please try again!</span>";
				return $msg;
			}
		}

		public function selectAllClassesEnrolled($id) {
			$query = "SELECT * FROM tbl_class WHERE studentId = '$id'";

			$query = "SELECT tbl_enroll.*, tbl_class.class_name FROM tbl_enroll INNER JOIN tbl_class ON tbl_enroll.classId = tbl_class.id WHERE tbl_enroll.studentId = '$id'";
			$getData = $this->db->select($query);
			return $getData;


			$result = $this->db->select($query);
			return $result;
		}
	}
?>