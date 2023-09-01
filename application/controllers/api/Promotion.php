<?php

class Promotion extends APIController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("PromotionModel","m_promotion");
    }

    public function getAll()
    {
        echo json_encode([
            "promotions" => $this->m_promotion->all()
        ]);
    }

}