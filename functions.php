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

/*
    Get products from a filter and/or by order if they are set,
    otherwise, get all products
*/
function listProducts($filter) {
    global $pdo;
    $query = 'SELECT * FROM products';
    $filterParam = '';

    if (!empty($filter) && strlen($filter) > 3) {
        $filterParam = "%{$filter}%";
        $query .= " WHERE name LIKE :filter";
    }

    try {
        $stmt = $pdo->prepare($query);

        if (!empty($filterParam)) {
            $stmt->bindParam(':filter', $filter);

        }

        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        echo 'Não foi possível acessar o banco de dados';
    }
}



