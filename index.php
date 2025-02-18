<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';

session_start();

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-2">
        <div class="col-3 mt-3">
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="filter" placeholder="O que procura?" aria-label="O que procura?">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Buscar</button>
                </div>
            </form>
        </div>
        <table class="table mx-auto">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"><a href="?order_by=name&order=<?= getNextOrder('name') ?>" class="text-decoration-none text-dark">Produto </a> <?= setDirectionIcon('name')?> </th>
                <th scope="col"><a href="?order_by=categories&order=<?= getNextOrder('categories') ?>" class="text-decoration-none text-dark">Categoria</a> <?= setDirectionIcon('categories')?> </th>
                <th scope="col"><a href="?order_by=price&order=<?= getNextOrder('price') ?>" class="text-decoration-none text-dark">Preço</a> <?= setDirectionIcon('price')?> </th>
                <th scope="col"><a href="?order_by=inventory&order=<?= getNextOrder('inventory') ?>" class="text-decoration-none text-dark">Estoque</a> <?= setDirectionIcon('inventory')?> </th>
                <th scope="col"><a href="?order_by=total&order=<?= getNextOrder('total') ?>" class="text-decoration-none text-dark">Total</a> <?= setDirectionIcon('total')?> </th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($products) && is_array($products)) : ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <th scope="row"><?php echo ++$index ?></th>
                    <td><?= $product['name']; ?></td>
                    <td><?= $product['categories']; ?></td>
                    <td><?='R$ ' . number_format($product['price'], 2, ',', '.'); ?></td>
                    <td><?= $product['inventory']; ?></td>
                    <td><?='R$ '. number_format($product['total'],2, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <td colspan="6" class="text-center">Nenhum produto encontrado.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
