<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Barang extends CI_Controller
{
	
	public function index()
	{
		$konten = $this->load->view('barang/list_barang', null, true);
		$data_json = array(
			'konten' => $konten,
			'titel' => 'List Data Barang',
		);

		echo json_encode($data_json);
	}

	public function form_create()
	{
		$konten = $this->load->view('barang/form_barang', $data_view, true);
		$data_json = array(
			'konten' => $konten,
			'titel' => 'Form Data Barang Baru',
		);

		echo json_encode($data_json);
	}

}