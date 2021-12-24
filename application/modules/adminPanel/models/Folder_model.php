<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Folder_model extends MY_Model
{
	public $table = "folders f";

	public function folders($parent_id)
	{
		$folders = $this->db->select('id, title, parent_id')
							->from($this->table)
							->where(['is_deleted' => 0, 'parent_id' => $parent_id])
							->get()
							->result_array();

		return $folders;
	}

	public function documents($folder_id)
	{
		$documents = $this->db->select('document_file, created_at, updated_at')
												->from('documents')
												->where(['is_deleted' => 0, 'folder_id' => $folder_id])
												->get()
												->result_array();
		return $documents;
	}

	public function count()
	{
		$this->db->select('f.id')
		         ->from($this->table)
				 ->where(['is_deleted' => 0]);
		            	
		return $this->db->get()->num_rows();
	}
}