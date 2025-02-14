<?php

require 'config.php';

function listProducts() {
    global $pdo;
    try {
        $stmt = $pdo->prepare('SELECT * FROM products');
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        echo 'Não foi possível acessar o banco de dados';
    }
}

$index = 0;
$products = listProducts();
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listar produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <table class="table mx-auto">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Produto</th>
                <th scope="col">Categoria</th>
                <th scope="col">Preço</th>
                <th scope="col">Estoque</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <th scope="row"><?php echo ++$index ?></th>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['categories']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><?php echo $product['inventory']; ?></td>
                <td><?php echo 'R$'. number_format($product['inventory'] * $product['price'], 2, ','); ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
