<?php

class User extends AdminController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("UserModel","m_user");
    }

    public function index()
    {
        $lists = $this->m_user->paginate();
        $isPaginate = false;
        $count = $this->m_user->getCount();

        if($count > UserModel::LIMIT)
        {
            $isPaginate = true;
        }
        
        if($count > UserModel::LIMIT)
        {
            $isPaginate = true;
        }
        //$nPages = ceil($count/UserModel::LIMIT);

        $this->load->view("admin/user", [
            "lists" => $lists,
            "currentPage" => 1,
            "isPaginate" => $isPaginate,
            "isLast" => false,
            // "nPages" => $nPages,
        ]);
    }

    public function page(int $page)
    {
        $isPaginate = false;
        $count = $this->m_user->getCount();
        $nPages = ceil($count/UserModel::LIMIT);
        $offset = ($page - 1) * UserModel::LIMIT;
        $isLast = false;
        if($nPages === $page)
        {
            $isLast = true;
        }
        $lists = $this->m_user->paginate($offset);
        
        if($count > UserModel::LIMIT)
        {
            $isPaginate = true;
        }

        $this->load->view("admin/components/table_user", [
            "lists" => $lists,
            "currentPage" => $page,
            "isPaginate" => $isPaginate,
            "isLast" => $isLast,
            // "nPages" => $nPages,
        ]);
    }

    public function filter()
    {
        $query = trim($_POST['query']);
        if($query === '')
        {
            $this->page(1);
            return false;
        }
        $lists = $this->m_user->filterAll('%'.$query.'%');
        $this->load->view("admin/components/table_user", [
            "lists" => $lists,
            "isPaginate" => false,
            "query" => $query
        ]);

    }
    public function delete()
    {
        $id = (int)$_POST['id'];
        $this->m_user->delete($id);
        $this->page(1);
    }
}