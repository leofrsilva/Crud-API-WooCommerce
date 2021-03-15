<?php
include '../connect.php';

if (isset($_POST['del'])) {
    $id = $_POST['prodIdDel'];
    $result = $woocommerce->delete('products/' . $id, ['force' => true]);
    if (isset($result)) {
        $prodDel = (object) $result;
        if (isset($prodDel->id) && $prodDel->id == $id) {
            header('Location: ../index.php');
        }
        else{
            echo 'ERRO';
        }
    }
    
}

?>