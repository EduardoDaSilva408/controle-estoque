<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cupons_model extends CI_Model {

    public function add(array $data):array{

        $dataInsert['codigo'] = addslashes($data['codigo']);
        $dataInsert['valor'] = $data['valor'];
        $dataInsert['percentual'] = isset($data['percentual']) ? 1 : 0;
        $dataInsert['vencimento'] = $data['vencimento'];

        $this->db->insert('cupom',$dataInsert);

        $cupom_id = $this->db->insert_id();  // <- CORRETO: ID do cupom inserido

        $response['cupom_id'] = $cupom_id;
        return $response;
    }

    public function list():array{
        return $this->db->get('cupom')->result();
    }

    public function getCupomById(int $cupom_id){
        return $this->db->join('produtos', 'produtos.produtos_id = cupom.produtos_id', 'inner')->where('cupom.cupom_id', $cupom_id)->get('cupom')->result()[0];
    }

    public function edit(array $data, int $cupom_id){
        $dataUpdate['codigo'] = addslashes($data['codigo']);
        $dataUpdate['valor'] = $data['valor'];
        $dataUpdate['percentual'] = isset($data['percentual']) ? 1 : 0;
        $dataUpdate['vencimento'] = $data['vencimento'];

        $this->db->where('cupom_id', $cupom_id);
        
        $update = $this->db->update('cupom', $dataUpdate);
        if(!$update)
            return $update;
        return true;
    }

    public function delete($cupom_id) {
        $this->db->where('cupom_id', $cupom_id);
        $delete = $this->db->delete('cupom');
        return $delete;
    }
}