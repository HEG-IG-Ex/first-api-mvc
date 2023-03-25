<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class ClientModel extends Database
{
    public function getClients($limit)
    {
        return $this->select("SELECT * FROM clients ORDER BY nom ASC LIMIT ?", ["i", $limit]);
    }
}
?>