<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Users_model extends MY_Model
{
	public $table = "logins l";
	public $select_column = ['l.id', 'l.name', 'l.mobile', 'l.email'];
	public $search_column = ['l.id', 'l.name', 'l.mobile', 'l.email'];
    public $order_column = [null, 'l.name', 'l.mobile', 'l.email', null];
	public $order = ['l.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
                 ->where(['is_deleted' => 0, 'id != ' => $this->session->auth]);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('l.id')
		         ->from($this->table)
				 ->where(['is_deleted' => 0, 'id != ' => $this->session->auth]);
		            	
		return $this->db->get()->num_rows();
	}
}