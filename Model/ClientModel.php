<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class ClientModel extends Database
{
    public function search($limit = null)
    {
        $query = "SELECT * FROM clients ";
        if($limit != null){
            $query .= " ORDER BY nom ASC LIMIT ?";
            $params[] = $limit;
        }else{
            $params = array();
        }
        $stmt = $this->execute($query, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function read($id = null)
    {
        $query = "SELECT * FROM clients ";
        if($id != null){
            $query .= "WHERE id = ? ORDER BY nom ASC";
            $params[] = $id;
        }else{
            $params = array();
        }
        $stmt = $this->execute($query, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO clients (nom, prenom, email, pays, npa) VALUES (?, ?, ?, ?, ?)";
        $params = array($data['nom'], $data['prenom'], $data['email'], $data['pays'], $data['npa']);
        $stmt = $this->execute($query, $params);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function update($id, $data)
    {
        $query = "UPDATE clients SET ";
        $params = array();

        if (array_key_exists('nom', $data)) {
            $query .= "nom = ?, ";
            $params[] = $data['nom'];
        }
        
        if (isset($data['prenom'])) {
            $query .= "prenom = ?, ";
            $params[] = $data['prenom'];
        }

        if (isset($data['email'])) {
            $query .= "email = ?, ";
            $params[] = $data['email'];
        }

        if (isset($data['pays'])) {
            $query .= "pays = ?, ";
            $params[] = $data['pays'];
        }

        if (isset($data['npa'])) {
            $query .= "npa = ?, ";
            $params[] = $data['npa'];
        }
        
        // remove trailing comma
        $query = rtrim($query, ", ");
        
        // add id condition
        $query .= " WHERE id = ?";
        $params[] = $id;


        $stmt = $this->execute($query, $params);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM clients WHERE id = ?";
        $params = array($id);
        $stmt = $this->execute($query, $params);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }
}
