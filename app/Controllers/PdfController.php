<?php

namespace App\Controllers;

use App\Models\AtividadeModel;
use CodeIgniter\Controller;
use Dompdf\Options;
use App\Models\UserModel;
use App\Models\EventoModel;

define('DOMPDF_ENABLE_AUTOLOAD', false);
define("DOMPDF_ENABLE_REMOTE", true);

require_once APPPATH . 'ThirdParty' . DIRECTORY_SEPARATOR . 'dompdf' . DIRECTORY_SEPARATOR . 'autoload.inc.php';

class PdfController extends Controller
{

    public function index($user = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {

            helper(['form']);
            $uri = current_url(true);
            $evento_id = $uri->getSegment(3);
            $model =  new EventoModel();
            $newmodel = new AtividadeModel();
            $userModel = new UserModel();
            $horasTotalEvento = $newmodel->horasEvento($evento_id);

            $firstnameUser = session()->get('firstname');
            $lastnameUser = session()->get('lastname');



            //var_dump($horasTotalEvento);exit;

            if ($model) {
                $data = [
                    'title' => 'Vizualição de Certificado',
                    'data' => $model->find($evento_id),
                    'horas' => $horasTotalEvento,
                    'minutos' => $horasTotalEvento,
                    'user' => $userModel->findall(),
                    'firstname' => $firstnameUser,
                    'lastname' => $lastnameUser,

                ];


                // var_dump($data['user']);
                // exit;

                echo view('certificadoVizualizacao', $data);
            }
        }
    }

    //---------------------------------------------------------------------------------------------


    public function gerarCertificado($user = null)
    {

        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {

            helper(['form']);
            $uri = current_url(true);
            $evento_id = $uri->getSegment(4);
            // var_dump($evento_id);exit;
            $model = new EventoModel();
            $newmodel = new AtividadeModel();

            $horasTotalEvento = $newmodel->horasEvento($evento_id);

            if ($model) {
                $data = [
                    'title' => 'Certificado',
                    'data' => $model->find($evento_id),
                    'horas' => $horasTotalEvento,
                    'minutos' => $horasTotalEvento,
                    'firstname' => $user['firstname'],
                    'lastname' => $user['lastname']
                ];


                $html = view('certificado', $data);
                $options = new Options();
                $options->set('isHtml5ParserEnabled', true);
                $options->set('isRemoteEnabled', true);

                $pdf = new \Dompdf\Dompdf($options);
                $pdf->loadHtml($html);
                $pdf->setPaper('A4', 'landscape');
                $pdf->set_option('isRemoteEnabled', TRUE);
                $pdf->render();
                ob_clean();
                header("Content-Type: application/pdf");
                $pdf->stream("certificado.pdf", array("Attachment" => 1));
                exit;
            } else {
                return redirect()->to(base_url(''));
                exit;
            }
        }
    }

    //---------------------------------------------------------------------------------------------


    public function emitirCertificado()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {
            if ($this->request->getMethod(true) == 'POST') {
                $text = $this->request->getVar('textCertificado');
                $data  = [
                    'text' => $text
                ];            

                $html = view('certificadoEmpty', $data);

                $options = new Options();
                $options->set('isHtml5ParserEnabled', true);
                $options->set('isRemoteEnabled', true);

                $pdf = new \Dompdf\Dompdf($options);
                $pdf->loadHtml($html);
                $pdf->setPaper('A4', 'landscape');
                $pdf->set_option('isRemoteEnabled', TRUE);
                $pdf->render();
                ob_clean();
                header("Content-Type: application/pdf");
                $pdf->stream("certificado.pdf", array("Attachment" => 1));
                exit;
            }
        }
    }

    public function visualizarCampanha($data = null)
    {

        $urlImg = 'url("' . base_url('public/img/campanhas') . '/' . $data['background_image'] .  '")';
        $html = "<style>html{margin:20px 40px}</style>
            <div style='background-image: " . $urlImg . "; background-size: cover;
            background-repeat: no-repeat;
            width: 1049px;
            height: 741px;'>";
        $html .=  "<div style='position: relative;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);'>";

        $conteudo = html_entity_decode($data['conteudo']);
        foreach ($data['registro'] as $key => $registro) {
            $termo = "[@" . $key . "]";
            $conteudo = str_replace($termo, $registro, $conteudo);
        }

        $html .=  $conteudo;
        $html .=  "</div>";
        $html .=  "</div>";

        // echo $html;
        // exit;
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $pdf = new \Dompdf\Dompdf($options);
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        ob_clean();
        header("Content-Type: application/pdf");
        $pdf->stream("campanha.pdf", array("Attachment" => false));
        exit(0);
    }

    public function enviarCampanha($data = null)
    {
        try {
            foreach ($data['registro'] as $key => $registro) {
                ob_start();

                $userMail = trim($registro->email);
                $userNome = trim($registro->nome);

                $mail = \Config\Services::email();

                $options = new Options();
                $options->set('isHtml5ParserEnabled', true);
                $options->set('isRemoteEnabled', true);

                $config['protocol'] = getenv('protocol');
                $config['mailType'] = getenv('mailType');
                $config['SMTPHost'] = getenv('SMTPHost');
                $config['SMTPUser'] = getenv('SMTPUser');
                $config['SMTPPass'] = getenv('SMTPPass');
                $config['SMTPPort'] = getenv('SMTPPort');


                $mail->initialize($config);
                $mail->setFrom($mail->SMTPUser, 'Eventos CRF');
                $mail->setTo($userMail, $userNome);
                $mail->setSubject($data['titulo']);

                $mensagem = html_entity_decode($data['mensagem']);
                foreach ($registro as $key => $reg) {
                    $termo = "[@" . $key . "]";
                    $mensagem = str_replace($termo, $reg, $mensagem);
                }


                $urlImg = 'url("' . base_url('public/img/campanhas') . '/' . $data['background_image'] .  '")';
                $html = "<style>html{margin:20px 40px}</style>
                <div style='background-image: " . $urlImg . "; background-size: cover;
                background-repeat: no-repeat;
                width: 1049px;
                height: 741px;'>";
                $html .=  "<div style='position: relative;left: 50%;top: 50%;-webkit-transform: translate(-50%, -50%);transform: translate(-50%, -50%);'>";

                $conteudo = html_entity_decode($data['conteudo']);
                foreach ($registro as $key => $reg) {
                    $termo = "[@" . $key . "]";
                    $conteudo = str_replace($termo, $reg, $conteudo);
                }

                $html .=  $conteudo;
                $html .=  "</div>";
                $html .=  "</div>";

                $pdf = new \Dompdf\Dompdf($options);
                $pdf->loadHtml($html);
                $pdf->setPaper('A4', 'landscape');
                $pdf->render();
                $output = $pdf->output();
                $mail->attach($output, 'application/pdf', $registro->nome . '.pdf', false);
                $mail->setMessage($mensagem);
                $success = $mail->send();
                $mail->clear(TRUE);

                if (!$success) {
                    $errorMessage = error_get_last()['message'];
                    $errorMessage .= '<br>Erro ao enviar email para:' . $userMail . ' ' . $userNome;
                    echo ($errorMessage);
                    exit;
                }

                ob_clean();
            }
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
