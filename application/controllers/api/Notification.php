<?php

class Notification extends APIController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('NotificationOffreModel','m_notif');
        $this->load->model('OffreModel','m_offre');
        $this->load->model("UserModel","m_user");
    }

    public function lists($type=null)
    {
        $res = $this->m_notif->findBy(["id_user" => $this->session->userdata("userId")]);
        foreach($res as $key => $value)
        {
            $clientId = null;
            $offre = $this->m_offre->findOne($value->id_offre);
            
            $currentState = (int)$offre->etat;

            if((int)$offre->id_acheteur === (int)$value->id_user)
            {
                $clientId = $offre->id_vendeur;
            }
            else
            {
                $clientId = $offre->id_acheteur;
            }
            $client = $this->m_user->findOneBy(["id" => $clientId]);
            
            $message = null;
            $action = null;
            $info = null;
            $ref = getOffreReference($offre->id);

            switch ((int)$value->etat) {
                case Offre::WAIT_VALIDATION:
                    if($offre->action === "vente")
                    {
                        $message = "{$client->pseudo} a envoyé une proposition de vente";
                    }
                    else
                    {
                        $message = "{$client->pseudo} a envoyé une proposition d'achat";
                    }
                    $action = "validation";
                    break;
                case Offre::WAIT_VALIDATION_CONTRE: 
                    if($offre->action === "vente")
                    {
                        $message = "{$client->pseudo} a envoyé une contre-proposition de vente \nVous avez 30 minutes pour réagir";
                    }
                    else
                    {
                        $message = "{$client->pseudo} a envoyé une contre-proposition d'achat \nVous avez 30 minutes pour réagir";
                    }
                    $action = "validation_contre";
                    break;
                case Offre::ACCEPTED:
                    if((int)$offre->contre) {
                        if($offre->action === "vente") {
                            $message = "{$client->pseudo} a accepté votre contre-proposition! \nVous avez 30 minutes pour effectuer le paiement";
                            $action = "paiement";
                        } else {
                            $message = "{$client->pseudo} a accepté votre contre-proposition! \nVous pouvez maintenant activer le paiement\nVous avez 30 minutes pour réagir";
                            $action = "active_paiement";
                        }
                    }
                    else
                    {
                        if($offre->action === "vente") {
                            $message = "{$client->pseudo} a accepté votre proposition! \nVous pouvez maintenant activer le paiement \nVous avez 30 minutes pour réagir";
                            $action = "active_paiement";
                        } else {
                            $message = "{$client->pseudo} a accepté votre proposition! \nVous avez 30 minutes pour effectuer le paiement";
                            $action = "paiement";
                        }
                    }
                    break;
                case Offre::ACCEPTED_AND_PAY_ACTIVE:
                    $message = "{$client->pseudo} a accepté votre proposition et activé le paiement! Vous avez 30 minutes pour faire la transaction";
                    $action = "paiement";
                    break;
                case Offre::PAY_ACTIVE:
                    $message = "{$client->pseudo} a activé le paiement! Vous avez 30 minutes pour faire la transaction";
                    $action = "paiement";
                    break;
                case Offre::PAY_SUCCESS:
                    $message = "{$client->pseudo} a effectué le paiement! Vous devez valider la preparation da la commande";
                    $action = "preparation";
                    break;
                case Offre::LIVRAISON:
                    $message = "{$client->pseudo} a procédé à la mise en livraison de l'article '{$offre->nom_objet}' vous recevrez le colis d'ici {$offre->duree_livraison} h";
                    $action = "livraison";
                    break;
                case Offre::CLOSE_NOT_SUCCESS:
                    $observation = json_decode($offre->observation);
                    if($observation->state === 'expired') 
                    {
                        $message = "Délai d'attente dépassé, Cette offre est annulée et fermée";
                    }
                    else if ($observation->state === 'rejected')
                    {
                        $message = "{$client->pseudo} a refusé votre proposition! cette offre est fermée";
                    }
                    else if ($observation->state === 'aborted')
                    {
                        $message = "{$client->pseudo} a annulé cette offre! cette offre est fermée";
                    }
                    $action = "fermeture";
                    break;
                case Offre::LITIGE:
                    $message = "a lancé un litige sur l'article '{$offre->nom_objet}'";
                    $action = "litige";
                    break;
                default:
                    break;
            }

            if($currentState >= Offre::CLOSE_SUCCESS)
            {
                if($currentState === Offre::CLOSE_NOT_SUCCESS)
                {
                    $observation = json_decode($offre->observation);
                    if($observation->state === 'aborted')
                    {
                        $info = 'Cette offre est annulé';
                    }
                    if($observation->state === 'rejected')
                    {
                        $info = 'Offre réfusé';
                    }
                    if($observation->state === 'expired')
                    {
                        $info = 'Offre expiré';
                    }
                }
                $action = 'fermeture';
            }
            if($currentState === Offre::LITIGE)
            {
                $action = "litige";
            }

            $res[$key]->offre = $offre;
            $res[$key]->client = $client;
            $res[$key]->message = $message;
            $res[$key]->ref = $ref;
            $res[$key]->user_action = $action;
            $res[$key]->info = $info;
        }

        echo json_encode([
            "notifications" => $res,
        ]);
    }

    public function markAsRead()
    {
        $idNotif = (int)$_POST['idNotif'];
        $this->m_notif->update(['is_read'],[1,$idNotif]);

        echo json_encode(["success" => true]);
    }

    public function registerDevice()
    {
        $token = $_POST["token"];
        $userId = $this->session->userdata("userId");

        if(!$this->m_notif->findOneDeviceBy(["id_user" => $userId, "token_device" => $token]))
        {
            $this->m_notif->registerDevice(["id_user","token_device"],[$userId,$token]);
        }
    }

    public function getUnread()
    {
        $idUser = $this->session->userdata("userId");
        echo json_encode([
            "count" => $this->m_notif->getCountUnread($idUser)
        ]);
    }

    
}