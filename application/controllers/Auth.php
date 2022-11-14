<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('auth/login');
	}

	public function signin()
	{
		$user = $this->db->escape($this->input->post('username'));
		$pass = $this->db->escape($this->input->post('password'));


		$query = $this->db->query("SELECT id, username, level, keterangan FROM tb_user WHERE username = {$user} AND password = {$pass}")->num_rows();
		if ($query > 0) {
			$gt = $this->db->query("SELECT id, username, level, keterangan FROM tb_user WHERE username = {$user} AND password = {$pass}")->result();

			$session_id = session_id();

			$data       = (object) array('session' => $session_id, 
				'id_employee' => $cek->id_employee, 
				'id_user' => $gt[0]->id, 
				'username' => $gt[0]->username, 
				'level' => $gt[0]->level, 
				'keterangan' => $gt[0]->keterangan);

			$this->session->set_userdata('session_auth', $data);

			redirect('main');
		} else {
			$this->session->set_flashdata('message', 'Username atau Password anda salah.');
			$this->session->set_flashdata('alert', 'danger');
			redirect('auth');
		}
	}

	public function signout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
}
