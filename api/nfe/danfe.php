<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once realpath(__DIR__ . '/../../bootstrap.php');

use NFePHP\DA\NFe\Danfe;

$xml = file_get_contents('php://input');
// $logo = 'data://text/plain;base64,' . base64_encode(file_get_contents(realpath(__DIR__ . '/../images/tulipas.png')));
//$logo = realpath(__DIR__ . '/../images/tulipas.png');

try {

    $danfe = new Danfe($xml);
    $danfe->exibirTextoFatura = false;
    $danfe->exibirPIS = false;
    $danfe->exibirIcmsInterestadual = false;
    $danfe->exibirValorTributos = false;
    $danfe->descProdInfoComplemento = false;
    $danfe->exibirNumeroItemPedido = false;
    $danfe->setOcultarUnidadeTributavel(true);
    $danfe->obsContShow(false);
    $danfe->printParameters(
        $orientacao = 'P',
        $papel = 'A4',
        $margSup = 2,
        $margEsq = 2
    );
    // $danfe->logoParameters($logo, $logoAlign = 'C', $mode_bw = false);
    $danfe->setDefaultFont($font = 'times');
    $danfe->setDefaultDecimalPlaces(4);
    $danfe->debugMode(false);
    $danfe->creditsIntegratorFooter('| Sidedoor { } - https://sidedoor.com.br');
    //$danfe->epec('891180004131899', '14/08/2018 11:24:45'); //marca como autorizada por EPEC

    // Caso queira mudar a configuracao padrao de impressao
    /*  $this->printParameters( $orientacao = '', $papel = 'A4', $margSup = 2, $margEsq = 2 ); */
    // Caso queira sempre ocultar a unidade tributável
    /*  $this->setOcultarUnidadeTributavel(true); */
    //Informe o numero DPEC
    /*  $danfe->depecNumber('123456789'); */
    //Configura a posicao da logo
    /*  $danfe->logoParameters($logo, 'C', false);  */
    //Gera o PDF
    $pdf = $danfe->render();
    header('Content-Type: application/pdf;base64; charset=UTF-8');
    echo  base64_encode($pdf);
} catch (InvalidArgumentException $e) {
    echo "Ocorreu um erro durante o processamento :" . $e->getMessage();
}