<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produto_model extends CI_Model {

    public function add(array $data):array{

        $dataInsert['nome'] = addslashes($data['nome']);
        $dataInsert['variacoes'] = addslashes($data['variacoes']);
        $dataInsert['preco'] = $data['preco'];

        $this->db->insert('produtos',$dataInsert);

        $produto_id = $this->db->insert_id();  // <- CORRETO: ID do produto inserido

        //insere o estoque.
        $dataInsertEstoque['produtos_id'] = $produto_id;
        $dataInsertEstoque['quantidade'] = $data['quantidade'];
        $estoque_id = $this->db->insert('estoque',$dataInsertEstoque);

        $estoque_id = $this->db->insert_id();  // <- ID do estoque, se necessário
        $response['produtos_id'] = $produto_id;
        $response['estoque_id'] = $estoque_id;
        return $response;
    }

    public function list():array{
        return $this->db->get('produtos')->result();
    }

    public function select2():array{
        return $this->db->select('produtos_id as id, nome as text')->get('produtos')->result();
    }

    public function getProdutoById(int $produtos_id){
        return $this->db->join('estoque', 'estoque.produtos_id = produtos.produtos_id', 'left')->where('produtos.produtos_id', $produtos_id)->get('produtos')->result()[0];
    }

    public function getEstoqueByProdutoId(int $produto_id):array{
        $response = json_decode(json_encode($this->db->where('produtos_id', $produto_id)->get('estoque')->result()), true);
        return $response[0] ?? $response;
    }

    public function edit(array $data, int $produtos_id) {
        $dataUpdate['nome'] = addslashes($data['nome']);
        $dataUpdate['variacoes'] = addslashes($data['variacoes']);
        $dataUpdate['preco'] = $data['preco'];

        // Atualiza o produto
        $this->db->where('produtos_id', $produtos_id);
        $update = $this->db->update('produtos', $dataUpdate);

        if(!$update)
            return false;

        // Atualiza ou insere estoque
        $estoque = $this->getEstoqueByProdutoId($produtos_id);
        $dataUpdateEstoque['quantidade'] = $data['quantidade'];

        if(!empty($estoque)) {
            $this->db->where('produtos_id', $produtos_id);  // <-- ESSENCIAL
            $this->db->update('estoque', $dataUpdateEstoque);
        } else {
            $dataUpdateEstoque['produtos_id'] = $produtos_id;
            $this->db->insert('estoque', $dataUpdateEstoque);
        }

        return true;
    }


    public function delete($produtos_id) {
        $this->db->where('produtos_id', $produtos_id);
        $delete = $this->db->delete('produtos');
        return $delete;
    }

    public function changeStatusPedido(array $data){
        $pedidos_id = $data['pedidos_id'];
        $dataUpdate['status'] = $data['status'];
        $this->db->where('pedidos_id', $pedidos_id);
        $update = $this->db->update('pedidos', $dataUpdate);

        if($update){
            $response['success'] = "Webhook atualizado com sucesso";
        }else{
            $response['error'] = "Falha ao processar webhook";
        }
        return $response;
    }
}