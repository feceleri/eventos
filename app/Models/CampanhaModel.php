<?php

namespace App\Models;

use CodeIgniter\Model;

class CampanhaModel extends Model
{
    protected $table = 'campanhas';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $allowedFields = ['id', 'titulo', 'mensagem', 'conteudo', 'background_image', 'tabela', 'created_by', 'created_at', 'sent_by', 'sent_at'];
      
}