<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_cctv extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('web_gallery_cctv_model');
		$this->modul_ini = 13;
		$this->sub_modul_ini = 801;
		$this->set_minsidebar(1);

	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		redirect('gallery');
	}

	public function index($p=1, $o=0)
	{
		$data['p'] = $p;
		$data['o'] = $o;
		$data      = ['selected_nav' => 'gallery_cctv'];


		if (isset($_SESSION['cari']))
			$data['cari'] = $_SESSION['cari'];
		else $data['cari'] = '';

		if (isset($_SESSION['filter']))
			$data['filter'] = $_SESSION['filter'];
		else $data['filter'] = '';

		if (isset($_POST['per_page']))
			$_SESSION['per_page'] = $_POST['per_page'];
		$data['per_page'] = $_SESSION['per_page'];

		$data['paging'] = $this->web_gallery_cctv_model->paging($p,$o);
		$data['main'] = $this->web_gallery_cctv_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		$data['keyword'] = $this->web_gallery_cctv_model->autocomplete();

		$this->render('gallery_cctv/table', $data);
	}

	public function cctv_luar($p=1, $o=0)
	{
		$data['p'] = $p;
		$data['o'] = $o;
		$data      = ['selected_nav' => 'cctv_luar'];


		if (isset($_SESSION['cari']))
			$data['cari'] = $_SESSION['cari'];
		else $data['cari'] = '';

		if (isset($_SESSION['filter']))
			$data['filter'] = $_SESSION['filter'];
		else $data['filter'] = '';

		if (isset($_POST['per_page']))
			$_SESSION['per_page'] = $_POST['per_page'];
		$data['per_page'] = $_SESSION['per_page'];

		$data['paging'] = $this->web_gallery_cctv_model->paging($p,$o);
		$data['main'] = $this->web_gallery_cctv_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		$data['keyword'] = $this->web_gallery_cctv_model->autocomplete();

		$this->render('gallery_cctv/table_cctv_luar', $data);
	}

	public function form($p=1, $o=0, $id='')
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if ($id)
		{
			$data['gallery'] = $this->web_gallery_cctv_model->get_gallery($id);
			$data['form_action'] = site_url("gallery_cctv/update/$id/$p/$o");
		}
		else
		{
			$data['gallery'] = null;
			$data['form_action'] = site_url("gallery_cctv/insert");
		}

		$this->render('gallery_cctv/form', $data);
	}

	public function search($gallery='')
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari'] = $cari;
		else unset($_SESSION['cari']);
		if ($gallery != '')
		{
			redirect("gallery_cctv/sub_gallery/$gallery");
		}
		else
		{
			redirect('gallery_cctv');
		}
	}

	public function filter($gallery='')
	{
		$filter = $this->input->post('filter');
		if ($filter != 0)
			$_SESSION['filter'] = $filter;
		else unset($_SESSION['filter']);
		if ($gallery != '')
		{
			redirect("gallery_cctv/sub_gallery/$gallery");
		}
		else
		{
			redirect('gallery');
		}
	}

	public function insert()
	{
		$this->web_gallery_cctv_model->insert();
		redirect('gallery_cctv');
	}

	public function update($id='', $p=1, $o=0)
	{
		$this->web_gallery_cctv_model->update($id);
		redirect("gallery_cctv/index/$p/$o");
	}

	public function delete($p=1, $o=0, $id='')
	{
		$this->redirect_hak_akses('h', "gallery_cctv/index/$p/$o");
		$this->web_gallery_cctv_model->delete_gallery($id);
		redirect("gallery_cctv/index/$p/$o");
	}

	public function delete_all($p=1, $o=0)
	{
		$this->redirect_hak_akses('h', "gallery_cctv/index/$p/$o");
		$_SESSION['success'] = 1;
		$this->web_gallery_cctv_model->delete_all_gallery();
		redirect("gallery_cctv/index/$p/$o");
	}

	public function gallery_lock($id='', $gallery='')
	{
		$this->web_gallery_cctv_model->gallery_lock($id, 1);
		if ($gallery != '')
			redirect("gallery_cctv/sub_gallery/$gallery/$p");
		else
			redirect("gallery_cctv/index/$p/$o");
	}

	public function gallery_unlock($id='', $gallery='')
	{
		$this->web_gallery_cctv_model->gallery_lock($id, 2);
		if ($gallery != '')
			redirect("gallery_cctv/sub_gallery/$gallery/$p");
		else
			redirect("gallery_cctv/index/$p/$o");
	}

	public function slider_on($id='', $gallery='')
	{
		$this->web_gallery_cctv_model->gallery_slider($id, 1);
		if ($gallery != '')
			redirect("gallery_cctv/sub_gallery/$gallery/$p");
		else
			redirect("gallery_cctv/index/$p/$o");
	}

	public function slider_off($id='', $gallery='')
	{
		$this->web_gallery_cctv_model->gallery_slider($id,0);
		if ($gallery != '')
			redirect("gallery_cctv/sub_gallery/$gallery/$p");
		else
			redirect("gallery_cctv/index/$p/$o");
	}

	public function sub_gallery($gal=0, $p=1, $o=0)
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if (isset($_SESSION['cari']))
			$data['cari'] = $_SESSION['cari'];
		else $data['cari'] = '';

		if (isset($_SESSION['filter']))
			$data['filter'] = $_SESSION['filter'];
		else $data['filter'] = '';

		if (isset($_POST['per_page']))
			$_SESSION['per_page'] = $_POST['per_page'];
		$data['per_page'] = $_SESSION['per_page'];

		$data['paging'] = $this->web_gallery_cctv_model->paging2($gal, $p);
		$data['sub_gallery'] = $this->web_gallery_cctv_model->list_sub_gallery($gal, $o, $data['paging']->offset, $data['paging']->per_page);
		$data['gallery'] = $gal;
		$data['sub'] = $this->web_gallery_cctv_model->get_gallery($gal);
		$data['keyword'] = $this->web_gallery_cctv_model->autocomplete();

		$this->render('gallery_cctv/sub_gallery_table', $data);
	}

	public function form_sub_gallery($gallery=0, $id=0)
	{
		if ($id)
		{
			$data['gallery'] = $this->web_gallery_cctv_model->get_gallery($id);
			$data['form_action'] = site_url("gallery_cctv/update_sub_gallery/$gallery/$id");
		}
		else
		{
			$data['gallery'] = null;
			$data['form_action'] = site_url("gallery_cctv/insert_sub_gallery/$gallery");
		}
		$data['album']=$gallery;

		$this->render('gallery_cctv/form_sub_gallery', $data);
	}

	public function insert_sub_gallery($gallery='')
	{
		$this->web_gallery_cctv_model->insert_sub_gallery($gallery);
		redirect("gallery_cctv/sub_gallery/$gallery");
	}

	public function update_sub_gallery($gallery='', $id='')
	{
		$this->web_gallery_cctv_model->update_sub_gallery($id);
		redirect("gallery_cctv/sub_gallery/$gallery");
	}

	public function delete_sub_gallery($gallery='', $id='')
	{
		$this->redirect_hak_akses('h', "gallery_cctv/sub_gallery/$gallery");
		$this->web_gallery_cctv_model->delete($id);
		redirect("gallery_cctv/sub_gallery/$gallery");
	}

	public function delete_all_sub_gallery($gallery='')
	{
		$this->redirect_hak_akses('h', "gallery_cctv/sub_gallery/$gallery");
		$_SESSION['success']=1;
		$this->web_gallery_cctv_model->delete_all();
		redirect("gallery_cctv/sub_gallery/$gallery");
	}

	public function gallery_lock_sub_gallery($gallery='', $id='')
	{
		$this->web_gallery_cctv_model->gallery_lock($id, 1);
		redirect("gallery_cctv/sub_gallery/$gallery");
	}

	public function gallery_unlock_sub_gallery($gallery='', $id='')
	{
		$this->web_gallery_cctv_model->gallery_lock($id, 2);
		redirect("gallery_cctv/sub_gallery/$gallery");
	}

	public function urut($id, $arah = 0, $gallery='')
	{
		$this->web_gallery_cctv_model->urut($id, $arah, $gallery);
		if ($gallery != '')
			redirect("gallery_cctv/sub_gallery/$gallery");
		else
			redirect("gallery_cctv/index");
	}
}
