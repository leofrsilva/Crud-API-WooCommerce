<?php

require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'http://petmais.atwebpages.com',
    'ck_857804cb79ab6602001aba191bd9e4e3b946e2fc',
    'cs_e310b3da5ca9006661d4d968849c9aaa10d8b1a1',
    [
        'version' => 'wc/v3',
    ]
);

?>