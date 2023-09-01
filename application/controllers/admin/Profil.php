<?php

class Profil extends AdminController {

    private $folder;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("AdminModel","m_admin");
        $this->folder = dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'profils_admin' . DIRECTORY_SEPARATOR;
    }

    public function index()
    {
        $data = $this->m_admin->findOneBy(["id" => $this->session->userdata("id")]);
        unset($data->password);
        $this->load->view('admin/profil',$data);
    }

    public function updateIdentifiant()
    {
        $id = $this->session->userdata("id");
        $this->form_validation->set_error_delimiters("","");

        $username = trim($_POST["username"]);
        $password = $_POST["password"];
        $file = $_FILES["photo-file"];

        $this->form_validation->set_rules("username","username","required",[
            "required" => "Ce champ ne peut pas être vide"
        ]);
        $this->form_validation->set_rules("password","password","required",[
            "required" => "Ce champ ne peut pas être vide"
        ]);

        if(!$this->form_validation->run())
        {
            ob_start();
            $this->load->view('admin/components/form_update_identifiant',$_POST);
            $page = ob_get_clean();
            echo json_encode([
                "success" => false,
                "page" => $page
            ]);
            exit();
        }
        
        $to_update = $this->m_admin->findOneBy(["id" => $id]);
        if( strtolower($to_update->username) !== strtolower($username) )
        {
            $this->form_validation->set_rules("username","username","is_unique[admin.username]",[
                "is_unique" => "Cette identifiant est déjà utilisé"
            ]);
        }
        if(!$this->form_validation->run())
        {
            ob_start();
            $this->load->view('admin/components/form_update_identifiant',$_POST);
            $page = ob_get_clean();
            echo json_encode([
                "success" => false,
                "page" => $page
            ]);
            exit();
        }

        if(!password_verify($password, $to_update->password))
        {
            ob_start();
            $this->load->view('admin/components/form_update_identifiant',array_merge($_POST,["pwd_incorrect" => true]));
            $page = ob_get_clean();
            echo json_encode([
                "success" => false,
                "page" => $page
            ]);
            exit();
        }

        $photo = $to_update->photo;
        if($file['name'] !== "" && $file["size"] > 0)
        {
            if($photo) 
            {
                unlink($this->folder . $photo);
            }
            $photo = $file['name'];
            move_uploaded_file($file["tmp_name"], $this->folder . $photo);
        }

        $this->m_admin->update(["username","photo"],[$username,$photo,$id]);

        ob_start();
        $this->load->view('admin/components/form_update_identifiant',["username" => $username, "photo" => $photo]);
        $page = ob_get_clean();
        echo json_encode([
            "success" => true,
            "page" => $page
        ]);
    }
    public function updatePassword()
    {
        $id = $this->session->userdata("id");
        $this->form_validation->set_error_delimiters("","");

        $this->form_validation->set_rules("new_password","new-password","required",[
            "required" => "Ce champ ne peut pas être vide"
        ]);
        $this->form_validation->set_rules("confirm_password","confirm-password","required",[
            "required" => "Ce champ ne peut pas être vide"
        ]);
        $this->form_validation->set_rules("password","password","required",[
            "required" => "Ce champ ne peut pas être vide"
        ]);

        if(!$this->form_validation->run())
        {
            ob_start();
            $this->load->view("admin/components/form_update_password",$_POST);
            $page = ob_get_clean();

            echo json_encode([
                "success" => false,
                "page" => $page,
            ]);
            exit();
        }

        $to_update = $this->m_admin->findOneBy(["id" => $id]);
        $new_password = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];
        $password = $_POST["password"];

        if($new_password !== $confirm_password)
        {
            ob_start();
            $this->load->view("admin/components/form_update_password",array_merge($_POST,["not_identic" => true]));
            $page = ob_get_clean();

            echo json_encode([
                "success" => false,
                "page" => $page,
            ]);
            exit();
        }

        if( !password_verify($password, $to_update->password) )
        {
            ob_start();
            $this->load->view("admin/components/form_update_password",array_merge($_POST,["pwd_incorrect" => true]));
            $page = ob_get_clean();

            echo json_encode([
                "success" => false,
                "page" => $page,
            ]);
            exit();
        }

        $this->m_admin->update(["password"],[
            password_hash($new_password, PASSWORD_DEFAULT),
            $id
        ]);

        ob_start();
        $this->load->view("admin/components/form_update_password");
        $page = ob_get_clean();

        echo json_encode([
            "success" => true,
            "page" => $page,
        ]);
    }

}