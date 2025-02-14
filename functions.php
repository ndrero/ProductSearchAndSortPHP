<?php

require_once __DIR__ . '/config.php';

#Get a filter from a term sent by post
function getFilterByPost() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filtro'])){
        return $_POST['filtro'];
    } else {
        return null;
    }
}

#Get products from a filter if it is set, otherwise, get all products
function listProducts($filter) {
    global $pdo;
    try {
        if (!empty($filter)){
            $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE '%$filter%'");
            $stmt->execute();
        } else {
            $stmt = $pdo->prepare('SELECT * FROM products');
            $stmt->execute();
        }
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        echo 'Não foi possível acessar o banco de dados';
    }
}



