<?php

class Offre extends AdminController {
    
    const STATES_ADMIN = [
        100 => "En attente de validation",
        110 => "En attente de validation",
        200 => "Offre accepté",
        250 => "Paiement en attente",
        300 => "Paiement en attente",
        400 => "En Preparation",
        500 => "Livraison",
        600 => "Cloturé",
        610 => "Annuler",
        700 => "Litige"
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->model("OffreModel","m_offre");
        $this->load->model("UserModel","m_user");
        $this->load->model("CategorieModel","m_categorie");
    }

    public function index()
    {
        $data = $this->m_offre->paginate();
        $isPaginate = false;
        $count = $this->m_offre->getCount();
        $lists = $this->getList($data);

        
        if($count > UserModel::LIMIT)
        {
            $isPaginate = true;
        }

        $this->load->view('admin/offre',[
            "lists" => $lists,
            "isPaginate" => $isPaginate,
            "currentPage" => 1,
            "isLast" => false
        ]);
    }

    public function page(int $page)
    {
        $isPaginate = false;
        $count = $this->m_offre->getCount();
        $nPages = ceil($count/UserModel::LIMIT);
        $offset = ($page - 1) * UserModel::LIMIT;
        $isLast = false;
        if($nPages === $page)
        {
            $isLast = true;
        }
        
        $data = $this->m_offre->paginate($offset);
        $lists = $this->getList($data);
        
        if($count > UserModel::LIMIT)
        {
            $isPaginate = true;
        }
        $this->load->view("admin/components/table_offre", [
            "lists" => $lists,
            "currentPage" => $page,
            "isPaginate" => $isPaginate,
            "isLast" => $isLast,
        ]);
    }

    private function getList($data)
    {
        foreach($data as $k=>$v)
        {
            $data[$k]->acheteur = $this->m_user->findOneBy(["id" => $v->id_acheteur]);
            $data[$k]->vendeur = $this->m_user->findOneBy(["id" => $v->id_vendeur]);
            $data[$k]->categorie = $this->m_categorie->findOne( $v->id_categorie );
        }
        return $data;
    }
    public function filter()
    {
        $query = trim($_POST['query']);
        if($query === '')
        {
            $this->page(1);
            return false;
        }
        $data = $this->m_offre->filterAll('%'.$query.'%');
        $lists = $this->getList($data);

        $this->load->view("admin/components/table_offre", [
            "lists" => $lists,
            "isPaginate" => false,
            "query" => $query
        ]);

    }
    public function delete()
    {
        $id = (int)$_POST['id'];
        $this->m_offre->delete($id);
        $this->page(1);
    }

    public function progression()
    {
        $id = (int)$_GET['idOffre'];
        $offre = $this->m_offre->findOne($id);
        $this->load->view('admin/components/modal_offre', ["state" => (int)$offre->etat]);
    }
}