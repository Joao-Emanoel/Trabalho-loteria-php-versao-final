<?php

echo "lllllll                           tttt                                                   iiii                    \n" ;
echo "l:::::l                        ttt:::t                                                  i::::i                   \n" ;
echo "l:::::l                        t:::::t                                                   iiii                    \n" ;
echo "l:::::l                        t:::::t                                                                           \n" ;
echo " l::::l    ooooooooooo   ttttttt:::::ttttttt        eeeeeeeeeeee    rrrrr   rrrrrrrrr  iiiiiii   aaaaaaaaaaaaa   \n" ;
echo " l::::l  oo:::::::::::oo t:::::::::::::::::t      ee::::::::::::ee  r::::rrr:::::::::r i:::::i   a::::::::::::a  \n" ;
echo " l::::l o:::::::::::::::ot:::::::::::::::::t     e::::::eeeee:::::eer:::::::::::::::::r i::::i   aaaaaaaaa:::::a \n" ;
echo " l::::l o:::::ooooo:::::otttttt:::::::tttttt    e::::::e     e:::::err::::::rrrrr::::::ri::::i            a::::a \n" ;
echo " l::::l o::::o     o::::o      t:::::t          e:::::::eeeee::::::e r:::::r     r:::::ri::::i     aaaaaaa:::::a \n" ;
echo " l::::l o::::o     o::::o      t:::::t          e:::::::::::::::::e  r:::::r     rrrrrrri::::i   aa::::::::::::a \n" ;
echo " l::::l o::::o     o::::o      t:::::t          e::::::eeeeeeeeeee   r:::::r            i::::i  a::::aaaa::::::a \n" ;
echo " l::::l o::::o     o::::o      t:::::t    tttttte:::::::e            r:::::r            i::::i a::::a    a:::::a \n" ;
echo "l::::::lo:::::ooooo:::::o      t::::::tttt:::::te::::::::e           r:::::r           i::::::ia::::a    a:::::a \n" ;
echo "l::::::lo:::::::::::::::o      tt::::::::::::::t e::::::::eeeeeeee   r:::::r           i::::::ia:::::aaaa::::::a \n" ;
echo "l::::::l oo:::::::::::oo         tt:::::::::::tt  ee:::::::::::::e   r:::::r           i::::::i a::::::::::aa:::a\n" ;
echo "llllllll   ooooooooooo             ttttttttttt      eeeeeeeeeeeeee   rrrrrrr           iiiiiiii  aaaaaaaaaa  aaaa\n \n" ;

limpa(2);

$jogando = true;

$saldo_gastos = 0;

$valor_limites_jogo = array(6, 20, 60, "Mega-sena", 15, 20, 25, "Lotofácil", 5, 15, 80, "Quina", 50, 50, 100, "Lotofácil");
$valor_mega_sena = array(5, 35, 140, 420, 1050, 2310, 4620, 8580, 15015, 25025, 40040, 61880, 92820, 135660, 193800); 
$valor_quina = array(2.5, 15, 52.5, 140, 315, 630, 1155, 1980, 3217.5, 5005, 7507.5);
$valor_lotofacil = array(3, 48, 408, 2448, 11628, 46512);
//o array "valor_limites_jogo" me ajudam a definir o mínimo de dezenas,
//o máximo de dezenas, e o maior número possível a ser sorteado na surpresinha


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
    
    }
    else{

        $valor_dezena = 3;
        $numdezenas = 50;
    }

    if($jogo == 1){

        $valor_dezena = $valor_mega_sena[$numdezenas - 6];

    }

    elseif($jogo == 2){

        $valor_dezena = $valor_lotofacil[$numdezenas - 15];

    }

    elseif($jogo == 3){

        $valor_dezena = $valor_quina[$numdezenas - 5];

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
