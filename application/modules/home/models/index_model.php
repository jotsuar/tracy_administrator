<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index_model extends CI_Model {

	public function get_all()
	{
		return $this->db->get('hospedaje')->result();
	}

}

/* End of file index_model.php */
/* Location: ./application/modules/home/models/index_model.php */