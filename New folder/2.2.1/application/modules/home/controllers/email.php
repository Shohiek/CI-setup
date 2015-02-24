<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class email extends MY_Controller {
	var $data;
	
	function __construct() {
		parent::__construct();
		echo "works";
		die;
	}

	public function index() {
		send_email('shohiek@gmail.com', 'Hi', 'Testing email function');
	}
	
	public function send_email($recipient, $subject, $message){
		$time=date('Y-m-d');
			$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => "oscarstestemail@gmail.com",
			'smtp_pass' => "0718715998"
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		
		$this->email->from('chrisrichrads@gmail.com', 'PHILOSOPHICAL ANTHROPOLOGY');
		$this->email->to($recipient);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->set_mailtype("html");
		if($this->email->send()){	
			$this->admin_model->store_sent_email($recipient, $subject, $message, $time);
			$this->index();
		} else {
			show_error($this->email->print_debugger());
		}
	}
}
