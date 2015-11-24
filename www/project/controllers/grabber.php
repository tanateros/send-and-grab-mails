<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grabber extends CI_Controller {
	public function index()
	{		
		$this->load->view('formgrabber');
	}
	public function ajax()
	{		
		function stripper($from, $to, $text){
			$result = array();
			$text = explode($from, $text);
			unset($text[0]);
			foreach($text as $i){
				$i = explode($to, $i);
				$result[] = $i[0];
			}
			return $result;
		}
		
		$data = json_decode(file_get_contents("php://input"));
		
		$link=$data->url;
		$listincludeurl = explode(PHP_EOL, $data->listincludeurl);
		
		if($link!='' && empty($listincludeurl[0])){
			// Заполнение списка внутренних ссылок
			$s=@file_get_contents($link) or die("Некорректно введен адрес");
			//if($s!=''){
				$str=@stripper('<body','</body>',$s);
				$arr_s=stripper('href="','"',$str[0]);
				$new_arr_mass = array();
				foreach($arr_s as $u){
					if(strpos($u, 'http://') === 0) {
						$tempor = explode('?', $u);
						$new_arr_mass[] = $tempor[0];
					}
					else if(strpos($u, '/') === 0){
						$tempor = explode('?', $u);
						$new_arr_mass[] = $link.$tempor[0];
					}
				}
				$new_arr_mass = array_unique($new_arr_mass);
				
				
				/*
				// Заполнение списка внутренних ссылок 2 level
				foreach($new_arr_mass as $s):
				
					if(strpos($u, $link) === 0) {
						$s=@file_get_contents($link) or die("Некорректно введен адрес");
						$str=stripper('<body','</body>',$s);
						$arr_s=stripper('href="','"',$str[0]);
						$new_arr_mass2 = array();
						foreach($arr_s as $u){
							if(strpos($u, 'http://') === 0) {
								$tempor = explode('?', $u);
								$new_arr_mass2[] = $tempor[0];
							}
							else if(strpos($u, '/') === 0){
								$tempor = explode('?', $u);
								$new_arr_mass2[] = $link.$tempor[0];
							}
						}
						$new_arr_mass2 = array_unique($new_arr_mass2);
					}
				endforeach;
				
				echo implode($new_arr_mass2, PHP_EOL);
				
				*/
				echo implode($new_arr_mass, PHP_EOL);
				
			}	
			else if($link!='' && !empty($listincludeurl[0])){
				$this->load->helper('email');
				$listmail = explode("\n", $data->listincludeurl);
				$in_site_=@file_get_contents($listmail[0]);
				$str2=stripper('<body','</body>',$in_site_);
				$arr_s2=@stripper('href="mailto:','"',$str2[0]);
				$c2=count($arr_s2);
				if($c2!=0){
					for($j=0;$j<$c2;$j++)
						if (valid_email($arr_s2[$j]))
							$all_mail[] = $arr_s2[$j];
				}
				else $all_mail = array();
				$listmailparser = explode("\n", $data->listmailparser);
				
				if(isset($listmailparser) && $listmailparser[0]!='')
					foreach($listmailparser as $old_pars)
						//if(isset($all_mail) && !empty($all_mail))
							@array_push($all_mail, $old_pars);
						//else $all_mail = $old_pars;
			//	if(!empty($all_mail))
					echo @implode(array_unique(@$all_mail), PHP_EOL);
			//	else
			//		echo @implode(@array_unique(@$listmailparser), PHP_EOL);
			}
		//}
	}
}