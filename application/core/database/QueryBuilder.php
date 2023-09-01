<?php
class QueryBuilder{

    protected $db;
    protected $query;
    protected $queryType;
    protected $lastTable;

    public function __construct(Database $db)
    {
        $this->db = $db->getConnection();
    }
    public function select($table)
    {
        $table = htmlspecialchars(trim($table));
		$this->query = "SELECT * FROM " . $table;
		$this->lastTable = $table;
        $this->queryType = "select";
		return $this;
    }
    public function insert($table)
    {
        $this->query = "INSERT INTO " . $table;
        $this->queryType = "insert";
		return $this;
    }
    public function update($table)
	{
        $this->queryType = "update";
		$this->query = "UPDATE " . $table;
		return $this;
	}
    public function delete($table)
	{
        $this->queryType = "delete";
		$table = htmlspecialchars(trim($table));
		$this->query = " DELETE FROM " . $table;
		return $this;
	}
    public function parametters(array $fields)
	{
		if (strpos($this->query, "INSERT") > -1) {
			// insertion
			$listeFields = "(";
			$valeur = "VALUES (";
			for ($i = 0; $i < count($fields); $i++) {
				$listeFields .= $fields[$i] . ",";
				$valeur .= "?,";
			}
			// manala ny ',' farany
			$listeFields = trim($listeFields, ",") . ")";

			$valeur = trim($valeur, ",") . ")";
			$this->query .= " " . $listeFields;
			$this->query .= " " . $valeur;
		} else if (strpos($this->query, "UPDATE") > -1) {
			$listeFields = "SET ";
			for ($i = 0; $i < count($fields); $i++) {
				$listeFields .= $fields[$i] . "=?,";
			}
			$listeFields = trim($listeFields, ",");
			$this->query .= " " . $listeFields;
		}

		return $this;
	}

    public function where($id, $operateur)
	{
		$this->query .= " WHERE " . $id . "" . $operateur . "?";
		return $this;
	}
	public function and($id, $operateur)
	{
		$this->query .= " AND " . $id . "" . $operateur . "?";
		return $this;
	}
	public function or($id, $operateur)
	{
		$this->query .= " OR " . $id . "" . $operateur . "?";
		return $this;
	}

    public function order($param)
	{
		$this->query .= " ORDER BY ";
		$listeOrder = "";
		foreach ($param as $key => $value) {
			$listeOrder .= $key . " " . $value . ",";
		}
		$listeOrder = trim($listeOrder, ",");
		$this->query .= $listeOrder;
		return $this;
	}
	// jointure entre 2 table
	public function inner($table2, $id1)
	{
		$table2 = htmlspecialchars(trim($table2));
		$id1 = htmlspecialchars(trim($id1));
		// ici

		$this->query .= " INNER JOIN " . $table2 . " ON " . $this->lastTable . "." . $id1 . "=" . $table2 . "." . $id1;
		$this->lastTable = $table2;


		return $this;
	}
	public function innerD($table2, $id1, $id2)
	{
		$table2 = htmlspecialchars(trim($table2));
		$id1 = htmlspecialchars(trim($id1));

		$this->query .= " INNER JOIN " . $table2 . " ON " . $this->lastTable . "." . $id1 . "=" . $table2 . "." . $id2;
		$this->lastTable = $table2;
		return $this;
	}
	public function sum($table, $fields)
	{
		$fields = htmlspecialchars(trim($fields));
		$table = htmlspecialchars(trim($table));
		$this->query = "SELECT SUM(" . $fields . ") AS somme FROM " . $table;
		return $this;
	}
	// selection avec paramètre
	public function selectParam($table, $listeFields)
	{
		$reqBase = "SELECT ";
		for ($i = 0; $i < count($listeFields); $i++) {
			$reqBase .= $listeFields[$i] . ",";
		}
		$this->query = trim($reqBase, ",") . " FROM " . $table;
        $this->queryType = "select";
		return $this;
	}
    public function selectAS($table, $fields)
	{
		// $fields est tableau associatif
		$table = htmlspecialchars(trim($table));
		$req = "SELECT ";
		$this->lastTable = $table;
        $this->queryType = "select";
		foreach ($fields as $key => $value) {
			$asValue = htmlspecialchars(trim($fields[$key]));
			$champs = htmlspecialchars(trim($key));
			$req .= $champs . " AS '" . $asValue . "' , ";
		}
		$this->query = trim(trim($req), ",") . " FROM " . $table;
		return $this;
	}
    /**
    * Requete personnalisé
    * string $query : la requette à effectué
    * array|null $params : parametres de la requette
    * boolean $all : mode de fetch :
    *                   -fetchAll : true (valeur par defaut)
    *                   -fetch : false (Selectionner une seule ligne)
    **/
    public function customQuery($query, $params = null,$all=true)
	{
        $response = false;
        $req = null;

        try {
            $req = $this->db->prepare($query);
            $response = $req->execute($params);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(strpos($query, "SELECT") > -1) {
            if($all)
            {
                return $req->fetchAll(PDO::FETCH_OBJ);
            }
            return $req->fetch(PDO::FETCH_OBJ);
        }
        return $response;
	}
    public function fetchOne(array $params = null)
    {
        $req = null;
        try {
            $req = $this->db->prepare($this->query);
            $req->execute($params);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $req->fetch(PDO::FETCH_OBJ);
    }

    public function execute(array $params = null)
    {
        $response = false;
        $req = null;
        try {
            $req = $this->db->prepare($this->query);
            $response = $req->execute($params);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        if($this->queryType === "select") {
            return $req->fetchAll(PDO::FETCH_OBJ);
        }
        return $response;
    }
    public function startTransaction()
    {
        return $this->db->beginTransaction();
    }
    public function cancelTransaction()
    {
        return $this->db->rollBack();
    }
    public function pushTransaction()
    {
        return $this->db->commit();
    }

	public function truncate(string ...$table)
	{
		foreach($table as $t)
		{
			$this->db->exec("TRUNCATE {$t}");
		}
	}
}
