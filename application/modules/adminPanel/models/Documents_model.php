<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Documents_model extends MY_Model
{
	public $table = "documents d";
	public $select_column = ['d.id', 'd.title', 'd.created_at', 'd.updated_at'];
	public $search_column = ['d.id', 'd.title', 'd.created_at', 'd.updated_at'];
    public $order_column = [null, 'd.title', 'd.created_at', 'd.updated_at', null];
	public $order = ['d.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
                 ->where(['is_deleted' => 0, 'folder_id' => d_id($this->input->get('folder_id'))]);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('d.id')
		         ->from($this->table)
				 ->where(['is_deleted' => 0]);
		if ($this->input->get('folder_id') != '')
			$this->db->where(['folder_id' => d_id($this->input->get('folder_id'))]);
		            	
		return $this->db->get()->num_rows();
	}
}