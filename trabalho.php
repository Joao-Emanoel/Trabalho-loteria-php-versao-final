<?php

echo "LOTERIA CAIXA";

limpa(2);

$jogando = true;

$saldo_gastos = 0;

$valor_limites_jogo = array(6, 20, 60, "Mega-sena", 15, 20, 25, "Lotofácil", 5, 15, 80, "Quina", 50, 50, 100, "Lotofácil");             
$valor_dezena_array = array(1 => array(5, 35, 140, 420, 1050, 2310, 4620, 8580, 15015, 25025, 40040, 61880, 92820, 135660, 193800),
                            2 => array(3, 48, 408, 2448, 11628, 46512),                                                                                                               
                            3 => array(2.5, 15, 52.5, 140, 315, 630, 1155, 1980, 3217.5, 5005, 7507.5));
                      
$max_dezena = 20;
$min_dezena = 6; 

while ($jogando == true) {

    $jogo = menu();
    
    if ($jogo == "0" ) {
        break;
    }

    while ($jogo != "1" && $jogo != "2" && $jogo != "3" && $jogo != "4") {

        echo "Informe uma opção válida\n";

        $jogo = menu();
    }

    $numapostas = readline("Quantas apostas você deseja: ");

    while ($numapostas <= 0) {
        echo "Informe um valor acima de zero\n";
        $numapostas = readline("Quantas apostas você deseja: ");
    }

        $min_dezena = definir_jogo($jogo, $valor_limites_jogo, 4);

        $max_dezena = definir_jogo($jogo, $valor_limites_jogo, 3);

        $max_num = definir_jogo($jogo, $valor_limites_jogo, 2);

    if($jogo != 4){

    $numdezenas = readline("Números de dezenas desejadas: ");

        while ($numdezenas < $min_dezena || $numdezenas > $max_dezena) {

            echo "Informe uma quantidade de dezenas entre $min_dezena e $max_dezena\n"; 
            $numdezenas = readline("Números de dezenas desejadas: ");

        }
    
        $valor_dezena = $valor_dezena_array[$jogo][$numdezenas - $min_dezena];

    }
    else{

        $valor_dezena = 3;
        $numdezenas = 50;
    }

        for ($i = 0; $i < $numapostas; $i++) {
            $posicao = $i + 1;
            echo "\n" . $posicao . "° Sorteio: ";

            $sorteios = array();

            while (count($sorteios) < $numdezenas) {
                $sorteio = rand(1, $max_num);
                if (!in_array($sorteio, $sorteios)) { //a função !in_array() serve pra evitar que tenham números repetidos no código
                    $sorteios[] = $sorteio;
                }
            }

            sort($sorteios);

            foreach ($sorteios as $sorteio) {
                echo $sorteio . " ";
            }
        }

        $valor_total = $valor_dezena * $numapostas;

        echo "\nO valor total que você gastou pra realizar essa aposta é R$".$valor_total."\n \n";

        $saldo_gastos += $valor_total;

        echo "O total de gastos atual é: R$".$saldo_gastos."\n \n";

        limpa(2);

    }

echo "Jogo encerrado. Seu total de gastos é R$".$saldo_gastos."\n";

function definir_jogo($jogo_f, $valor_limites_jogo, $pos){

        $x = $valor_limites_jogo[4 * $jogo_f - $pos];

        return $x;

}

function menu(){

    echo "              ############################ \n";
    echo "              #           JOGOS          # \n";
    echo "              ############################ \n";
    echo "              1-       -MEGA-SENA        # \n";
    echo "              ############################ \n";
    echo "              2-       -LOTOFÁCIL        # \n";
    echo "              ############################ \n";
    echo "              3-         -QUINA          # \n";
    echo "              ############################ \n";
    echo "              4-       -LOTOMANIA        # \n";
    echo "              ############################ \n";
    echo "              0-          -SAIR          # \n";
    echo "              ############################ \n \n";

    $jogo = readline("Escolha a opção: ");

    return $jogo; 

}

function limpa($tempo){

    sleep($tempo);

    echo "\033c";
}
