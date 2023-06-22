<?php
class Carro
{
    private $nomeModelo;
    private $fabricanteMontadora;
    private $anoFabricacao;
    private $preco;

    public function __construct($nomeModelo, $fabricanteMontadora, $anoFabricacao, $preco)
    {
        $this->nomeModelo = $nomeModelo;
        $this->fabricanteMontadora = $fabricanteMontadora;
        $this->anoFabricacao = $anoFabricacao;
        $this->preco = $preco;
    }

    public function getNomeModelo()
    {
        return $this->nomeModelo;
    }

    public function getFabricanteMontadora()
    {
        return $this->fabricanteMontadora;
    }

    public function getAnoFabricacao()
    {
        return $this->anoFabricacao;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function atualizarPreco($taxa)
    {
        $this->preco = $this->preco * (1 + $taxa);
    }
}
