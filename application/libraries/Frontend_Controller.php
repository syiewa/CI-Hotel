<?php
class Frontend_Controller extends MY_Controller
{

	public function __construct ()
	{
		parent::__construct();
		
		// Load stuff
		$this->load->model('m_option');
		$this->load->model('m_kelas');
                $this->load->model('m_page');
		
		// Fetch navigation
		$this->data['menu'] = $this->m_page->get_nested();
                $this->data['class'] = $this->m_kelas->get_dropdown();
		$this->data['meta_title'] = '';
	}
}