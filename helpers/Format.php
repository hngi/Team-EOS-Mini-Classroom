<?php
class Format{

	public function formatDate($date){
		return date('F j, Y, g:i a', strtotime($date));
	}

	public function textShorten($text, $limit = 400){
		$text = $text. " ";
		$text = substr($text, 0, $limit);
		$text = substr($text, 0, strrpos($text, ' '));
		$text = $text."...";
		return $text;
	}

	public function rewriteText($string) {
        $text = preg_replace('/[^-a-z0-9-]+/', '-', strtolower($string));
        return $text;
    }

	public function validation($data){
		$data = trim($data);
		$data = stripcslashes($data); 
		$data = htmlspecialchars($data);
		return $data;
	}

	public function title(){
		$path = $_SERVER['SCRIPT_FILENAME'];
		$title = basename($path, '.php');
		//$title = str_replace('_', ' ', $title);
		if ($title == 'index') {
			$title = 'Welcome to Achievers';
		} elseif ($title == 'contact-us') {
			$title = 'contact';
		}
		return $title = ucfirst($title);
	}
}


define("TITLE", "Achievers");

define("KEYWORDS", "Achievers, achievers, Asifat Kazeem, asifat kazeem, Best website company in Nigeria, Web design, Web development, Web Maintenance, Consultancy, Company, Business, Organisation");

define("DESCRIPTION", "Achievers is a website building organisation established to satisfy different customer's website needs. Our quality services reflect who we are and what we stand for as a company. We develop relationships that make a positive difference in our customers' lives and we provide outstanding efforts that together, deliver premium value to our customers.");

?>