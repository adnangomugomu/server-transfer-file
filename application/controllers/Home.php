<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('fungsi');
	}


	public function index()
	{
		$this->load->view('home/index');
	}

	public function upload()
	{
		$name = $this->input->post('data_name', true);

		if ($_FILES['file']['name']) {
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = '*';
			$config['max_size'] = 0; // 0 = no limit || default max 2048 kb
			$config['overwrite'] = false;
			$config['remove_space'] = true;
			$config['encrypt_name'] = false;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$run = $this->upload->do_upload('file'); // name inputnya
			if (!$run) {
				echo json_encode([
					'status' => 'failed',
					'msg' => $this->upload->display_errors(),
				]);
				die;
			}
			$zdata = ['upload_data' => $this->upload->data()]; // get data
			$zfile = $zdata['upload_data']['full_path']; // get file path
			chmod($zfile, 0777); // linux wajib
			$gambar = $zdata['upload_data']['file_name']; // nama file		
		}

		echo json_encode([
			'status' => 'success',
			'msg' => 'Data berhasil diupload'
		]);
	}

	public function load_data()
	{
		$data = [];

		foreach (glob("uploads/*") as $key) {
			$name = explode('/', $key);
			$size = filesize($key);

			$data[] = [
				'name' => $name[1],
				'size' => formatBytes($size),
				'path' => $key,
			];
		}

		echo json_encode([
			'status' => 'success',
			'data' => $data,
		]);
	}

	public function delete()
	{
		if (!$_POST) {
			echo 'not allowed';
		}

		error_reporting(0);

		$path = $this->input->post('path');
		$link = FCPATH . $path;

		if (unlink($link)) {
			echo json_encode([
				'status' => 'success',
				'msg' => 'Data berhasil dihapus'
			]);
		} else {
			echo json_encode([
				'status' => 'failed',
				'msg' => 'Data gagal dihapus'
			]);
		}
	}
}
