<?php

class User extends APIController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("UserModel","m_user");
        $this->load->model("NumeroPaiementModel","m_numero");
        $this->load->model("TransactionModel","m_transaction");
    }

    public function search()
    {
        $query = trim($_POST["query"]);
        $users = $this->m_user->search('%'. $query . '%');
        echo json_encode(["users" => $users]);
    }
    public function loadMore()
    {
        $query = trim($_POST["query"]);
        $page = (int)$_POST["page"];
        $count = $this->m_user->getCount();
        $n_pages = ceil($count / UserModel::LIMIT);
        if($page > $n_pages)
        {
            echo json_encode([
                "overflow" => true,
            ]);
            exit();
        }
        $offset = (($page - 1) * UserModel::LIMIT);
        $users = $this->m_user->search('%'. $query . '%',$offset);
        echo json_encode(["users" => $users,"overflow" => false]); 
    }
    public function verifyPassword()
    {
        $code = $_POST['code'];
        $user = $this->m_user->findOneBy(["id" => $this->session->userdata('userId')]);

        if(!password_verify($code,$user->code))
        {
            echo json_encode(["valid" => false]);
            exit();
        }
        echo json_encode(["valid" => true]);
    }
    public function profil($id = null)
    {
        if($id === null)
        {
            $id = $this->session->userdata('userId');
        }
        echo json_encode([
            "profil" => $this->m_user->findOneBy(["id" => (int)$id]),
            "numeros" => $this->m_numero->findBy(["id_user" => $id]),
        ]);
    }
    public function getNumeroPaiement() 
    {
        $id = $this->session->userdata('userId');
        echo json_encode($this->m_numero->findBy(["id_user" => $id]));
    }
    public function changePhoto()
    {
        $photo = $_FILES['photo'];
        $idUser = $this->session->userdata('userId');
        $user = $this->m_user->findOneBy(["id" => $idUser]);
        $extension = pathinfo($photo['name'],PATHINFO_EXTENSION);
        $filename = $user->pseudo . '-' . time() . '.' . $extension;
        $directory = dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'profils' . DIRECTORY_SEPARATOR;
        move_uploaded_file($photo['tmp_name'],$directory . $filename);
        
        $this->m_user->update(["photo"],[$filename, $idUser]);
        if(file_exists($directory. $user->photo))
        {
            unlink($directory . $user->photo);
        }
        $user->photo = $filename;

        echo json_encode([
            'success' => true,
            'user' => $user,
        ]);
    }
    public function update()
    {
        $pseudo = trim($_POST["pseudo"]);
        $firstname = trim($_POST["firstname"]);
        $lastname = trim($_POST["lastname"]);
        $email = trim($_POST["email"]) !== '' ? trim($_POST["email"]) : null;
        $contact = CODE_PAYS . nospace($_POST["contact"]);
        
        $idUser = $this->session->userdata("userId");

        $this->m_user->update(["pseudo","firstname","lastname","email","phone"],[$pseudo,$firstname,$lastname,$email,$contact,$idUser]);

        echo json_encode([
            "success" => true,
            "profil" => $this->m_user->findOneBy(["id" => (int)$idUser]),
        ]);
    }
    public function changeCode() 
    {
        $code = trim($_POST['code']);
        $newCode = trim($_POST['newCode']);
        $idUser = $this->session->userdata("userId");
        $user = $this->m_user->findOneBy(["id" => $idUser]);

        if(!password_verify($code, $user->code))
        {
            echo json_encode(["success" => false]);
            exit();
        }
        $this->m_user->update(["code"],[password_hash($newCode, PASSWORD_DEFAULT),$idUser]);
        echo json_encode([
            "success" => true
        ]);
    }
    public function compte()
    {
        $idUser = $this->session->userdata("userId");
        $user = $this->m_user->findOneBy(["id" => $idUser]);
        $transactions = $this->m_transaction->findBy(["id_user" => $idUser]);

        foreach($transactions as $k => $transaction)
        {
            if($transaction->id_offre)
            {
                if($transaction->motif === "vente" || $transaction->motif === "achat")
                {
                    $transactions[$k]->reference = getOffreReference($transaction->id_offre);
                }
            }
            $transactions[$k]->montant = number_format((int)$transaction->montant, 0,"."," ");
        }
        echo json_encode([
            "solde" => number_format((int)$user->soldes, 0,"."," "),
            "transactions" => $transactions,
        ]);
    }

    public function resetCode() 
    {
        $id = $this->session->userdata("userId");
		$user = $this->m_user->findOneBy(['id' => $id]);
	
        
        $code = generateConfirmCode();
        file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . 'code', $code);
		$this->m_user->update(["code"],[
            password_hash($code, PASSWORD_DEFAULT) , $id
        ]);
		/**
		 * sending sms
		 * 
		 */
		sendSms(str_replace("+","",$user->phone), "Code de validation d'inscription : {$code}");
        echo json_encode(['success' => true]);
    }
}