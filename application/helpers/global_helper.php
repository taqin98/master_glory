<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('pre'))
{
	function pre($data)
	{

		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
}

if(!function_exists('tanggal_indo'))
{
	function tanggal_indo($tanggal)
	{
		$split_date_time = explode(' ', $tanggal);
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $split_date_time[0]);
 
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0] . ' '.$split_date_time[1];
	}
}

if(!function_exists('check_login'))
{
	function check_login()
	{

		$CI =& get_instance();
		$get_session = $CI->session->userdata('session_auth');

		$is_valid = $CI->db->query("
			SELECT * 
			FROM tb_user a 
			WHERE a.username = '$get_session->username' 
			AND a.id = '$get_session->id_user' ")->row();
		$result = (!empty($is_valid)) ? true : false;

		if ($result) {
			return TRUE;
		}else{
			redirect('auth'); exit();
		}
	}
}

if(!function_exists('admin_view'))
{
	function admin_view($data_content = null, $path_view = '')
	{
		$ci =& get_instance();
		$ci->load->view('dashboard/head', $data_content);
		$ci->load->view($path_view, $data_content);
		$ci->load->view('dashboard/foot', $data_content);
	}
}