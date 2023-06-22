<?php

class BancoDeDados {
    private $host;
    private $login;
    private $senha;
    private $dataBase;
    private $conexao;

    public function __construct($Host, $Login, $Senha, $DataBase) {
        $this->host = $Host;
        $this->login = $Login;
        $this->senha = $Senha;
        $this->dataBase = $DataBase;
    }

    public function conectar() {
        $this->conexao = new mysqli($this->host, $this->login, $this->senha, $this->dataBase);

        if ($this->conexao->connect_error) {
            die("Falha na conexão com o banco de dados: " . $this->conexao->connect_error);
        }
    }

    public function inserirCarro($carro) {
        // Verificar se o carro já existe na tabela
        $nomeModelo = $this->conexao->real_escape_string($carro->getNomeModelo());
        $fabricanteMontadora = $this->conexao->real_escape_string($carro->getFabricanteMontadora());
        $anoFabricacao = $carro->getAnoFabricacao();

        $sql = "SELECT * FROM carros WHERE nome_modelo = '$nomeModelo' AND fabricante_montadora = '$fabricanteMontadora' AND ano_fabricacao = $anoFabricacao";
        $result = $this->conexao->query($sql);
    
        if ($result->num_rows > 0) {
            echo "O carro já está cadastrado.";
            return;
        }
    
        // Se o carro não existe, realizar a inserção
        $preco = $carro->getPreco();
    
        $sql = "INSERT INTO carros (nome_modelo, fabricante_montadora, ano_fabricacao, preco) VALUES ('$nomeModelo', '$fabricanteMontadora', $anoFabricacao, $preco)";
    
        if ($this->conexao->query($sql) === TRUE) {
            echo "Carro cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o carro: " . $this->conexao->error;
        }
    }
    

    public function retornarCarros() {
        $carros = array();
        $sql = "SELECT * FROM carros";
        $result = $this->conexao->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $carro = new Carro($row['nome_modelo'], $row['fabricante_montadora'], $row['ano_fabricacao'], $row['preco']);
                $carros[] = $carro;
            }
        }

        return $carros;
    }
}
?>
