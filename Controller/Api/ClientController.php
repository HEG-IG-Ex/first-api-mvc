<?php
class ClientController extends BaseController {
    protected $model;

    public function __construct() {
        $this->model = new ClientModel();
    }

    public function handleGetRequest() {
        if(isset($_GET['id'])){
            $clients = $this->model->read($_GET['id']);
        }else{
            if(isset($_GET['limit'])){
                $clients = $this->model->search($_GET['limit']);
            } else {
                $clients = $this->model->search();
            }
        }
        
        if ($clients) {
            http_response_code(200);
            $this->setHeaders(['Content-Type' => 'application/json']);
            echo json_encode(['data' => $clients, 'message' => 'Sucess']);
        } else {
            http_response_code(404);
        }
    }

    public function handlePostRequest() {
        $input_data = json_decode(file_get_contents('php://input'), true);

        if ($input_data) {
            $client = $this->model->create($input_data);

            if ($client) {
                http_response_code(201);
                $this->setHeaders(['Content-Type' => 'application/json']);
                echo json_encode($client);
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(400);
        }
    }

    public function handlePatchRequest() {
        $input_data = json_decode(file_get_contents('php://input'), true);
        if ($input_data && isset($_GET['id'])) {
            $client = $this->model->update($_GET['id'], $input_data);
            if ($client) {
                http_response_code(200);
                $this->setHeaders(['Content-Type' => 'application/json']);
                echo json_encode($client);
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(400);
        }
    }

    public function handlePutRequest() {
        $input_data = json_decode(file_get_contents('php://input'), true);

        if ($input_data && isset($_GET['id'])) {
            $client = $this->model->update($_GET['id'], $input_data);

            if ($client) {
                http_response_code(200);
                $this->setHeaders(['Content-Type' => 'application/json']);
                echo json_encode($client);
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(400);
        }
    }

    public function handleDeleteRequest() {
        if (isset($_GET['id'])) {
            $result = $this->model->delete($_GET['id']);

            if ($result) {
                http_response_code(204);
            } else {
                http_response_code(404);
            }
        } else {
            http_response_code(400);
        }
    }
}
?>