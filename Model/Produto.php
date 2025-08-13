<?php
namespace Model;

use Model\Connection;
use PDO;

class Produto {
    public $id;
    public $nome;
    public $descricao;
    public $preco;
    public $quantidade;

    public function getProdutos($min = null, $max = null) {
        $conn = Connection::getConnection();
        $sql = "SELECT * FROM produto";
        $params = [];

        if ($min !== null && $max !== null) {
            $sql .= " WHERE preco BETWEEN :min AND :max";
            $params = [":min" => $min, ":max" => $max];
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createProduto() {
        $conn = Connection::getConnection();
        $stmt = $conn->prepare("INSERT INTO produto (nome, descricao, preco, quantidade) VALUES (:nome, :descricao, :preco, :quantidade)");
        return $stmt->execute([
            ":nome" => $this->nome,
            ":descricao" => $this->descricao,
            ":preco" => $this->preco,
            ":quantidade" => $this->quantidade
        ]);
    }

    public function updateProduto() {
        $conn = Connection::getConnection();
        $stmt = $conn->prepare("UPDATE produto SET preco = :preco, quantidade = :quantidade WHERE id = :id");
        return $stmt->execute([
            ":preco" => $this->preco,
            ":quantidade" => $this->quantidade,
            ":id" => $this->id
        ]);
    }

    public function deleteProduto() {
        $conn = Connection::getConnection();
        $stmt = $conn->prepare("DELETE FROM produto WHERE id = :id");
        return $stmt->execute([":id" => $this->id]);
    }
}
?>