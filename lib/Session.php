<?php
	/**
	* Session Class
	*/
	class Session {
		public static function init(){
			session_start();
		}

		public static function set($key, $val){
			$_SESSION[$key] = $val;
		}

		public static function get($key){
			if(isset($_SESSION[$key])) {
				return $_SESSION[$key];
			} 
			else {
				return false;
			}
		}

		public static function checkTeacherSession(){
			self::init();
			if(self::get("teacherLogin") == false) {
				self::destroy();
				header("Location:teacher-login.php");
			}
		}

		public static function checkTeacherLogin(){
			self::init();
			if(self::get("teacherLogin") == true) {
				header("Location:teachers-dashboard.php");
			}
		}

		public static function checkStudentSession(){
			self::init();
			if(self::get("studentLogin") == false) {
				self::destroy();
				header("Location:student-login.php");
			}
		}

		public static function checkStudentLogin(){
			self::init();
			if(self::get("studentLogin") == true) {
				header("Location:classroom.php");
			}
		}

		public static function destroy() {
			session_destroy();
			//header("Location:index.php");
			echo "<script>window.location = 'index.html'; </script>";
		}
	}

?>