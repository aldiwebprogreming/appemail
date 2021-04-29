<?php 

	/**
	 * 
	 */
	class Data_user extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			if ($this->session->userdata('username') == NULL) {
			redirect('login/');
			}
		}

		function index(){

			$data['title'] = 'Data Buyer';
			$data['sub_tilte'] =  "Data Buyer";

			$data['buyer'] = $this->db->get('tbl_buyer')->result_array();

			$this->load->view('template/header', $data);
			$this->load->view('Home/buyer', $data);
			$this->load->view('template/footer');
		}


		function send_card(){

			// $date  = date("m/d/Y");
			// $dua_hari= mktime(0,0,0,date("n"),date("j")+2,date("Y"));
			// $up = date("m/d/", $dua_hari);

			$date = date('m/d');

			$this->db->like('BirthDate', $date);
			$get = $this->db->get('tbl_buyer')->result_array();
		
			foreach ($get as $list) {
			

				$data = [
					'nama_user' => $list['FirstName'],
					'email' => $list['Email'],
					'tgl_ultah' => $list['BirthDate'],
				];

				$nama = $list['FirstName'];
				$email = $list['Email'];

				$this->kirim_email2($nama, $email);
				$input = $this->db->insert('tbl_ultah', $data);	
			}

			if ($input) {
				$this->session->set_flashdata('message', 'swal("sukses!", "Ucapan berhasil dikirim", "success");');
					redirect('data-buyer');
				}
			
			
		}

		function kirim_email2($email, $nama)
			  {

			$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.zoho.com',
			'smtp_port' => 465,
			'smtp_user' => 'master@ebunga.co.id',
			'smtp_pass' => 'Brian1903',
			'mailtype' => 'html',
			'wordwrap' => TRUE
			);


			$this->load->library('email', $config);
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from('master@ebunga.co.id', 'ebunga');
			$this->email->to($email);

			$this->email->subject('Info ebunga');
			
			$get1 = file_get_contents(base_url('email/email3.php'));
			$get2 = file_get_contents(base_url('email/email4.php'));

			$this->email->message("$get1 <div style='color:#30373b;font-family:Antonio, Arial, sans-serif;font-size:30px;font-weight:bold;line-height:18px;text-align:center; color: orange;'>
                          $nama
                        </div>$get2");

			if ($this->email->send()) {
				echo 'Your e-mail has been sent!';
			}else{
				show_error($this->email->print_debugger());
			
			}

}

		// private function _kirimEmail($nama,$email){


		// 	$config = [
		// 	'protocol'  => 'smtp',
		// 	'smtp_host' => 'smtp.zoho.com',
		// 	'smtp_user' => 'master@ebunga.co.id',
		// 	'smtp_pass' => 'brian1903',
		// 	'smtp_port' => 587,
		// 	'mailtype'  => 'html',
		// 	'charset'   => 'uWtf-8',
		// 	'newline'   => "\r\n",
		// ];



		// $this->load->library('email', $config);
		// $this->email->initialize($config);

	 //      $this->email->from('master@ebunga.co.id', 'ebunga');
	 //      $this->email->to($email);
	 //      $this->email->subject('Info ebunga');

	 //      // $get = file_get_contents(base_url('email/email.php?id=3'));
	 //      $get1 = file_get_contents(base_url('email/email3.php'));
	 //      $get2 = file_get_contents(base_url('email/email4.php'));	
	 //  		$this->email->message("hello");
	 	

  //       if ($this->email->send()) {
        	
		//         	echo "berhasil";
		//         } else {


		//         	  echo 'Email tidak berhasil dikirim';
		//                echo '<br />';
		//                echo $this->email->print_debugger();
		//         }


		// }

		function dataultah(){

			$data['title'] = "Data ultah";
			$data['sub_title'] = "Data Ultah Hari ini";

			// $date  = date("m/d/Y");
			// $dua_hari= mktime(0,0,0,date("n"),date("j")+2,date("Y"));
			// $up = date("m/d/", $dua_hari);

			// echo $up;
			$date = date('n/d');

			$this->db->like('BirthDate', $date);
			$data['ultah'] = $this->db->get('tbl_buyer')->result_array();

			$this->db->like('BirthDate', $date);
			$data['row'] = $this->db->get('tbl_buyer')->num_rows();

			$this->load->view('template/header', $data);
			$this->load->view('Home/data_ultah', $data);
			$this->load->view('template/footer');


		}

		function add_admin(){

				$data['title'] = "Tambah admin";
				$data['sub_title'] = "Tambah Admin";

				$this->load->view('template/header', $data);
				$this->load->view('Home/add_admin', $data);
				$this->load->view('template/footer');
				

				
			}

			function add_action(){
				if ($this->input->post('kirim')) {

					$pass = password_hash($this->input->post('pass'), PASSWORD_DEFAULT);
					
					$data = [
						'username' => $this->input->post('username'),
						'pass' => $pass,
						'role' => $this->input->post('role')

					];

					$input = $this->db->insert('login', $data);
					if ($input== true) {
						$this->session->set_flashdata('message', 'swal("Sukses!", "Data anda berhasil di tambah", "success");');
				redirect('data-admin');
						
					}
				}
			}


			function data_admin(){

				$data['title'] = "Data admin";
				$data['sub_title'] = "Data Admin";
				$data['admin'] = $this->db->get('login')->result_array();

				$this->load->view('template/header', $data);
				$this->load->view('Home/data_admin', $data);
				$this->load->view('template/footer');


			}


			function hapus(){

				$id = $this->input->get('id');

				$this->db->where('id', $id);
				$this->db->delete('login');
				$this->session->set_flashdata('message', 'swal("Sukses!", "Data Berhasil dihapus", "success");');
				redirect('data-admin');
			}

			function hapus_send(){

				$id = $this->input->get('id');

				$this->db->where('id', $id);
				$this->db->delete('tbl_ultah');
				$this->session->set_flashdata('message', 'swal("Sukses!", "Data Berhasil dihapus", "success");');
				redirect('data-send');
			}



			function data_send(){

				$data['title'] = "Data send";
				$data['sub_title'] = "Data Send Email";
				$data['send'] = $this->db->get('tbl_ultah')->result_array();

				$this->load->view('template/header', $data);
				$this->load->view('Home/data_send', $data);
				$this->load->view('template/footer');
			}




			function birt(){


			
			// $date = date('m/d');

			// $this->db->like('BirthDate', $date);
			// $get = $this->db->get('tbl_buyer')->result_array();
		
			// foreach ($get as $list) {

				$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.zoho.com',
			'smtp_port' => 465,
			'smtp_user' => 'master@ebunga.co.id',
			'smtp_pass' => 'Brian1903',
			'mailtype' => 'html',
			'newline'   => "\r\n",

			
			);


		$this->load->library('email', $config);
		$this->email->initialize($config);

	      $this->email->from('master@ebunga.co.id', 'ebunga');
	      $this->email->to('alldii1956@gmail.com');
	      $this->email->subject('Info ebunga');

	      // $get = file_get_contents(base_url('email/email.php?id=3'));
	      $get1 = file_get_contents(base_url('email/email3.php'));
	      $get2 = file_get_contents(base_url('email/email4.php'));	
	  		$this->email->message("$get1 <div style='color:#30373b;font-family:Antonio, Arial, sans-serif;font-size:30px;font-weight:bold;line-height:18px;text-align:center; color: orange;'>
                         Adi
                        </div> $get2");
	 	

        if ($this->email->send()) {
        	
		        	echo "berhasil";
		        } else {


		        	  echo 'Email tidak berhasil dikirim';
		               echo '<br />';
		               echo $this->email->print_debugger();
		        }

		    

	
	}

					
		// 	$config = Array(
		// 	'protocol' => 'smtp',
		// 	'smtp_host' => 'ssl://smtp.zoho.com',
		// 	'smtp_port' => 465,
		// 	'smtp_user' => 'master@ebunga.co.id',
		// 	'smtp_pass' => 'Brian1903',
		// 	'mailtype' => 'html',
		// 	'newline'   => "\r\n",
			
		// 	);

		// 	$this->load->library('email', $config);
		// 	$this->email->initialize($config);

		// 	foreach ($birt as $list) {
		// 	$this->email->from('master@ebunga.co.id', 'ebunga');
		// 	$this->email->to($list['Email']);

		// 	$this->email->subject('Info ebunga');
			
		// 	$get1 = file_get_contents(base_url('email/email3.php'));
		// 	$get2 = file_get_contents(base_url('email/email4.php'));

		// 	$this->email->message("$get1 <div style='color:#30373b;font-family:Antonio, Arial, sans-serif;font-size:30px;font-weight:bold;line-height:18px;text-align:center; color: orange;'>
  //                         ALDI
  //                       </div>$get2");

		// 	$this->email->send();

			
		// }

		// 		}


	function kirim_email3()
			  {

			$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.zoho.com',
			'smtp_port' => 465,
			'smtp_user' => 'master@ebunga.co.id',
			'smtp_pass' => 'Brian1903',
			'mailtype' => 'html',
			'wordwrap' => TRUE
			);


			$this->load->library('email', $config);
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");

			$this->email->from('master@ebunga.co.id', 'ebunga');
			$this->email->to('alldii1956@gmail.com');

			$this->email->subject('Info ebunga');
			
			// $get1 = file_get_contents(base_url('email/email.html'));
	      			

			$this->email->message("hello");

			if (!$this->email->send())
			show_error($this->email->print_debugger());
			else
			echo 'Your e-mail has been sent!';
			}



			}


	 
	

 ?>