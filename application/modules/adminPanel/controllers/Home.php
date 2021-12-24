<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_controller  {

	private $table = 'logins';
	protected $redirect = '';
	
	public function index()
	{
		$data['title'] = 'dashboard';
        $data['name'] = 'dashboard';
        $data['url'] = $this->redirect;
        
        $this->load->model('Documents_model', 'documents');
        $data['documents'] = $this->documents->count();
        $this->load->model('Folder_model', 'folders');
        $data['folders'] = $this->folders->count();
        $this->load->model('Users_model', 'users');
        $data['users'] = $this->users->count();
        

		return $this->template->load('template', 'home', $data);
	}

	public function profile()
    {
        $this->form_validation->set_rules($this->profile);

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = 'profile';
            $data['name'] = 'dashboard';
            $data['operation'] = 'update';
            $data['url'] = $this->redirect;

            return $this->template->load('template', 'profile', $data);
        }
        else
        {
            $post = [
    			'mobile'   	 => $this->input->post('mobile'),
    			'email'   	 => $this->input->post('email'),
    			'name'   	 => $this->input->post('name')
    		];

            if ($this->input->post('password'))
                $post['password'] = my_crypt($this->input->post('password'));

            $id = $this->main->update(['id' => $this->session->auth], $post, $this->table);

            flashMsg($id, "Profile updated.", "Profile not updated. Try again.", $this->redirect."profile");
        }
    }

	public function logout()
    {
        $this->session->sess_destroy();
        return redirect(admin('login'));
    }

    public function mobile_check($str)
    {   
        $where = ['mobile' => $str, 'id != ' => $this->session->auth, 'is_deleted' => 0];
        
        if ($this->main->check($this->table, $where, 'id'))
        {
            $this->form_validation->set_message('mobile_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    public function email_check($str)
    {   
        $where = ['email' => $str, 'id != ' => $this->session->auth, 'is_deleted' => 0];
        
        if ($this->main->check($this->table, $where, 'id'))
        {
            $this->form_validation->set_message('email_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    protected $profile = [
        [
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 255 chars allowed"
            ],
        ],
        [
            'field' => 'mobile',
            'label' => 'Mobile',
            'rules' => 'required|numeric|exact_length[10]|callback_mobile_check',
            'errors' => [
                'required' => "%s is required",
                'numeric' => "%s is invalid",
                'exact_length' => "%s is invalid",
            ],
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|max_length[255]|callback_email_check|valid_email',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 255 chars allowed"
            ],
        ],
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'max_length[255]',
            'errors' => [
                'max_length' => "Max 255 chars allowed"
            ],
        ]
    ];
}