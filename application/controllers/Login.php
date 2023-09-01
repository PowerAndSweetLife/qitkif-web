<?php
class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("AdminModel","m_admin");
    }

    public function index()
    {
        $error = false;
        $username = null;
        $password = null;
        if($this->input->method() === "post")
        {
            $username = trim($_POST["username"]);
            $password = $_POST["password"];
            $admin = $this->m_admin->findOneBy(["username" => $username]);
            if(!$admin)
            {
                $error = true;
            }
            else
            {
                if(!password_verify($password, $admin->password))
                {
                    $error = true;
                }
                else
                {
                    $data = [
                        "admin_connected" => true,
                        "id" => $admin->id,
                    ];
                    $this->session->set_userdata($data);
                    redirect(base_url('admin'));
                    exit();
                }
            }
        }
        $this->load->view('login', [
            "error" => $error,
            "username" => $username,
            "password" => $password
        ]);
    }

}