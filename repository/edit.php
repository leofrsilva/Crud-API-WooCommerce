<?php
include '../connect.php';

if (isset($_POST['edit'])) {
    $id = $_POST['prodId'];
    $nome = $_POST['nome_edit'];
    $description = $_POST['descripton_edit'];
    $short_description = $_POST['short_descripton_edit'];

    $price = $_POST['price_edit'];

    $price_sale = $_POST['price-sala_edit'];

    $featured = (isset($_POST['featured_edit'])) ? 'true' : 'false';


    if ((!empty($nome)) && (!empty($price))) {
        $data = [
            'name' => $nome,
            'description' => $description,
            'short_description' => $short_description,
            'price' => $price,
            'regular_price' => $price,
            'sale_price' => $price_sale,
            'featured' => $featured,
        ];

        $result = $woocommerce->put('products/' . $id, $data);
        if (isset($result)) {
            $prodDel = (object) $result;
            if (isset($prodDel->id)) {
                header('Location: ../index.php');
            } else {
                echo 'ERRO';
            }
        }
    }
}
