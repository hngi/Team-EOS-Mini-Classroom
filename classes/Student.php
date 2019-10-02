<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	//Session::checkTeacherLogin();
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>

<?php
	class Student {
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function studentSignUp($data) {
			// sterilize user inputs
			$name = $this->fm->validation($data['name']);
			$email = $this->fm->validation($data['email']);
			$password = $this->fm->validation($data['password']);

			$cleanName = mysqli_real_escape_string($this->db->link, $name);
			$cleanEmail = mysqli_real_escape_string($this->db->link, $email);
			$cleanPassword = mysqli_real_escape_string($this->db->link, $password);

			// if any field is empty
			if(empty($cleanName) || empty($cleanEmail) || empty($cleanPassword)) {
				$signupMsg = "<div class='alert-danger' role='alert'>Please fill all fields!</div>";
				return $signupMsg;
			} 

			if (!filter_var($cleanEmail, FILTER_VALIDATE_EMAIL)) {
				$signupMsg = "<div class='alert-danger' role='alert'>Invalid Email!</div>";
				return $signupMsg;
			}
			
			// check if mail exists
			$checkEmail = "SELECT * FROM tbl_student WHERE email = '$cleanEmail' LIMIT 1";
			$mailChk = $this->db->select($checkEmail);
			if ($mailChk != false) {
				$msg = "<div class='alert-danger' role='alert'>Email Already Exist.</div>";
				return $msg;
			}
			else {
				// insert into the database
				$query = "INSERT INTO tbl_student (name, email, password) VALUES ('$cleanName', '$cleanEmail', '$cleanPassword')";

		  		$inserted_row = $this->db->insert($query);

		  		// if data is inserted
				if ($inserted_row){
					$msg = "<div class='success'>Registration Successful! Please click the Log In below to sign in!</div>";
					return $msg;
				}
				else {
					$msg = "<div class='alert-danger' role='alert'>Registration Not Successful!</div>";
					return $msg;
				}
			}
		}

		public function studentLogin($data){
			$email = $this->fm->validation($data['email']);
			$password = $this->fm->validation($data['password']);

			$cleanEmail = mysqli_real_escape_string($this->db->link, $email);
			$cleanPassword = mysqli_real_escape_string($this->db->link, $password);

			// If details are empty
			if(empty($cleanEmail) || empty($cleanPassword)) {
				$loginmsg = "<div class='alert-danger' role='alert'>Email or Password must not be empty</div>";
				return $loginmsg;
			}
			// if email is wrong
			elseif (!filter_var($cleanEmail, FILTER_VALIDATE_EMAIL)){
				$signupMsg = "<div class='alert-danger' role='alert'>Invalid Email!</div>";
				return $signupMsg;
			}
			else {
				// select the details from database
				$query = "SELECT * FROM tbl_student WHERE email = '$cleanEmail' AND password = '$cleanPassword'";
				$result = $this->db->select($query);
				
				// if details are received, set it in session
				if ($result != false) {
					$value = $result->fetch_assoc();
					Session::set("studentLogin", true);
					Session::set("studentId", $value['id']);
					Session::set("studentName", $value['name']);
					header("Location: classroom.php");
				}
				else {
					$loginmsg = "<div class='alert-danger' role='alert'>Email or Password Incorrect!</div>";
					return $loginmsg;
				}
			}
		}
	}
?>