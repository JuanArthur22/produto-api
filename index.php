<?php
require_once __DIR__ . "/Config/configuration.php";
require_once __DIR__ . "/Model/Connection.php";
require_once __DIR__ . "/Model/Produto.php";
require_once __DIR__ . "/Controller/ProdutoController.php";

use Controller\ProdutoController;

$controller = new ProdutoController();

$rota = $_GET['rota'] ?? '';
$metodo = $_SERVER['REQUEST_METHOD'];

switch ($rota) {
    case 'produtos':
        if ($metodo === 'GET') $controller->getProdutos();
        if ($metodo === 'POST') $controller->createProduto();
        if ($metodo === 'PUT') $controller->updateProduto();
        if ($metodo === 'DELETE') $controller->deleteProduto();
        break;

    default:
        header("Content-Type: application/json", true, 404);
        echo json_encode(["message" => "Rota não encontrada"]);
}
?>