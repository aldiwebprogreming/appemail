<?php 

	/**
	 * 
	 */
	class Demo extends CI_Controller
	{
		
		function __construct()
		{
			parent:: __construct();
		}


		function index(){

			$date = date('m/d');

			$this->db->like('BirthDate', $date);
			$list = $this->db->get('tbl_buyer')->result_array();

			foreach ($list as $a) {
				$data = [
					'nama_user' => $a['FirstName'],
					'email' => $a['Email'],
					'tgl_ultah' => $a['BirthDate'],
				];

				$this->db->insert('tbl_ultah', $data);
			}
		}
	}

 ?>