<?php

class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model("UserModel","m_user");
    }
    public function index()
    {
        // post(nodeUrl("test"), ["login" => "login"]);
        $username = CODE_PAYS.nospace(trim($_POST["username"]));
        $code = $_POST['code'];

        $user = $this->m_user->findOneBy(["phone" => $username]);
        if(!$user)
        {
            echo json_encode([
                "success" => false,
            ]);
            exit();
        }
        if(!password_verify($code,$user->code))
        {
            echo json_encode([
                "success" => false,
            ]);
            exit();
        }

        $this->session->set_userdata([
            "userId" => $user->id,
            "connected" => true
        ]);
        echo json_encode([
            "success" => true,
            "pseudo" => $user->pseudo,
            "id" => $user->id,
        ]);
    }

    public function resetCode() 
    {
        //$id = $this->session->userdata("userId");
        $numero = trim($_POST['username']);
		$user = $this->m_user->findOneBy(['phone' => CODE_PAYS . $numero]);
		
        if(!$user) {
            echo json_encode([
                "error" => "Aucun compte n'est associé à ce numéro '$numero'"
            ]);
            exit;
        }
        
        $code = generateConfirmCode();
        // file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . 'code', $code);
		$this->m_user->update(["code"],[
            password_hash($code, PASSWORD_DEFAULT) , $user->id
        ]);
		/**
		 * sending sms
		 * 
		 */
		sendSms(str_replace("+","",$user->phone), "Votre nouveau mot de passe sur Qitkif : {$code}");
        echo json_encode(['success' => true]);
    }

    /**
     * Verifie si la session utilisateur est active
     */
    public function session()
    {
        if($this->session->userdata("connected"))
        {
            $userId = $this->session->userdata("userId");
            echo json_encode([
                "active" => true, 
                "user" => $this->m_user->findOneBy(["id" => $userId])
            ]);
        }
        else
        {
            echo json_encode(["active" => false]);
        }
    }
}