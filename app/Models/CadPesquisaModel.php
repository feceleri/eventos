<?php

namespace App\Models;

use CodeIgniter\Model;

class CadPesquisaModel extends Model
{
    protected $table = 'cad_Pesquisa';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';
    protected $allowedFields = ['id', 'titulo', 'data', 'data_exc', 'temas', 'forma', 'municipio', 'deleted_at'];

    public function relatorioGeral()
    {
        $result = $this->select('*')
        ->join('pesquisa', 'cad_Pesquisa.id = pesquisa.atividade', 'right')        
        ->orderBy('pesquisa.atividade')->get()->getResultArray();
        return $result;
    }

}