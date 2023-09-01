<?php 

class Setting extends AdminController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("SettingModel","m_setting");
    }

    public function index()
    {
        $this->load->view("admin/setting", [
            "paiement" => $this->m_setting->findById(1)
        ]);
    }

    public function get()
    {
        $this->load->view("admin/components/form_setting_paiement", [
            "post" => $this->m_setting->findById(1)
        ]);
    }

    public function update()
    {
        // $timbre = (int)$_POST["timbre"];
        $commission_vendeur = (float)$_POST["commission_vendeur"];
        $commission_acheteur = (float)$_POST["commission_acheteur"];
        $frais_operateur = (int)$_POST["frais_operateur"];

        // $this->m_setting->update(["timbre","commission_acheteur","commission_vendeur","frais_operateur"],[$timbre, $commission_acheteur, $commission_vendeur,$frais_operateur, 1]);
        $this->m_setting->update(["commission_acheteur","commission_vendeur","frais_operateur"],[$commission_acheteur, $commission_vendeur,$frais_operateur, 1]);
        ob_start();
        $this->index();
        $content = ob_get_clean();

        echo json_encode([
            "success" => true,
            "page" => $content
        ]);
    }
}