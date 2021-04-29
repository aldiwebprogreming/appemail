<?php 

	/**
	 * 
	 */
	class Send extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}


		function index(){

			$date = date('n/d');

			$this->db->like('BirthDate', $date);
			$list = $this->db->get('tbl_buyer')->result_array();

			foreach ($list as $data) {
				$nama = $data['FirstName'];
				$email = $data['Email'];

			$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.zoho.com',
			'smtp_port' => 465,
			'smtp_user' => 'master@ebunga.co.id',
			'smtp_pass' => 'Brian1903',
			'mailtype' => 'html',
			'smtp_timeout' => 20,
			'wordwrap' => TRUE
			);


			$this->load->library('email', $config);
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");

			$this->email->from('master@ebunga.co.id', 'ebunga');
			$this->email->to("$email");

			$this->email->subject('Info ebunga');
			
			$get1 = file_get_contents(base_url('email/email3.php'));
			$get2 = file_get_contents(base_url('email/email4.php'));
	      			

			$this->email->message("$get1<div style='color:#30373b;font-family:Antonio, Arial, sans-serif;font-size:30px;font-weight:bold;line-height:18px;text-align:center; color: orange;'>
                          $nama
                        </div>$get2");

			if (!$this->email->send())
			show_error($this->email->print_debugger());
			else
			echo 'Your e-mail has been sent!';

			}

			

		}
	}

 ?>