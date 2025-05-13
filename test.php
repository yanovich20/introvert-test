<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/src/MyLeadSumm.php');
use Src\MyLeadSumm;
try {
    $leadSumm = new MyLeadSumm();
    $result = $leadSumm->CalcSummForAllClients(null,null);
    echo "<pre>". print_r($result,true)."</pre>";
} catch (Exception $e) {
    echo 'Exception when calling: ', $e->getMessage(), PHP_EOL;
}