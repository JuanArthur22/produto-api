<?php
namespace Controller;

use Model\Produto;

class ProdutoController {
    public function getProdutos() {
        $min = $_GET['min'] ?? null;
        $max = $_GET['max'] ?? null;

        $produto = new Produto();
        $produtos = $produto->getProdutos($min, $max);

        header("Content-Type: application/json", true, 200);
        echo json_encode($produtos ?: ["message" => "Nenhum produto encontrado"]);
    }

    public function createProduto() {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->nome, $data->descricao, $data->preco, $data->quantidade)) {
            $produto = new Produto();
            $produto->nome = $data->nome;
            $produto->descricao = $data->descricao;
            $produto->preco = $data->preco;
            $produto->quantidade = $data->quantidade;

            if ($produto->createProduto()) {
                header("Content-Type: application/json", true, 201);
                echo json_encode(["message" => "Produto criado com sucesso"]);
            } else {
                header("Content-Type: application/json", true, 500);
                echo json_encode(["message" => "Falha ao criar produto"]);
            }
        } else {
            header("Content-Type: application/json", true, 400);
            echo json_encode(["message" => "Dados inválidos"]);
        }
    }

    public function updateProduto() {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->id, $data->preco, $data->quantidade)) {
            $produto = new Produto();
            $produto->id = $data->id;
            $produto->preco = $data->preco;
            $produto->quantidade = $data->quantidade;

            if ($produto->updateProduto()) {
                header("Content-Type: application/json", true, 200);
                echo json_encode(["message" => "Produto atualizado com sucesso"]);
            } else {
                header("Content-Type: application/json", true, 500);
                echo json_encode(["message" => "Falha ao atualizar produto"]);
            }
        } else {
            header("Content-Type: application/json", true, 400);
            echo json_encode(["message" => "Dados inválidos"]);
        }
    }

    public function deleteProduto() {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $produto = new Produto();
            $produto->id = $id;

            if ($produto->deleteProduto()) {
                header("Content-Type: application/json", true, 200);
                echo json_encode(["message" => "Produto excluído com sucesso"]);
            } else {
                header("Content-Type: application/json", true, 500);
                echo json_encode(["message" => "Falha ao excluir produto"]);
            }
        } else {
            header("Content-Type: application/json", true, 400);
            echo json_encode(["message" => "ID inválido"]);
        }
    }
}
?>