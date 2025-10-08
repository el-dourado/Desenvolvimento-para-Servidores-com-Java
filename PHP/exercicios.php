<?php
// 1 - Preço de Roupa
$peca = "Camiseta";
$tamanho = "G";
$preco_base = 0;

switch ($peca) {
    case "Camiseta":
        $preco_base = 50.00;
        break;
    case "Calça":
        $preco_base = 120.00;
        break;
    case "Jaqueta":
        $preco_base = 250.00;
        break;
    default:
        echo "Peça de roupa inválida.";
        exit;
}

$preco_final = $preco_base;
// Verifica se o tamanho é G para aplicar o acréscimo
if ($tamanho == "G") {
    $acrescimo = $preco_base * 0.10;
    $preco_final += $acrescimo;
}

echo "O preço final da " . $peca . " tamanho " . $tamanho . " é R$ " . number_format($preco_final, 2, ',', '.') . ".";


// 2 - Média de Alunos

$alunos_notas = [
    "João" => [8.5, 7.0, 9.0, 6.5],
    "Maria" => [5.0, 4.5, 6.0, 5.5],
    "Pedro" => [7.0, 6.0, 6.5, 6.0]
];

foreach ($alunos_notas as $nome => $notas) {
    $soma = array_sum($notas);
    $quantidade = count($notas);
    $media = $soma / $quantidade;

    echo "Aluno: " . $nome . " - Média: " . number_format($media, 1, ',');

// Verifica a condição de aprovação
    if ($media >= 6.0) {
        echo " (Aprovado)<br>";
    } else {
        echo " (Reprovado)<br>";
    }
}


// 3 - Soma de Pares

$soma_pares = 0;
$numeros_pares = [];
$contador = 1;

while ($contador <= 50) {
    if ($contador % 2 == 0) {
        $soma_pares += $contador;
        $numeros_pares[] = $contador;
    }
    $contador++;
}

echo "A soma de todos os números pares entre 1 e 50 é: " . $soma_pares . ".<br>";
echo "Os números pares são: " . implode(", ", $numeros_pares) . ".";


// 4 - Simulador de Caixa Eletrônico

$valor_saque = 390;
$valor_restante = $valor_saque;

echo "Analisando saque de R$ " . $valor_saque . ",00:<br>";

$notas = [100, 50, 20];// Tipos de notas disponíveis

foreach ($notas as $nota) {
    if ($valor_restante >= $nota) {
        $quantidade_notas = floor($valor_restante / $nota); // Calcula quantas notas cabem
        $valor_restante %= $nota; // Atualiza o valor restante
        echo $quantidade_notas . " nota(s) de R$ " . $nota . ",00<br>";
    }
}

// Se sobrar algum valor que nao pode ser sacado com as notas disponíveis
if ($valor_restante > 0) {
    echo "Não é possível sacar R$ " . $valor_restante . ",00 com as notas disponíveis.";
}



// 5 - Script de Carrinho de Compras

$carrinho = [
    "Teclado Mecânico" => 350.50,
    "Mouse Gamer" => 120.00,
    "Monitor 24 polegadas" => 950.75,
    "Headset" => 250.25
];

$total = 0;

echo "================ RECIBO DE COMPRA ================<br>";
echo "PRODUTO ----------------------------- PREÇO<br>";

// Itera sobre os produtos para exibi-los e calcular o total
foreach ($carrinho as $produto => $preco) {
    echo $produto . " -------------------- R$ " . number_format($preco, 2, ',', '.') . "<br>";
    $total += $preco;
}

echo "==================================================<br>";
echo "TOTAL DA COMPRA ------------------ R$ " . number_format($total, 2, ',', '.') . "<br>";
echo "==================================================";



// 6 - Script de Aumento de Salário

$salarios = [1800.00, 2500.00, 1550.50, 3200.00, 1999.99];
$salarios_ajustados = $salarios;

echo "Salários Originais: " . implode(", ", $salarios) . "<br><br>";


foreach ($salarios_ajustados as &$salario) {
    if ($salario < 2000.00) {
        $salario *= 1.10;
    }
}

unset($salario);

echo "Salários Ajustados: <br>";
foreach ($salarios_ajustados as $salario_ajustado) {
    echo "R$ " . number_format($salario_ajustado, 2, ',', '.') . "<br>";
}


?>