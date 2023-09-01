<?php

class NotificationModel extends CI_Model {

    public function getNotifOffreNotRead($id_user)
    {
        $res = DB::select("notification_offre")
                ->where("id_user","=")
                ->and("is_read","=")
                ->order(["created_at" => "DESC"])
                ->execute([$id_user,0]);
        return $res;
    }
}