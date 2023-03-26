<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class ClientModel extends Database
{
    public function getClients($limit)
    {
        return $this->select("SELECT * FROM clients ORDER BY nom ASC LIMIT ?", ["i", $limit]);
    }

    public function getClientById($id)
    {
        return $this->select("SELECT * FROM clients WHERE id = ?", ["i", $id]);
    }

    public function createClient($data)
    {
       return $this->insert("INSERT INTO clients (prenom, nom) VALUES (?, ?)", ["ss", $data["nom"], $data["prenom"]]);
    }
}
