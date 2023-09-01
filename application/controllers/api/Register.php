<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("UserModel","m_user");
		$this->load->model("NumeroPaiementModel","m_numero");
	}
	public function index() {
		echo json_encode(["success" => true]);
	}
	public function stepOne()
	{
		$fv = new FormValidation();
		$fv->required("firstname","Le nom est obligatoire")
			->required("lastname","Le prénom est obligatoire")
			->required("pseudo","Le pseudo est obligatoire")
			// ->required("email","L'adresse email est obligatoire")
			->required("phone","Vous devez ajouter un numéro")
			->required("accept",true);
		if(!$fv->isValid())
		{
			echo json_encode([
				"success" => false,
				"listErrors" => $fv->getErrors(),
			]);
			exit();
		}

		$errors = $fv->getErrors();
		$firstname = trim($_POST['firstname']);
		$lastname = trim($_POST['lastname']);
		$pseudo = trim($_POST['pseudo']);
		$email = null;
		if(array_key_exists('email', $_POST)) 
		{
			$email = trim($_POST['email']);
		}
		
		$phone = CODE_PAYS . nospace(trim($_POST['phone']));
		
		if($this->m_user->findOneBy(["pseudo" => $pseudo], 0))
		{
			$errors["pseudo"] = "Ce pseudo est déjà utilisé";
			echo json_encode([
				"success" => false,
				"listErrors" => $errors,
			]);
			exit();
		}

		if($this->m_user->findOneBy(["phone" => $phone], 0) || $this->m_numero->findOneBy(["numero" => $phone]))
		{
			$errors["phone"] = "Ce numéro est déjà utilisé";
			echo json_encode([
				"success" => false,
				"listErrors" => $errors,
			]);
			exit();
		}

		$confirm_code = generateConfirmCode();
		
		$this->m_user->insert(["firstname","lastname","pseudo","email","phone","confirm_code"],[$firstname,$lastname,$pseudo,$email,$phone,$confirm_code]);

		/**
		 * sending sms
		 * 
		 */
		sendSms(str_replace("+","",$phone), "Code de validation d'inscription : {$confirm_code}");

		$user = $this->m_user->getLastInserted();
		echo json_encode(["success" => true,"id" => $user->id]);
		
	}
	public function stepTwo()
	{
		$id = (int)$_POST["id"];
		$user = $this->m_user->findOneNofinished($id);

		$code = trim($_POST["code"]);
		if($code !== $user->confirm_code)
		{
			echo json_encode(["success" => false]);
			exit();
		}
		echo json_encode(["success" => true, "id" => $user->id]);
	}
	public function stepThree()
	{
		$code = trim($_POST["code"]);
		if(strlen($code) < 4)
		{
			echo json_encode(["success" => false]);
			exit();
		}
		$id = (int)$_POST["id"];
		$this->m_user->update(["code"],[password_hash($code,PASSWORD_DEFAULT),$id]);
		echo json_encode(["success" => true, "id" => $id]);
	}
	public function stepFour()
	{
		$code = trim($_POST["code"]);
		if(strlen($code) < 4)
		{
			echo json_encode(["success" => false]);
			exit();
		}
		$id = (int)$_POST["id"];
		$user = $this->m_user->findOneNofinished($id);
		if(!password_verify($code,$user->code))
		{
			echo json_encode(["success" => false]);
			exit();
		}
		$this->m_user->update(["is_finished"],[1,$id]);
		$this->m_numero->insert(["firstname_proprietaire","lastname_proprietaire","numero","id_user"],[$user->firstname,$user->lastname, $user->phone, $user->id]);
		$this->session->set_userdata([
            "userId" => $user->id,
            "connected" => true
        ]);
		echo json_encode(["success" => true, "pseudo" => $user->pseudo, "id" => $user->id]);
	}

	public function regenerateNumero()
	{
		$id = (int)$_POST['id'];
		$user = $this->m_user->findOneNofinished($id);
		$code = generateConfirmCode();
		
		$this->m_user->update(["confirm_code"],[$code, $id]);
		/**
		 * sending sms
		 * 
		 */
		sendSms(str_replace("+","",$user->phone), "Code de validation d'inscription : {$code}");
	}
}
