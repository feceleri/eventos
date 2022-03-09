<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\CampanhaModel;

use DOMDocument;
use Exception;


class Campanhas extends BaseController
{

    use ResponseTrait;


    public function listar()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {
            $model = new CampanhaModel();
            $data = [
                'title' => 'Campanhas',
                'data' => $model->orderBy('id','DESC')->findAll(),
            ];
            echo view('listarCampanhas', $data);
        }
    }


    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {
            $data = [
                'title' => 'Campanhas'
            ];

            if ($this->request->getMethod() == 'post') {
                if (!empty($this->request->getFile('xmlfields')->getClientName())) {
                    $arquivo = new DOMDocument();
                    $xml = simplexml_load_file($this->request->getFile('xmlfields'));
                    $arquivo->loadXML($xml->asXML());
                    $linhas = $arquivo->getElementsByTagName('Row');

                    $primeira_linha = true;
                    $tabela = [];
                    $campos = [];
                    foreach ($linhas as $linha) {
                        if ($primeira_linha) {
                            $qtd = $linha->getElementsByTagName('Cell');
                            for ($i = 0; $i < $qtd->length; $i++) {
                                $campos[$i] = $qtd->item($i)->nodeValue;
                            }
                            $primeira_linha = false;
                            continue;
                        } else {
                            $qtd = $linha->getElementsByTagName('Cell');
                            for ($i = 0; $i < $qtd->length; $i++) {
                                $valores[$campos[$i]] = $qtd->item($i)->nodeValue;
                            }
                            array_push($tabela, $valores);
                        }
                    }

                    $uploadImagem = $this->upload_image($this->request->getFile('background_image'));
                    if ($uploadImagem) {
                        $newData = [
                            'tabela' => json_encode($tabela),
                            'conteudo' => htmlentities($this->request->getPost('conteudo')),
                            'mensagem' => htmlentities($this->request->getPost('mensagem')),
                            'titulo' => $this->request->getPost('titulo'),
                            'background_image' => $uploadImagem,
                            'created_by' => session()->get('id')
                        ];

                        $model = new CampanhaModel();

                        if ($model->save($newData)) {
                            $session = session();
                            $session->setFlashdata('success', 'Sua campanha foi cadastrada com sucesso!');
                            return redirect()->to(base_url('listarCampanhas'));
                        } else {
                            echo "Erro ao salvar";
                            exit;
                        }
                    } else {
                        echo "Erro no upload";
                        exit;
                    }
                } else {
                    return $this->respondCreated('Erro na leitura do arquivo!');
                    exit;
                }
            }
            echo view('cadastroCampanhas', $data);
        }
    }

    //------------------------------------------------------------------------------

    public function gerarCertificado()
    {

        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {
            $model = new EventoModel();
            $idUser = session()->get('id');
            $firstnameUser = session()->get('firstname');
            $lastnameUser = session()->get('lastname');
            $uri = current_url(true);
            $idEvento = $uri->getSegment(4);
        }

        $session = session();
        // $msg = $model->certificado($idUser, $idEvento, $firstnameUser, $lastnameUser);

        if (isset($msg[0]['firstname'])) {
            $user['firstname'] = $msg[0]['firstname'];
            $user['lastname'] = $msg[0]['lastname'];
            $session->setFlashdata('info', 'Certificado já foi gerado, não é possivel alterar mais os dados!');
        } else {
            $user['firstname'] = $firstnameUser;
            $user['lastname'] = $lastnameUser;
            $session->setFlashdata('success', 'Certificado gerado com sucesso!');
        }

        $pdf = new PdfController();
        echo $pdf->gerarCertificado($user);

        $session->set('firstname',  $firstnameUser);
        $session->set('lastname', $lastnameUser);

        return redirect()->to(base_url('listarEventosUser'));
    }

    //------------------------------------------------------------------------------

    public function upload_image($imagem)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {
            $imageFile = $imagem;
            $nome = md5(uniqid()) . '_' . time() . '.jpg';
            if ($imageFile->move(WRITEPATH . '../public/img/campanhas/', $nome)) {
                return $nome;
            } else {
                return false;
            }
        }
    }

    //------------------------------------------------------------------------------

    public function excluir()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {

            $uri = current_url(true);
            $campanha_id = $uri->getSegment(3); //verifica em qual campo esta o ID
            $model = new CampanhaModel();
            $result = $model->find($campanha_id);

            try {
                if ($result["background_image"]) { //verifica se tem uma imagem cadatrastrada junto com esse ID e se não houver img não acontece nada
                    $filePath = "./public/img/campanhas/" . $result["background_image"];
                } else {
                    $filePath = "";
                }

                if (file_exists($filePath)) {  //faz a exclusão do arquivo no banco e na pasta de img
                    if (unlink($filePath)) {
                        $model->delete($campanha_id);
                        $session = session();
                        $session->setFlashdata('success', 'A campanha' . " (" . $result['titulo'] . ") " .  ' foi excluída com sucesso!');
                        return redirect()->to(base_url("listarCampanhas"));
                    } else {
                        echo "Não foi possível excluir, verifique permissões!";
                    }
                } else {
                    echo "O arquivo" . $filePath . " não existe";
                }
            } catch (Exception $e) {
                $session = session();
                if ($e->getCode() == 1451) {
                    $session->setFlashdata('danger', 'A campanha' . "  (" . $result['titulo'] . ") " . 'não pode ser excluída, pois possui vínculos no sistema!');
                } else {
                    $session->setFlashdata('danger', 'A campanha' . "  (" . $result['titulo'] . ") " . 'não pode ser excluída!');
                }
                return redirect()->to(base_url("listarCampanhas"));
            }
        }
    }

    //------------------------------------------------------------------------------
    public function visualizar()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {

            $uri = current_url(true);
            $campanha_id = $uri->getSegment(3); //verifica em qual campo esta o ID
            $model = new CampanhaModel();
            $result = $model->find($campanha_id);

            try {
                $tabela = json_decode($result['tabela']);

                $data = [
                    'id' => $result['id'],
                    'titulo' => $result['titulo'],
                    'conteudo' => $result['conteudo'],
                    'background_image' => $result['background_image'],
                    'registro' => $tabela[0],
                ];

                $campanha = new PdfController();

                $retorno = $campanha->visualizarCampanha($data);
            } catch (Exception $e) {
                $session = session();
                if ($e->getCode() == 1451) {
                    $session->setFlashdata('danger', 'A campanha' . "  (" . $result['titulo'] . ") " . 'não pode ser excluída, pois possui vínculos no sistema!');
                } else {
                    $session->setFlashdata('danger', 'A campanha' . "  (" . $result['titulo'] . ") " . 'não pode ser excluída!');
                }
                return redirect()->to(base_url("listarCampanhas"));
            }
        }
    }

    //------------------------------------------------------------------------------
    public function enviar()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {

            $uri = current_url(true);
            $campanha_id = $uri->getSegment(3); //verifica em qual campo esta o ID
            $model = new CampanhaModel();
            $result = $model->find($campanha_id);

            try {
                $tabela = json_decode($result['tabela']);

                $data = [
                    'id' => $result['id'],
                    'titulo' => $result['titulo'],
                    'mensagem' => $result['mensagem'],
                    'conteudo' => $result['conteudo'],
                    'background_image' => $result['background_image'],
                    'registro' => $tabela,
                ];

                $campanha = new PdfController();

                $retorno = $campanha->enviarCampanha($data);
                if ($retorno) {

                    $enviada = new CampanhaModel();
                    $enviada->update($campanha_id, [
                        'sent_by' => session()->get('id'),
                        'sent_at' => date('Y-m-d H:i:s'),
                    ]);
                    $session = session();
                    $session->setFlashdata('success', 'A campanha' . "  (" . $result['titulo'] . ") " . 'foi enviada com sucesso!');
                    return redirect()->to(base_url("listarCampanhas"));
                }
            } catch (Exception $e) {
                $session = session();
                if ($e->getCode() == 1451) {
                    $session->setFlashdata('danger', 'A campanha' . "  (" . $result['titulo'] . ") " . 'não pode ser enviada, pois possui vínculos no sistema!');
                } else {
                    $session->setFlashdata('danger', 'A campanha' . "  (" . $result['titulo'] . ") " . 'não pode ser enviada!');
                }
                return redirect()->to(base_url("listarCampanhas"));
            }
        }
    }
}
