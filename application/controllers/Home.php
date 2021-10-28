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

	public function download($path_lokasi)
	{
		$path = FCPATH . 'uploads/' . $path_lokasi;
		if (is_file($path)) {
			// get the file mime type using the file extension
			$this->load->helper('file');

			$mime = get_mime_by_extension($path);

			// Build the headers to push out the file properly.
			header('Pragma: public');     // required
			header('Expires: 0');         // no cache
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT');
			header('Cache-Control: private', false);
			header('Content-Type: ' . $mime);  // Add the mime type from Code igniter.
			header('Content-Disposition: attachment; filename="' . basename($path_lokasi) . '"');  // Add the file name
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: ' . filesize($path)); // provide file size
			header('Connection: close');
			readfile($path); // push it out
			exit();
		}
	}
}
