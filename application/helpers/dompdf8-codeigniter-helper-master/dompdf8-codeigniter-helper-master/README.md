# dompdf8-codeigniter-helper
Codeigniter helper class for dompdf version 8


Steps
---------------------------------------------------

1. Copy the folder dompdf to application/third_party/dompdf
2. Copy dompdf.php to application/libraries/dompdf.php

Thats it. You can now use dompdf to create pdfs from html or string by using the following method in your controller


class Blog extends CI_Controller {

    public function index()
    {
    $this->load->library('dompdf');
    
    $html = $this->load->view('viewname'); // To create html from a view
                                //or
    $html = '<h1>PDF Content</h1>';        // To create html from a variable string
    
    $this->dompdf->loadHtml($html);
    $this->dompdf->render();
    
    $this->dompdf->stream("welcome.pdf");   // Directly outputs to open or save to your disk
                                //or
    $file_location = FCPATH.'yourfolder/welcome.pdf'
    $output = $this->dompdf->output();
	  file_put_contents($file_location, $output); // Save directly to the server
    
    
    }

        
}