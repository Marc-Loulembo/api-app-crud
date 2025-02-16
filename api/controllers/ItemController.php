<?php
define('ROOT_PATH', __DIR__ . '/..');
include_once(ROOT_PATH . '/models/Item.php');
include_once(ROOT_PATH . '/views/Response.php');

class ItemController {
    private $db;
    private $requestMethod;
    private $itemId;

    public function __construct($db, $requestMethod, $itemId = null) {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->itemId = $itemId;
    }

    public function processRequest() {
        switch($this->requestMethod) {
            case 'GET':
                if($this->itemId) {
                    $this->getItem($this->itemId);
                } else {
                    $this->getAllItems();
                }
                break;
            case 'POST':
                $this->createItem();
                break;
            case 'PUT':
                $this->updateItem($this->itemId);
                break;
            case 'DELETE':
                $this->deleteItem($this->itemId);
                break;
            default:
                Response::notFoundResponse("Méthode non supportée");
                break;
        }
    }

    private function getAllItems() {
        $item = new Item($this->db);
        $stmt = $item->getList();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::okResponse($items);
    }

    private function getItem($id) {
        $item = new Item($this->db);
        $item->id = (int)$id;
        $stmt = $item->getById();
        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            Response::okResponse($row);
        } else {
            Response::notFoundResponse("Item non trouvé");
        }
    }

    private function createItem() {
        $input = (array) json_decode(file_get_contents('php://input'), true);
        if(!$this->validateItem($input)) {
            Response::unprocessableEntityResponse("Données invalides");
            return;
        }
        $item = new Item($this->db);
        $item->nom = $input['nom'];
        $item->quantite = $input['quantite'];
        if($item->add()) {
            Response::createdResponse(["message" => "Item créé avec succès"]);
        } else {
            Response::unprocessableEntityResponse("Erreur lors de la création de l'item");
        }
    }

    private function updateItem($id) {
        $input = (array) json_decode(file_get_contents('php://input'), true);
        if(!$this->validateItem($input)) {
            Response::unprocessableEntityResponse("Données invalides");
            return;
        }
        $item = new Item($this->db);
        $item->id = (int)$id;
        $item->nom = $input['nom'];
        $item->quantite = $input['quantite'];
        if($item->update()){
            Response::okResponse(["message" => "Item mis à jour avec succès"]);
        } else {
            Response::notFoundResponse("Item non trouvé");
        }
    }

    private function deleteItem($id) {
        $item = new Item($this->db);
        $item->id = (int)$id;
        if($item->deleteById()){
            Response::okResponse(["message" => "Item supprimé avec succès"]);
        } else {
            Response::notFoundResponse("Item non trouvé");
        }
    }

    private function validateItem($input) {
        return isset($input['nom']) && isset($input['quantite']);
    }
}
