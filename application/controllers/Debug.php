<?php

class Debug extends CI_Controller {

    public function __construct()
    {
        http_response_code(404);
        exit();
        parent::__construct();
    }
    public function clearTableToTestOffre()
    {
        DB::truncate("historique_offre","notification_offre","offre","paiement_user","plateforme_transaction","messages","remboursement","service_client","transaction");
        DB::update("user")
            ->parametters(["soldes","nbre_avis","total_note","nbre_achat","nbre_vente"])
            ->execute([0, 0, 0, 0, 0]);
        DB::update("plateforme")
            ->parametters(["soldes","nbre_commission","nbre_retrait"])
            ->execute([0, 0, 0]);
    }
    public function resetTable()
    {
        DB::truncate("historique_offre","messages","notification_offre","numero_paiement","offre","operateur_telephonique","paiement_user","paiement_vendeur","plateforme_numero","plateforme_transaction","promotion","remboursement","service_client","transaction","user","user_device");
        DB::update("plateforme")
            ->parametters(["soldes","nbre_commission","nbre_retrait"])
            ->execute([0, 0, 0]);
    }

}