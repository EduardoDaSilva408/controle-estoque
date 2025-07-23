<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos_model extends CI_Model {

     public function add(array $data):array{

        //Valida o e-mail.
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            return ['code'=>400, 'message'=>'email invalido'];
        }

        //Valida o Cep.
        if(!$this->validateCep($data['cep'])){
            return ['code'=>400, 'message'=>'cep invalido'];
        }

        //Verifica os produtos em estoque.
        $CI =& get_instance();
        $CI->load->model('Produto_model');

        $produto = json_decode(json_encode($CI->Produto_model->getProdutoById($data['produtos_id'])), true);

        //Valida se tem estoque do produto.
        if($produto['quantidade'] < $data['quantidade']){
            return ['code'=>400, 'message'=>'estoque insuficiente'];
        }

        

        $dataInsert['produtos_id'] = $data['produtos_id'];
        $dataInsert['email'] = $data['email'];
        $dataInsert['cep'] = $data['cep'];

        $dataInsert['quantidade'] = $data['quantidade'];
        $dataInsert['frete'] = $this->calculaFrete($data['produtos_id'], $data['quantidade']);
        $dataInsert['valor_total'] = $produto['preco'] * $data['quantidade'] + $dataInsert['frete'];

        //Checa se tem cupom.
        if(!empty($data['cupom'])){
            //checa se o cupom é valido.
            $cupom = json_decode(json_encode($this->getCupomByCode($data['cupom'])), true);
            if(!empty($cupom)){
                if($cupom['percentual'] == 1){
                    $dataInsert['valor_total'] -= ($dataInsert['valor_total'] / $cupom['valor']);
                }else{
                    $dataInsert['valor_total'] -= $cupom['valor'];
                }
            }
        }

        $this->db->insert('pedidos',$dataInsert);

        $pedidos_id = $this->db->insert_id();  // <- CORRETO: ID do produto inserido

        //deduz a quantidade de produtos no estoque.
        $this->db->where('produtos_id', $data['produtos_id']);
        $dataUpdate['quantidade'] = $produto['quantidade'] - $data['quantidade'];
        $update = $this->db->update('estoque', $dataUpdate);


        $response['pedidos_id'] = $pedidos_id;
        return $response;
    }

    public function validateCep(string $cep):bool{
        $url = "https://viacep.com.br/ws/{$cep}/json/";

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($http_code === 200) {
            $dados = json_decode($response, true);

            // ViaCEP retorna {"erro": true} para CEP inválido, mesmo com código 200
            if (isset($dados['erro']) && $dados['erro'] === true) {
                return false;  // CEP inválido
            }

            return true;  // CEP válido
        }

        return false;  // Erro na requisição (ex.: código 400)
    }

    public function verificaEstoqueProduto(int $produto_id):array{
        $response = $this->db->where('produtos_id', $produto_id)->get('estoque')->result();
        return $response[0] ?? $response;
    
    }

    public function calculaFrete(int $produtos_id, int $quantidade):float{
        $CI =& get_instance();
        $CI->load->model('Produto_model');

        $produto = json_decode(json_encode($CI->Produto_model->getProdutoById($produtos_id)), true);
        $preco = $produto['preco'];
        if($preco * $quantidade >= 52 && $preco * $quantidade <= 166.59){
            $frete = 15;
        }else if($preco * $quantidade > 200){
            $frete = 0;
        }else{
            $frete = 20;
        }
        return $frete;
    }

    public function getCupomByCode(string $code){
        return $this->db->where('cupom.codigo', $code)->get('cupom')->result()[0] ?? [];
    }
}