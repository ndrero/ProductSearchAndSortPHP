<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';

$filterByPost = getFilterByPost();
$index = 0;
$products = listProducts($filterByPost);
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
    <div class="container mt-2">
        <div class="col-3 mt-3">
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="filtro" placeholder="O que procura?" aria-label="O que procura?">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Buscar</button>
                </div>
            </form>
        </div>
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
