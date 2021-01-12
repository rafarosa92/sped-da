<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use NFePHP\DA\NFe\Danfe;

$xml = file_get_contents('php://input');

try {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {

        throw new Exception('Método incorreto!');
    }
    if (empty($xml)) {
        throw new Exception('Você deve enviar um XML de um NF-e');
    }
    $danfe = new Danfe($xml);
    $danfe->debugMode(false);
    $danfe->creditsIntegratorFooter('| Sidedoor { } - https://sidedoor.com.br');
    $danfe->setDefaultFont('times');
    $danfe->setDefaultDecimalPlaces(2);
    // Caso queira mudar a configuracao padrao de impressao
    /*  $this->printParameters( $orientacao = '', $papel = 'A4', $margSup = 2, $margEsq = 2 ); */
    //Informe o numero DPEC
    /*  $danfe->depecNumber('123456789'); */
    //Configura a posicao da logo
    /*  $danfe->logoParameters($logo, 'C', false);  */
    //Gera o PDF
    $pdf = $danfe->render($logo);
    header('Content-Type: application/pdf;base64; charset=UTF-8');
    echo  base64_encode($pdf);
} catch (InvalidArgumentException $e) {
    echo "Ocorreu um erro durante o processamento :" . $e->getMessage();
}