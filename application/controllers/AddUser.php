<?php

class AddUser extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("UserModel","user");
        $this->load->model("NumeroPaiementModel","m_numero");
    }

    public function test()
    {
        $offre = DB::customQuery("SELECT * FROM offre WHERE id=?",[2],false);
        $datePaiement = new Datetime($offre->updated_at);
        $now = new Datetime('now');
        $diff = $now->getTimestamp() - $datePaiement->getTimestamp();
        $diffMinute = $diff / 60;

        var_dump($diffMinute > 30);
    }

    // public function index()
    // {
    //     $json = file_get_contents(dirname(dirname(__DIR__)) . '/public/users.json');
    //     $data = json_decode($json);
    //     foreach($data as $d)
    //     {
    //         $this->user->insert(["firstname","lastname","pseudo","email","phone","confirm_code","code","is_finished"],[
    //             $d->firstname,$d->lastname,$d->pseudo,$d->email,$d->phone,1234,password_hash("1234",PASSWORD_DEFAULT),1
    //         ]);
    //     }
    // }
    // public function search($query='%%',$offset=0)
    // {
    //     $res = DB::customQuery("SELECT * FROM user WHERE pseudo LIKE ? OR phone LIKE ? OR email LIKE ? LIMIT 20 OFFSET $offset",[$query,$query,$query]);
    //     var_dump($res);
    // }
    // public function addnumero()
    // {
    //     $data = DB::select('user')->execute();
    //     foreach($data as $d)
    //     {
    //         $this->m_numero->insert(["proprietaire","numero","id_user"],[
    //             $d->firstname.' '.$d->lastname,$d->phone,$d->id
    //         ]);
    //     }
    // }
}