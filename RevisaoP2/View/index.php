<!DOCTYPE html>
<html>
<head>
    <title>Tabela FIPE</title>
</head>
<body>
    <h1>Cadastro de Carros</h1>
    <form action="../Controller/controller.php" method="post">
        <label for="nomeModelo">Nome/Modelo:</label>
        <input type="text" name="nomeModelo" required><br><br>
        <label for="fabricanteMontadora">Fabricante/Montadora:</label>
        <input type="text" name="fabricanteMontadora" required><br><br>
        <label for="anoFabricacao">Ano de Fabricação:</label>
        <input type="text" name="anoFabricacao" required><br><br>
        <label for="preco">Preço:</label>
        <input type="text" name="preco" required><br><br>
        <input type="submit" value="Cadastrar">
    </form>

    <h1>Carros Cadastrados</h1>
    <?php
    include '../Model/Carros.php';
    include '../Model/BancoDeDados.php';

    $bancoDeDados = new BancoDeDados('localhost', 'root', '', 'tabela_fipe');
    $bancoDeDados->conectar();

    $carrosCadastrados = $bancoDeDados->retornarCarros();

    foreach ($carrosCadastrados as $carro) {
        echo "Nome/Modelo: " . $carro->getNomeModelo() . "<br>";
        echo "Fabricante/Montadora: " . $carro->getFabricanteMontadora() . "<br>";
        echo "Ano de Fabricação: " . $carro->getAnoFabricacao() . "<br>";
        echo "Preço: " . $carro->getPreco() . "<br><br>";
    }
    ?>
</body>
</html>
