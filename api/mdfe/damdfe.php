<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once realpath(__DIR__ . '/../../bootstrap.php');

use NFePHP\DA\MDFe\Damdfe;

$xml = file_get_contents('php://input');
$logo = realpath(__DIR__ . '/../images/contrail_logo.jpg');
try {
    $damdfe = new Damdfe($xml);
    $damdfe->debugMode(true);
    $damdfe->creditsIntegratorFooter('| Sidedoor { } - https://sidedoor.com.br');
    $damdfe->printParameters('L');
    $pdf = $damdfe->render($logo);
    header('Content-Type: application/pdf;base64; charset=UTF-8');
    echo base64_encode($pdf);
} catch (Exception $e) {
    header('Content-Type: application/json');
    header('HTTP/1.1 400 Bad Request', true, 400);
    echo json_encode(["Error" => $e->getMessage()]);
}
