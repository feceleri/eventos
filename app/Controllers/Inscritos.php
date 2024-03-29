<?php

namespace App\Controllers;

use App\Models\AtividadeModel;
use App\Models\UserModel;
use App\Models\UserAtividade;
use App\Models\CertificadoModel;

class Inscritos extends BaseController
{
    public function relatorioEvento($id = null)
    {
        $usuarios =  new UserModel();
        $inscrito = new UserAtividade();
        $certificado = new CertificadoModel();
        $atividade = new AtividadeModel();

        $uri = current_url(true);
        $eventID = $uri->getSegment(4);


        $users = $usuarios->select('users.id, concat(users.firstname," ", users.lastname) as nome, users.email, atividade_evento.idEvento, eventos.titulo, 
        pais.nome as pais, estado.nome as estado, users.`type`, group_concat(usuario_atividade.idAtividade) as atividadesconcluidas, 
        usuario_evento.created_at AS "dtInscricao", certificado.created_at AS "dataCertificado"')
            ->join('usuario_evento', 'usuario_evento.idUser =  users.id')
            ->join('eventos', 'usuario_evento.idEvento =  eventos.id')
            ->join('atividade_evento', 'eventos.id = atividade_evento.idEvento', 'left')
            ->join('pais', 'users.pais = pais.id')
            ->join('estado', 'users.estado = estado.id', 'left')
            ->join('certificado', 'users.id = certificado.idUser  AND eventos.id = certificado.idEvento ', 'left')
            ->join('usuario_atividade', 'users.id = usuario_atividade.idUser AND atividade_evento.id = usuario_atividade.idAtividade', 'left')
            ->where('eventos.id', $id)
            ->groupBy('users.id')
            ->get()
            ->getResultArray();

        // $usuariosInscritos = $usuarios->select('*')->join('usuario_evento', 'usuario_evento.idUser =  users.id')->where('usuario_evento.idEvento', $id) ->get()->getResultArray();
        // var_dump($usuariosInscritos);exit;

        $certificados = $certificado
            ->select('count(idUser) as total')
            ->where('certificado.idEvento', $eventID)
            ->first();

        $totalAtividade = $atividade
            ->select('count(id) as total')
            ->where('atividade_evento.idEvento', $eventID)
            ->first();

        $totalConcluida = $inscrito
            ->select('COUNT(idAtividade) AS total')
            ->join('atividade_evento', 'atividade_evento.id = usuario_atividade.idAtividade AND atividade_evento.idEvento = ' . $eventID)
            ->groupBy('usuario_atividade.idUser')
            ->having('total', (int)$totalAtividade['total'])
            ->get()->getResultArray();

        $result = count($totalConcluida);

        $data = [
            'title' =>  'Relatório',
            'users' => $users,
            'certificado' => $certificados,
            'inscritos' => $result,
            'eventID' => $eventID,
        ];

        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {
            echo view('templates/header', $data);
            echo view('inscritosEvento');
            echo view('templates/footer');
        }
    }

    //------------------------------------------------------------------------------

    public function emitirCertificado()
    {
        $data = [
            'title' => 'Emissão de Certificados',
        ];

        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {
            echo view('templates/header', $data);
            echo view('emitirCertificado');
            echo view('templates/footer');
        }
    }



    //--------------------------------------------------------------------

}
