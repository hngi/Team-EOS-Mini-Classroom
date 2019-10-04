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
					$msg = "<div class='alert-success' role='alert'>Registration Successful! Please click the Log In below to sign in!</div>";
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

		// Get all students
		public function selectAllStudents(){
			$query = "SELECT * FROM tbl_student";
			$result = $this->db->select($query);
			return $result;
		}

		// Password reset
		public function resetPassword($data) {
			$email = $this->fm->validation($data['email']);
			$password = $this->fm->validation($data['password']);

			$cleanEmail = mysqli_real_escape_string($this->db->link, $email);
			$cleanPassword = mysqli_real_escape_string($this->db->link, $password);

			// check for wrong email format
			if (!filter_var($cleanEmail, FILTER_VALIDATE_EMAIL)){
				$signupMsg = "<div class='alert-danger' role='alert'>Invalid Email!</div>";
				return $signupMsg;
			} else {
				// check if mail exists
				$checkEmail = "SELECT * FROM tbl_student WHERE email = '$cleanEmail' LIMIT 1";
				$mailChk = $this->db->select($checkEmail);

				// if mail is found, reset the password in the database
				if ($mailChk != false) {
					$updatePassword = "UPDATE tbl_student SET password = '$cleanPassword' WHERE email = '$cleanEmail'";
					$update = $this->db->update($updatePassword);
					if ($update) {
						$msg = "<div class='alert-success' role='alert'>Password changed successfully! You may sign in into your account with your new password.</div>";
						return $msg;
					}
				} else {
					$msg = "<div class='alert-danger' role='alert'>Email Does Not Exist.</div>";
					return $msg;
				}
			}
		}

		// ban student
		public function banStudent($data) {
			$id = $this->fm->validation($data);

			$studentId = mysqli_real_escape_string($this->db->link, $id);

			$banStudent = "UPDATE tbl_student SET status = '1' WHERE id = '$studentId'";

			$updateBan = $this->db->update($banStudent);
			// if query is successful
			if ($updateBan) {
				$msg = "<div class='alert alert-danger' role='alert'>This student has been banned successfully!.</div>";
				return $msg;
			} else {
				$msg = "<div class='alert-danger' role='alert'>Student not banned yet, please try again!</div>";
				return $msg;
			}
		}

		// pardon student
		public function pardonStudent($data) {
			$id = $this->fm->validation($data);

			$studentId = mysqli_real_escape_string($this->db->link, $id);

			$pardonStudent = "UPDATE tbl_student SET status = '0' WHERE id = '$studentId'";

			$updatePardon = $this->db->update($pardonStudent);
			// if query is successful
			if ($updatePardon) {
				$msg = "<div class='alert alert-success' role='alert'>This student has been pardoned successfully!.</div>";
				return $msg;
			} else {
				$msg = "<div class='alert-danger' role='alert'>Student not pardoned yet, please try again.</div>";
				return $msg;
			}
		}

		// Expell Student
		public function expellStudent($data) {
			$id = $this->fm->validation($data);

			$studentId = mysqli_real_escape_string($this->db->link, $id);
			
			$expellStudent = "DELETE FROM tbl_student WHERE id = '$studentId'";
			$expellResult = $this->db->delete($expellStudent);
			// if query is successful
			if ($expellResult) {
				$msg = "<div class='alert alert-danger' role='alert'>This student has been Expelled successfully!.</div>";
				return $msg;
			}
			else {
				$msg = "<div class='alert-danger' role='alert'>Student not expelled yet, please try again.</div>";
				return $msg;
			}
		}

		// Review page
		public function submitReview($data) {
			$name = $this->fm->validation($data['name']);
			$email = $this->fm->validation($data['email']);
			$referrer = $this->fm->validation($data['referrer']);
			//$rating = $this->fm->validation($data['rating']);
			$comment = $this->fm->validation($data['comment']);

			if (empty($name) || empty($email) || empty($referrer) || empty($comment)) {
                $msg = "<div style='color: red; font-weight: bold; text-align: center;'>Please select all fields</div>";
                return $msg;
            } else {
            	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$signupMsg = "<div style='color: red; font-weight: bold; text-align: center;'>Invalid Email!</div>";
					return $signupMsg;
				} else {
					$query = "INSERT INTO tbl_review (name, email, referrer, comment) VALUES ('$name', '$email', '$referrer', '$comment')";

			  		$inserted_row = $this->db->insert($query);

			  		// if data is inserted
					if ($inserted_row){
						$msg = "<div style='color: green; font-weight: bold; text-align: center;'>Review Submitted Successful!</div>";
						return $msg;
					}
					else {
						$msg = "<div style='color: green; font-weight: bold; text-align: center;'>Review not submitted!</div>";
						return $msg;
					}
				}
            }
		}
	}
?>