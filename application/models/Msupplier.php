<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Msupplier extends CI_Model {

		public function getsupplier($where="")
		{
			// ambil data dari tabel supplier
			if($where!='') {
				$this->db->where($where);
			}
			return $this->db->get('supplier');
		}
		
	}
