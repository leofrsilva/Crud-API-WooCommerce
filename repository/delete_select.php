<?php
include '../connect.php';

use Spatie\Async\Pool;

if (isset($_POST['del'])) {
    $ids = $_POST['prodIdDel'];
    $listIds = explode("|", $ids);
    $qtdIds = count($listIds);
    $qtdIds = $qtdIds - 1;

    if ($qtdIds == 0) {
        header('Location: ../index.php');
    }

    $pool = Pool::create();

    for ($i = 0; $i < $qtdIds; $i++) {
        $id = $listIds[$i];
        $pool[] = async(function () use ($i, $qtdIds, $id, $woocommerce) {
            $result = $woocommerce->delete('products/' . $id, ['force' => true]);
            if (isset($result)) {
                $prodDel = (object) $result;
                if (isset($prodDel->id) && $prodDel->id == $id) {
                    return [$i, ($qtdIds - 1)];
                } else {
                    return 0;
                }
            }
        })->then(function ($output) {
            if (is_int($output)){
                echo 'Error';
            }
            else{
                if($output[0] == $output[1]){
                    header('Location: ../index.php');
                }
            }
        });
    }

    await($pool);
}
