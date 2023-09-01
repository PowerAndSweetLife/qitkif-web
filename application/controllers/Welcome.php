<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
        $this->load->model("FrontModel","m_front");
		$this->load->model('FaqModel', 'faqModel');
	}

	public function index()
	{
		// dump(getimagesize("http://localhost/qitkif-api/public/piece_jointe/pj-1672983520.jpg"));
		$this->load->view('front-office/index',[
			"header" => $this->m_front->getHeader(),
			"slogan" => $this->m_front->getSlogan() ,
			"propos" => $this->m_front->getPropos() ,
			"fonctionality" => $this->m_front->getFunctionality() ,
			"fonctionnement" => $this->m_front->getAllDescription() ,
			"contact" => $this->m_front->getAllContact() ,
		]) ;
	}

	public function sendMail() {

		$this->load->library('email');
		$message = "Nom: ".$this->input->post("nom")."\r\n" ;
		$message .= "Téléphone: ".$this->input->post("num-tel")."\r\n" ;
		$message .= "E-mail: ".$this->input->post("email")."\r\n" ;
		$message .= "Message: ".$this->input->post("message")."\r\n" ;
		$this->email->from($this->input->post("email"), $this->input->post("nom"));
		$this->email->to('contact@qitkif.com');
		// $this->email->cc('another@another-example.com');
		// $this->email->bcc('them@their-example.com');

		$this->email->subject('Contact');
		$this->email->message($message);

		$this->email->send();


		$this->load->view('front-office/index',[
			"header" => $this->m_front->getHeader() ,
			"slogan" => $this->m_front->getSlogan() ,
			"propos" => $this->m_front->getPropos() ,
			"fonctionality" => $this->m_front->getFunctionality() ,
			"fonctionnement" => $this->m_front->getAllDescription() ,
			"contact" => $this->m_front->getAllContact() ,
		]) ;
	}

	public function confidentialite() {
		$this->load->view("front-office/confidentialite",[
			"header" => $this->m_front->getHeader(),
			"slogan" => $this->m_front->getSlogan() ,
			"propos" => $this->m_front->getPropos() ,
			"fonctionality" => $this->m_front->getFunctionality() ,
			"fonctionnement" => $this->m_front->getAllDescription() ,
			"contact" => $this->m_front->getAllContact() ,
		]) ;
	}

	public function faq() {
		$this->load->view("front-office/faq",[
			"header" => $this->m_front->getHeader(),
			"slogan" => $this->m_front->getSlogan() ,
			"propos" => $this->m_front->getPropos() ,
			"fonctionality" => $this->m_front->getFunctionality() ,
			"fonctionnement" => $this->m_front->getAllDescription() ,
			"contact" => $this->m_front->getAllContact() ,
			"lists" => $this->faqModel->all()
		]) ;
	}
}
