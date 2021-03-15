<?php

include '../connect.php';

if (isset($_POST['add'])) {
    $nome = $_POST['nome'];
    $description = $_POST['descripton'];
    $short_description = $_POST['short_descripton'];

    $price = $_POST['price'];

    $price_sale = $_POST['price-sale'];

    $featured = ( isset($_POST['featured']) ) ? true : false;
 
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
        
        $result = $woocommerce->post('products', $data);
        if (isset($result)) {
            if (isset($result)) {
                $prodDel = (object) $result;
                if (isset($prodDel->id)) {
                    header('Location: ../index.php');
                }
                else{
                    echo 'ERRO';
                }
            }
        }
    }
    
}

?>