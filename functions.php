<?php

require_once __DIR__ . '/config.php';

#Get orders sent through GET and validates them
function getAndValidatesOrder() {
    $_SESSION['orders'] = $_SESSION['orders'] ?? [];

    $orderColumn = $_GET['order_by'] ?? null;
    $orderDirection = $_GET['order'] ?? null;

    if(in_array($orderColumn, ['name', 'categories', 'price', 'inventory', 'total'])){
        if(in_array($orderDirection, ['asc', 'desc', 'none'])){
            $_SESSION['orders'][$orderColumn] = $orderDirection;
        }
    }
    return $_SESSION['orders'];
}

/*
    Toggles the product display order between ascending,
    descending, and no order based on user interaction.
*/
function getNextOrder($column) {
    $currentOrder = $_SESSION['orders'][$column] ?? 'none';
    if($currentOrder === 'asc'){
        return 'desc';
    } elseif ($currentOrder === 'desc'){
        return 'none';
    }
    return 'asc';
}

#Set the icon according to the order direction

function setDirectionIcon($column){
    if(isset($_SESSION['orders'][$column])){
        $direction = $_SESSION['orders'][$column];

        if($direction === 'asc'){
            return '<i class="bi bi-arrow-up"></i>';
        } elseif ($direction === 'desc'){
            return '<i class="bi bi-arrow-down"></i>';
        }
    } else {
        return '';
    }
}

#Get a filter from a term sent by post
function getFilterByPost() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filter'])){
        $filter = trim($_POST['filter']);
        if (!empty($filter) && strlen($filter) >= 3) {
            $_SESSION['filter'] = "%{$filter}%";
        } else {
            unset($_SESSION['filter']);
        }
    }
}

/*
    Get products from a filter and/or by order if they are set,
    otherwise, get all products
*/
function listProducts() {
    global $pdo;
    $query = 'SELECT *, (inventory * price) AS total FROM products';

    if (!empty($_SESSION['filter'])) {
        $query .= " WHERE name LIKE :filter OR categories LIKE :filter";
    }
    $orders = getAndValidatesOrder();

    if(!empty($orders) && is_array($orders)){
        $orderArray = [];
        foreach ($orders as $column => $direction){
            if ($direction !== 'none'){
                $orderArray[] = " {$column} {$direction}";
            }
        }
        if(!empty($orderArray)){
            $query .= " ORDER BY" . implode(',', $orderArray);
        }
    }

    try {
        $stmt = $pdo->prepare($query);
        if (!empty($_SESSION['filter'])) {
            $stmt->bindValue(':filter', $_SESSION['filter']);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        echo 'Não foi possível acessar o banco de dados';
    }
}



