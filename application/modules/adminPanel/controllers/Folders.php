<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Folders extends Admin_controller  {

    public function __construct()
	{
		parent::__construct();
		$this->path = $this->config->item('docs');
	}

	private $table = 'folders';
	protected $redirect = 'folders';
	protected $title = 'Folder';
	protected $name = 'folders';
	
	public function index(int $parent_id = 0)
	{
        $this->load->model('Folder_model', 'folder');
		$data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['url'] = $this->redirect;
        $data['operation'] = "List";
        $data['back_id'] = $this->main->check($this->table, ['id' => d_id($parent_id)], 'parent_id');
        $data['parent_id'] = $parent_id;
        $data['folders'] = $this->folder->folders(d_id($parent_id));
        $data['datatable'] = "$this->redirect/documents";
        
		return $this->template->load('template', "$this->redirect/home", $data);
	}

	public function add(int $parent_id)
	{
        check_access();
        $this->form_validation->set_rules($this->validate);

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = $this->title;
            $data['name'] = $this->name;
            $data['operation'] = "Add";
            $data['url'] = $this->redirect;
            
            return $this->template->load('template', "$this->redirect/form", $data);
        }else{
			$post = [
				'title'       => $this->input->post('title'),
				'parent_id'   => d_id($parent_id)
			];

			$id = $this->main->add($post, $this->table);

			flashMsg($id, "$this->title added.", "$this->title not added. Try again.", "$this->redirect/$parent_id");
        }
	}

	public function upload(int $parent_id)
	{
        check_access();
        $this->form_validation->set_rules($this->validate);

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = "document";
            $data['name'] = $this->name;
            $data['operation'] = "upload";
            $data['url'] = $this->redirect;
            
            return $this->template->load('template', "$this->redirect/upload", $data);
        }else{
			$image = $this->uploadImage('image');
            if ($image['error'] == TRUE)
			    flashMsg(0, "", $image["message"], "$this->redirect/upload/$parent_id");
            else{
                $post = [
                    'title'         => $this->input->post('title'),
                    'description'   => $this->input->post('description'),
                    'document_file' => $image['message'],
                    'created_by'	=> $this->session->auth,
                    'created_at'	=> date('Y-m-d H:i:s'),
					'folder_id'     => d_id($parent_id)
                ];

                $id = $this->main->add($post, 'documents');

                flashMsg($id, "$this->title uploaded.", "$this->title not uploaded. Try again.", "$this->redirect/$parent_id");
            }
        }
	}

	public function update(int $id)
	{
        check_access();
        $this->form_validation->set_rules($this->validate);

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = "document";
            $data['name'] = $this->name;
            $data['operation'] = "Update";
            $data['url'] = $this->redirect;
            $data['data'] = $this->main->get("documents", 'title, document_file, description', ['id' => d_id($id)]);
            
            return $this->template->load('template', "$this->redirect/upload", $data);
        }else{
            $post = [
                    'title'         => $this->input->post('title'),
                    'description'   => $this->input->post('description'),
                    'updated_by'	=> $this->session->auth,
                    'updated_at'	=> date('Y-m-d H:i:s')
                ];

            if (!empty($_FILES['image']['name'])) {
                $image = $this->uploadImage('image');
                if ($image['error'] == TRUE)
                    flashMsg(0, "", $image["message"], "$this->redirect/update/$id");
                else{
                    if (file_exists($this->path.$this->input->post('image')))
                        unlink($this->path.$this->input->post('image'));
                    $post['document_file'] = $image['message'];
                }
            }
            
            $id = $this->main->update(['id' => d_id($id)], $post, 'documents');

            flashMsg($id, "$this->title updated.", "$this->title not updated. Try again.", $this->redirect);
        }
	}

    public function documents()
    {
        check_ajax();
        $this->load->model('documents_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $_GET['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = '<input type="checkbox" class="check_class" data-name="'.$row->document_file.'" value="'.base_url($this->path.$row->document_file).'" name="docs[]" />';
            $sub_array[] = $sr;
            $sub_array[] = $row->title;
            $sub_array[] = date('d-m-Y h:i A',strtotime($row->created_at));
            $sub_array[] = $row->updated_at != '0000-00-00 00:00:00' ? date('d-m-Y h:i A',strtotime($row->updated_at)) : 'NA';
            
            $action = '<div class="btn-group" role="group"><button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon-settings"></span></button><div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start">';
            
            $action .= anchor($this->path.$row->document_file, '<i class="fa fa-eye"></i> View</a>', 'class="dropdown-item" target="_blank"');
            $action .= anchor($this->path.$row->document_file, '<i class="fa fa-download"></i> Download</a>', 'class="dropdown-item" download="download"');
            if (access()) {
                $action .= anchor($this->redirect."/update/".e_id($row->id), '<i class="fa fa-edit"></i> Edit</a>', 'class="dropdown-item"');
                $action .= form_open($this->redirect.'/document-delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id)]).
                    '<a class="dropdown-item" onclick="script.delete('.e_id($row->id).'); return false;" href=""><i class="fa fa-trash"></i> Delete</a>'.
                    form_close();
            }
                
            $sub_array[] = $action;

            $data[] = $sub_array;  
            $sr++;
        }

        $output = [
            "draw"              => intval($_GET["draw"]),  
            "recordsTotal"      => $this->data->count(),
            "recordsFiltered"   => $this->data->get_filtered_data(),
            "data"              => $data
        ];
        
        die(json_encode($output));
    }

    public function document_delete()
    {
        check_access();
        $this->form_validation->set_rules('id', 'id', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE)
            $response = [
                        'message' => "Some required fields are missing.",
                        'status' => false
                    ];
        else{
            $post = [
                    'is_deleted'    => 1,
                    'updated_by'	=> $this->session->auth,
                    'updated_at'	=> date('Y-m-d H:i:s')
                ];
                
            if ($this->main->update(['id' => d_id($this->input->post('id'))], $post, 'documents'))
                $response = [
                    'message' => "Document deleted.",
                    'status' => true
                ];
            else
                $response = [
                    'message' => "Document not deleted.",
                    'status' => false
                ];
        }
                
        flashMsg($response['status'], $response['message'], $response['message'], $this->redirect);
    }

    public function upload_documents()
    {
        $image = $this->uploadImage('file');
        if ($image['error'] == TRUE)
            $response = $image;
        else{
            $relativePath = explode('/', substr_replace($this->input->post('relativePath') ,"", -1));
            $parent_id = d_id($this->input->post('folder_id'));

            foreach ($relativePath as $k => $path) {
                if ($k != 0) {
                    $parent_id = $this->main->check($this->table, ['title' => $relativePath[$k-1], 'parent_id' => $parent_id, 'is_deleted' => 0], 'id');
                }
                $folder_id = $this->main->check($this->table, ['title' => $path, 'parent_id' => $parent_id, 'is_deleted' => 0], 'id');
                $folder_id = $folder_id ? $folder_id : $this->main->add(['title' => $path, 'parent_id' => $parent_id], $this->table);
            }

            $title = explode('.', $this->input->post('name'));

            $post = [
                'title'         => reset($title),
                'description'   => "NA",
                'document_file' => $image['message'],
                'created_by'	=> $this->session->auth,
                'created_at'	=> date('Y-m-d H:i:s'),
                'folder_id'     => $folder_id
            ];

            if ($this->main->add($post, 'documents'))
                $response = [
                    'message' => "Document uploaded.",
                    'status' => true
                ];
            else
                $response = [
                    'message' => "Document not uploaded.",
                    'status' => false
                ];
        }

        die(json_encode($response));
    }

	protected $validate = [
        [
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 255 chars allowed.",
            ],
        ]
    ];
}