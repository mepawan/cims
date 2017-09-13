<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

        public function index()
        {
            $this->load->library('dompdf');
			$html = $this->load->view('viewname');
			$this->dompdf->loadHtml($html);
			$this->dompdf->render();
			$this->dompdf->stream("welcome.pdf");
        }

        
}