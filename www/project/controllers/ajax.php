<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	public function index()
	{		
		$data = json_decode(file_get_contents("php://input"));
		/*
		echo "Тема: ".$data->title."<br />";
		echo "Е-мейл отправителя: ".$data->email."<br />";
		echo "Имя отправителя: ".$data->name."<br />";
		echo "Текст письма: ".$data->text."<br />";
		echo "Список получателей: ".$data->listmail."<br />";
		*/
		
		// $listmail = explode(PHP_EOL, $data->listmail);
		$listmail = explode("\n", $data->listmail);
		$listmail_valid = array();
		$this->load->helper('email');
		
	//	print_r($listmail); exit();
		
		foreach($listmail as $ismail)
			if (valid_email($ismail))
				$listmail_valid[] = $ismail;
		
		if (isset($data->email) && $data->email!="" && valid_email($data->email))
			$mailer_from = $data->email;
		
		$mailer_to = array_slice($listmail_valid, 0, 1);
		$listmail_valid = array_slice($listmail_valid, 1);
		// print_r($mailer_to); exit();
		// print_r($listmail_valid); exit();
		
		if(
			isset($data->name) && $data->name!='' && 
			isset($data->title) && $data->title!="" && 
			isset($data->text) && $data->text!="" && 
			isset($mailer_from) && $mailer_from!="" && 
			!empty($mailer_to)
		){
		
	
			$str='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>'.addslashes($data->title).'</title>
			</head>
			<body>
			'.addslashes($data->text).'
			</body>
			</html>';		
			$this->load->library('email');
			
				$config['mailtype'] = 'html';
			/*
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'ssl://smtp.yandex.ru';
				$config['smtp_user'] = 'email@yandex.ru';
				$config['smtp_pass'] = 'password';
				$config['smtp_port'] = '465';
				$config['smtp_timeout'] = '10';
			*/
				$config['newline'] = "\r\n";
				$this->email->initialize($config);
				
				$this->email->from($data->email, $data->name);
			
			$list_mail = $mailer_to;
			
			$this->email->to($list_mail);
			// $this->email->cc($data->email);

			$this->email->subject($data->title);
			$this->email->message($str);

			$this->email->send();
			
			echo implode(preg_replace("/\s*\r+/", "", $listmail_valid), PHP_EOL);
		}
	}
}