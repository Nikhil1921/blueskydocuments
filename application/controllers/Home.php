<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function index()
	{
		return redirect(admin());
	}
	
	public function error_404()
	{
		$this->load->view('error_404');
	}
}