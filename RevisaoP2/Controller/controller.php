<?php

include '../Model/Carros.php';
include '../Model/BancoDeDados.php';

$bancoDeDados = new BancoDeDados('localhost', 'root', '', 'tabela_fipe');
$bancoDeDados->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receber os dados do formulário
    $nomeModelo = $_POST['nomeModelo'];
    $fabricanteMontadora = $_POST['fabricanteMontadora'];
    $anoFabricacao = $_POST['anoFabricacao'];
    $preco = $_POST['preco'];

    // Criar objeto Carro
    $carro = new Carro($nomeModelo, $fabricanteMontadora, $anoFabricacao, $preco);

    // Inserir o carro no banco de dados
    $bancoDeDados->inserirCarro($carro);
}

$carrosCadastrados = $bancoDeDados->retornarCarros();

// Exibir os carros cadastrados na view
foreach ($carrosCadastrados as $carro) {
    echo "Nome/Modelo: " . $carro->getNomeModelo() . "<br>";
    echo "Fabricante/Montadora: " . $carro->getFabricanteMontadora() . "<br>";
    echo "Ano de Fabricação: " . $carro->getAnoFabricacao() . "<br>";
    echo "Preço: " . $carro->getPreco() . "<br><br>";
}
?>
