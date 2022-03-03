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


    // public function enviarCampanha()
    // {
    //     $mail = \Config\Services::email();

    //     $user['email'] = 'felipeceleri@gmail.com';
    //     $user['firstname'] = 'Felipe';


    //     $config['protocol'] = 'mail'; // or 'smtp'
    //     $config['mailType'] = 'html'; // or 'text'
    //     $config['SMTPHost'] = 'cloud.farmaceuticosp.com.br';
    //     $config['SMTPUser'] = 'contato@farmaceuticosp.com.br';
    //     $config['SMTPPass'] = 'crf6933@';
    //     // $config['SMTPCrypto'] = 'tls'; // 'ssl' or 'tls'
    //     $config['SMTPPort'] = 587;

    //     $mail->initialize($config);

    //     $to = $user['email'];
    //     $mail->setFrom($mail->SMTPUser, 'Eventos CRF');
    //     $mail->setTo($to, $user['firstname']);
    //     $mail->setSubject('Inscrição Efetuada...');

    //     $message = "
    //             Prezado(a) " . $user['firstname'] . ",<br><br>\n
    //             Confirmamos o seu cadastro na plataforma de eventos virtuais do CRF-SP. <br><br>\n
    //             Informamos que, para assistir os eventos e emitir o certificado de participação, você deverá::<br>\n
    //             1) Estar inscrito no evento. Dentro da plataforma, escolha o evento e clique em inscrever-se. <br>\n
    //             2) Logar, nos dias do evento no link " . base_url() . " (o mesmo que se inscreveu), informando e-mail e senha, que funcionará como  lista de presença virtual<br>\n            
    //             3) Assistir o evento de forma síncrona (no dia e horário do evento, ao vivo). <br><br>\n            
                 
    //             Solicitamos, ainda, que não divulguem o link gerado pelo YouTube após entrar no evento, evitando que participantes não inscritos assistam o evento sem identificação e, consequentemente, sem direito ao certificado de participação. <br><br>\n
               
    //             Login: " . $user['email'] . "<br>
    
    //             Qualquer dúvida, estamos à disposição.\n<br>
                
    //             Atenciosamente,\n<br>
    //             Conselho Regional de Farmácia do Estado de São Paulo<br>
    //             eventos@crfsp.org.br<br>
    //             (11) 3067.1450 <br>
    //             www.crfsp.org.br";

    //     $html = "MEU PDF";
    //     $options = new Options();
    //     $options->set('isHtml5ParserEnabled', true);
    //     $options->set('isRemoteEnabled', true);

    //     $pdf = new \Dompdf\Dompdf($options);
    //     $pdf->loadHtml($html);
    //     $pdf->setPaper('A4', 'landscape');
    //     $pdf->set_option('isRemoteEnabled', TRUE);
    //     $pdf->render();
    //     $output = $pdf->output();
    //     // ob_clean();
    //     // header("Content-Type: application/pdf");


    //     $mail->attach($output, 'application/pdf', 'output.pdf', false);

    //     $mail->setMessage($message);
    //     // $mail->Body = $message;

    //     if (!$mail->send()) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }

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

                $mail = \Config\Services::email();

                $options = new Options();
                $options->set('isHtml5ParserEnabled', true);
                $options->set('isRemoteEnabled', true);
        
                $config['protocol'] = 'mail'; // or 'smtp'
                $config['mailType'] = 'html'; // or 'text'
                $config['SMTPHost'] = 'cloud.farmaceuticosp.com.br';
                $config['SMTPUser'] = 'contato@farmaceuticosp.com.br';
                $config['SMTPPass'] = 'crf6933@';
                $config['SMTPPort'] = 587;

                
                $mail->initialize($config);
                $mail->setFrom($mail->SMTPUser, 'Eventos CRF');
                $mail->setTo($registro->email, $registro->nome);
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
                $output= $pdf->output();
                $mail->attach($output, 'application/pdf', $registro->nome.'.pdf', false);
                $mail->setMessage($mensagem);
                $success = $mail->send();                
                $mail->clear(TRUE);
                               
                if (!$success) {
                    $errorMessage = error_get_last()['message'];
                    var_dump($errorMessage);
                    var_dump($success);exit;                    
                }
               
            }
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }        
    }
}
