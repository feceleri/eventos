<?php

namespace App\Controllers;

use App\Models\CadPesquisaModel;
use App\Models\CidadeModel;
use App\Models\PesquisaModel;

class Pesquisa extends BaseController
{

    public function pesquisaSatisfacao()
    {

        helper(['form', 'url']);
        $atividade = new CadPesquisaModel();
        $cidadeModel = new CidadeModel();

        $data = [
            'title' => 'Pesquisa',
            'atividades' =>  json_encode($atividade->orderBy('titulo', 'ASC')->findall()),
            'cidades' => $cidadeModel->findall(),
            'msg' => "",
            'origem' => "",
        ];

        if ($this->request->getMethod() == 'post') {


            //salva no BD
            $model =  new PesquisaModel();

            $newData = [
                'genero' => (int)$this->request->getVar('genero'),
                '60anos' => (int)$this->request->getVar('maior60'),
                'especiais' => (int)$this->request->getVar('portador'),
                'crf-sp' => (int)$this->request->getVar('inscrito'),
                'atividade' => (int)$this->request->getVar('atividade'),
                'data' => Date($this->request->getVar('data')),
                'participacao' => (int)$this->request->getVar('forma'),
                'municipio' => (int)$this->request->getVar('cidades'),
                'conduta' => (int)$this->request->getVar('a'),
                'abordagem' => (int)$this->request->getVar('b'),
                'conhecimento' => (int)$this->request->getVar('c'),
                'experiencia' => (int)$this->request->getVar('d'),
                'conteudo' => (int)$this->request->getVar('e'),
                'apresentacao' => (int)$this->request->getVar('f'),
                'objetividade' => (int)$this->request->getVar('g'),
                'manifestacao' => $this->request->getVar('manifestacao'),
                'Atendimento' => (int)$this->request->getVar('h'),
                'Infraestrutura' => (int)$this->request->getVar('i'),
                'Contribuicao' => (int)$this->request->getVar('j'),
                'online' => (int)$this->request->getVar('k'),
                'profissional' => (int)$this->request->getVar('l'),
            ];


            if ($model->save($newData)) {
                $data['msg'] = "Avaliação enviada com sucesso. Agradecemos a contribuição.";
            } else {
                $data['msg'] = "Erro ao salvar";
            }

            $data['origem'] = $this->request->getVar('origin');
            // return redirect()->to($origin);
            // var_dump($data['msg']);exit;
        }

        echo view('templates/header', $data);
        echo view('pesquisa');
        // echo view('templates/footer');
    }

    //------------------------------------------------------------------------------

    // Cadastra a atividade para um evento
    public function cadastrarPesquisa()
    {
        // Verifica de o usuario está logado * Presente em todas as funções
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {

            helper(['form', 'url']);
            $cidadeModel = new CidadeModel();
            $data = [
                'title' => 'Cadastrar Pesquisa',
                'msg' => "",
                'cidades' => $cidadeModel->findall(),
            ];

            if ($this->request->getMethod() == 'post') {
                //VALIDAÇÕES

                //salva no BD
                $model =  new CadPesquisaModel();

                if($this->request->getVar('dataExc') !== null){
                    $data_exc = Date($this->request->getVar('dataExc'));
                }else{
                    $data_exc = NULL;
                }
                
                $newData = [
                    'titulo' => $this->request->getVar('titulo'),
                    'data' => Date($this->request->getVar('data')),
                    'data_exc' => $data_exc,
                    'temas' => $this->request->getVar('temas'),
                    'forma' => (int)$this->request->getVar('forma'),
                    'municipio' => (int)$this->request->getVar('cidades'),
                    'created' => session()->get('id'),
                ];


                if ($model->save($newData)) {
                    $session = session();
                    $session->setFlashdata('success', 'Sua pesquisa foi cadastrada com sucesso!');
                    // var_dump($newData);exit;
                    return redirect()->to(base_url('listaPesquisa'));
                } else {
                    echo "Erro ao salvar";
                    exit;
                }
            }
        }
        echo view('templates/header', $data);
        echo view('cadastrarPesquisa');
        echo view('templates/footer');
    }



    //------------------------------------------------------------------------------

    //tras a lista de pesquisa 
    public function getForma()
    {
        $forma = service('request')->getPost('forma');

        $pesquisa = new CadPesquisaModel();
        echo $pesquisa->selectAtividade($forma);
    }

    //------------------------------------------------------------------------------

    //tras a lista de pesquisa cadastrada
    public function listaPesquisa()
    {

        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {
            $model = new CadPesquisaModel();
            $pesquisas = $model->withDeleted()->orderBy('deleted_at', 'ASC')->orderBy('titulo', 'ASC')->findAll();
            foreach ($pesquisas as $pesquisa) {
                if (isset($pesquisa['data_exc'])&& $pesquisa['data_exc'] !== '0000-00-00 00:00:00' && $pesquisa['data_exc'] < date("Y-m-d h:i:sa") && $pesquisa['deleted_at'] == NULL) {
                    $this->ocultarAtividade($pesquisa['id'], true);
                }
            }

            $data = [
                'title' => 'Lista pesquisa',
                // 'data' => $model->findAll(),
                'data' => $model->withDeleted()->orderBy('deleted_at', 'ASC')->orderBy('titulo', 'ASC')->findAll(),
            ];
            echo view('templates/header', $data);
            echo view('listarPesquisaCad');
            echo view('templates/footer');
        }
    }

    //------------------------------------------------------------------------------


    // atualiza uma pesquisa

    public function editarPesquisa()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {

            $uri = current_url(true);
            $pesq_id = $uri->getSegment(4);
            $model = new CadPesquisaModel();
            $pesquisa = $model->find($pesq_id);
            $cidadeModel = new CidadeModel();

            $data = [
                'title' => 'Editar atividade',
                'data' => $pesquisa,
                'cidades' => $cidadeModel->findall(),
            ];


            helper(['form']);

            if ($this->request->getMethod() == 'post') {

                //Atualiza no BD
                $newData = [
                    'id' => $pesq_id, //sem esse campo não sabe qual ID deve alterar e acaba fazendo um insert
                    'titulo' => $this->request->getVar('titulo'),
                    'data' => Date($this->request->getVar('data')),
                    'data_exc' => Date($this->request->getVar('dataExc')),
                    'temas' => $this->request->getVar('temas'),
                    'forma' => (int)$this->request->getVar('forma'),
                    'municipio' => (int)$this->request->getVar('cidades'),
                    'created' => session()->get('id'),
                ];

                if ($model->save($newData)) {
                    $session = session();
                    $session->setFlashdata('success', 'Sua pesquisa ');
                    $session->setFlashdata('success', 'Sua pesquisa' . "  ("  . $pesquisa['titulo'] . ") " .  'foi alterada com sucesso!');
                    return redirect()->to(base_url('listaPesquisa'));
                } else {
                    echo "Erro ao editar";
                    exit;
                }
            }

            echo view('templates/header', $data);
            echo view('editarCadPesq');
            echo view('templates/footer');
        }
    }


    //------------------------------------------------------------------------------

    public function ocultarAtividade($id = null, $controle = false)
    {
        //salva no BD
        $model =  new CadPesquisaModel();
        // var_dump($id);
        if ($id != null) {
            $pesq_id = $id;
        } else {
            $uri = current_url(true);
            $pesq_id = $uri->getSegment(4);
        }

        $item = $model->withDeleted()->find($pesq_id);
        if ($item['data_exc'] < date("Y-m-d h:i:sa") && isset($item['deleted_at'])) {
            $newData = [
                'id' => $pesq_id,
                'data_exc' => NULL,
                'deleted_at' => NULL
            ];

            // var_dump($newData);
            if ($model->save($newData)) {
                $session = session();
                $session->setFlashdata('success', 'Sua pesquisa foi restaurada e a data de expiração removida!');


                if ($controle == false) {
                    return redirect()->to(base_url('listaPesquisa'));
                }
            } else {
                echo "Erro ao mover";
                exit;
            }
        } else if (isset($item['deleted_at'])) {
            $newData = [
                'id' => $pesq_id,
                'deleted_at' => NULL
            ];

            if ($model->save($newData)) {
                $session = session();
                $session->setFlashdata('success', 'Sua atividade foi movida com sucesso!');


                if ($controle == false) {
                    return redirect()->to(base_url('listaPesquisa'));
                }
            } else {
                echo "Erro ao mover";
                exit;
            }
        } else {
            if ($model->delete($pesq_id)) {
                $session = session();
                $session->setFlashdata('success', 'Sua atividade foi movida com sucesso!');

                if ($controle == false) {
                    return redirect()->to(base_url('listaPesquisa'));
                }
            } else {
                echo "Erro ao mover";
                exit;
            }
        }
    }


    //------------------------------------------------------------------------------


    public function relatorioGrafico()
    {



        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {

            $model =  new PesquisaModel();
            // $uri = current_url(true);
            // $pesq_id = $uri->getSegment(4);
            // $modelPesq = new CadPesquisaModel();
            // $id =$modelPesq['id'];
            // $tema = $modelPesq['titulo'];

            // $resultado = $model->withDeleted()->where('atividade', $pesq_id)->findAll();
            $resultado = $model->withDeleted()->findAll();
            // var_dump($resultado );exit;
            helper(['form', 'url']);

            $masculino = 0;
            $feminino   = 0;
            $mulherTransexual = 0;
            $travesti = 0;
            $homemTransexual = 0;
            $naoBinario = 0;
            $outro = 0;
            $sim = 0;
            $nao = 0;
            $nenhum = 0;
            $presencial = 0;
            $online = 0;
            $muitoSatisfeito = 0;
            $satisfeito   = 0;
            $neutro = 0;
            $insatisfeito = 0;
            $muitoInsatisfeito = 0;
            $naoAvaliar = 0;



            //genero
            foreach ($resultado as $result) {
                if ($result['genero'] == 1) {
                    $masculino++;
                } else if ($result['genero'] == 2) {
                    $feminino++;
                } else if ($result['genero'] == 3) {
                    $mulherTransexual++;
                } else if ($result['genero'] == 4) {
                    $travesti++;
                } else if ($result['genero'] == 5) {
                    $homemTransexual++;
                } else if ($result['genero'] == 6) {
                    $naoBinario++;
                } else {
                    $outro++;
                }


                //IDADE
                if ($result['60anos'] == 1) {
                    $sim++;
                } else if ($result['60anos'] == 2) {
                    $nao++;
                } else {
                    $nenhum++;
                }


                //Portador de necessidades especiais
                if ($result['especiais']  == 1) {
                    $sim++;
                } else if ($result['especiais'] == 2) {
                    $nao++;
                } else {
                    $nenhum++;
                }


                //inscrito crf-sp
                if ($result['crf-sp'] == 1) {
                    $sim++;
                } else if ($result['crf-sp'] == 2) {
                    $nao++;
                } else {
                    $nenhum++;
                }


                // forma de participação
                if ($result['participacao'] == 1) {
                    $presencial++;
                } else {
                    $online++;
                }


                // conduta
                if ($result['conduta'] == 1) {
                    $muitoSatisfeito++;
                } else if ($result['conduta'] == 2) {
                    $satisfeito++;
                } else if ($result['conduta'] == 3) {
                    $neutro++;
                } else if ($result['conduta'] == 4) {
                    $insatisfeito++;
                } else if ($result['conduta'] == 5) {
                    $muitoInsatisfeito++;
                } else {
                    $naoAvaliar++;
                }


                // abordagem
                if ($result['abordagem'] == 1) {
                    $muitoSatisfeito++;
                } else if ($result['abordagem'] == 2) {
                    $satisfeito++;
                } else if ($result['abordagem'] == 3) {
                    $neutro++;
                } else if ($result['abordagem'] == 4) {
                    $insatisfeito++;
                } else if ($result['abordagem'] == 5) {
                    $muitoInsatisfeito++;
                } else {
                    $naoAvaliar++;
                }


                // conhecimento
                if ($result['conhecimento'] == 1) {
                    $muitoSatisfeito++;
                } else if ($result['conhecimento'] == 2) {
                    $satisfeito++;
                } else if ($result['conhecimento'] == 3) {
                    $neutro++;
                } else if ($result['conhecimento'] == 4) {
                    $insatisfeito++;
                } else if ($result['conhecimento'] == 5) {
                    $muitoInsatisfeito++;
                } else {
                    $naoAvaliar++;
                }


                // experiencia
                if ($result['experiencia'] == 1) {
                    $muitoSatisfeito++;
                } else if ($result['experiencia'] == 2) {
                    $satisfeito++;
                } else if ($result['experiencia'] == 3) {
                    $neutro++;
                } else if ($result['experiencia'] == 4) {
                    $insatisfeito++;
                } else if ($result['experiencia'] == 5) {
                    $muitoInsatisfeito++;
                } else {
                    $naoAvaliar++;
                }


                // conteudo
                if ($result['conteudo'] == 1) {
                    $muitoSatisfeito++;
                } else if ($result['conteudo'] == 2) {
                    $satisfeito++;
                } else if ($result['conteudo'] == 3) {
                    $neutro++;
                } else if ($result['conteudo'] == 4) {
                    $insatisfeito++;
                } else if ($result['conteudo'] == 5) {
                    $muitoInsatisfeito++;
                } else {
                    $naoAvaliar++;
                }


                // apresentação
                if ($result['apresentacao'] == 1) {
                    $muitoSatisfeito++;
                } else if ($result['apresentacao'] == 2) {
                    $satisfeito++;
                } else if ($result['apresentacao'] == 3) {
                    $neutro++;
                } else if ($result['apresentacao'] == 4) {
                    $insatisfeito++;
                } else if ($result['apresentacao'] == 5) {
                    $muitoInsatisfeito++;
                } else {
                    $naoAvaliar++;
                }


                // objetividade
                if ($result['objetividade'] == 1) {
                    $muitoSatisfeito++;
                } else if ($result['objetividade'] == 2) {
                    $satisfeito++;
                } else if ($result['objetividade'] == 3) {
                    $neutro++;
                } else if ($result['objetividade'] == 4) {
                    $insatisfeito++;
                } else if ($result['objetividade'] == 5) {
                    $muitoInsatisfeito++;
                } else {
                    $naoAvaliar++;
                }

                //Atendimento
                if ($result['Atendimento']  == '1') {
                    $muitoSatisfeito++;
                } else if ($result['Atendimento']  == '2') {
                    $satisfeito++;
                } else if ($result['Atendimento']  == '3') {
                    $neutro++;
                } else if ($result['Atendimento']  == '4') {
                    $insatisfeito++;
                } else if ($result['Atendimento']  == '5') {
                    $muitoInsatisfeito++;
                } else {
                    $naoAvaliar++;
                }

                //Infraestrutura
                if ($result['Infraestrutura']  == '1') {
                    $muitoSatisfeito++;
                } else if ($result['Infraestrutura']  == '2') {
                    $satisfeito++;
                } else if ($result['Infraestrutura']  == '3') {
                    $neutro++;
                } else if ($result['Infraestrutura']  == '4') {
                    $insatisfeito++;
                } else if ($result['Infraestrutura']  == '5') {
                    $muitoInsatisfeito++;
                } else {
                    $naoAvaliar++;
                }

                //Contribuicao
                if ($result['Contribuicao']  == '1') {
                    $muitoSatisfeito++;
                } else if ($result['Contribuicao']  == '2') {
                    $satisfeito++;
                } else if ($result['Contribuicao']  == '3') {
                    $neutro++;
                } else if ($result['Contribuicao']  == '4') {
                    $insatisfeito++;
                } else if ($result['Contribuicao']  == '5') {
                    $muitoInsatisfeito++;
                } else {
                    $naoAvaliar++;
                }

                //online
                if ($result['online']  == '1') {
                    $muitoSatisfeito++;
                } else if ($result['online']  == '2') {
                    $satisfeito++;
                } else if ($result['online']  == '3') {
                    $neutro++;
                } else if ($result['online']  == '4') {
                    $insatisfeito++;
                } else if ($result['online']  == '5') {
                    $muitoInsatisfeito++;
                } else {
                    $naoAvaliar++;
                }

                //profissional
                if ($result['profissional']  == '1') {
                    $muitoSatisfeito++;
                } else if ($result['profissional']  == '2') {
                    $satisfeito++;
                } else if ($result['profissional']  == '3') {
                    $neutro++;
                } else if ($result['profissional']  == '4') {
                    $insatisfeito++;
                } else if ($result['profissional']  == '5') {
                    $muitoInsatisfeito++;
                } else {
                    $naoAvaliar++;
                }
            }


            // $resultado = [
            //     'atividade' => $pesq_id,
            //     'masculino' => $masculino,
            //     'feminino' => $feminino,
            //     'mulherTransexual' => $mulherTransexual,
            //     'travesti' => $travesti,
            //     'homemTransexual' => $homemTransexual,
            //     'naoBinario' => $naoBinario,
            //     'outro' => $outro,
            //     'sim' => $sim,
            //     'nao' => $nao,
            //     'nenhum' => $nenhum,
            //     'presencial' => $presencial,
            //     'online' => $online,
            //     'muitoSatisfeito' => $muitoSatisfeito,
            //     'satisfeito' => $satisfeito,
            //     'neutro' => $neutro,
            //     'insatisfeito' => $insatisfeito,
            //     'muitoInsatisfeito' => $muitoInsatisfeito,
            //     'naoAvaliar' => $naoAvaliar,
            // ];

            $data = [
                'title' => 'Resultado Pesquisa',
                'msg' => "",
                'resultado' => $resultado,
            ];
        }

        //  var_dump($resultado);exit;
        echo view('templates/header', $data);
        echo view('resultadosGrafico');
        echo view('templates/footer');
    }


    //------------------------------------------------------------------------------

    public function relatorioPesquisa($id = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {
            $pesquisa =  new PesquisaModel();

            $uri = current_url(true);
            $pesq_id = $uri->getSegment(4);
            $data = [
                'title' =>  'Relatório',
                'pesquisa' => $pesquisa->withDeleted()->where('atividade', $pesq_id)->findAll(),
            ];
            echo view('templates/header', $data);
            echo view('resultadoPesquisa');
            echo view('templates/footer');
        }
    }

    //------------------------------------------------------------------------------

    public function relatorioGeral($id = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url(''));
        } else {
            $cadPesq = new CadPesquisaModel();
            $result = $cadPesq->relatorioGeral();
            $table =           "<table><thead class='thead'>
            <tr>
            <th>temas</th>" .
                "<th>genero</th>" .
                "<th>anos</th>" .
                "<th>especiais</th>" .
                "<th>crfsp</th>" .
                "<th>forma</th>" .
                "<th>titulo</th>" .
                "<th>municipio</th>" .
                "<th>data</th>" .
                "<th>conduta</th>" .
                "<th>abordagem</th>" .
                "<th>conhecimento</th>" .
                "<th>experiencia</th>" .
                "<th>conteudo</th>" .
                "<th>apresentacao</th>" .
                "<th>objetividade</th>" .
                "<th>manifestacao</th>" .
                "<th>Atendimento</th>" .
                "<th>Infraestrutura</th>" .
                "<th>Contribuicao</th>" .
                "<th>online</th>" .
                "<th>profissional </th>
            </tr>
            </thead>";
            foreach ($result as $pesquisa) {
                // var_dump($pesquisa);
                // exit;

                if ($pesquisa['temas']  == '1') {
                    $temas = 'Campanha de saúde';
                } else if ($pesquisa['temas']  == '2') {
                    $temas = 'Capacitação';
                } else if ($pesquisa['temas']  == '3') {
                    $temas = 'Curso';
                } else if ($pesquisa['temas']  == '4') {
                    $temas = 'Fiscalização Orientativa';
                } else if ($pesquisa['temas']  == '5') {
                    $temas = 'Encontro';
                } else if ($pesquisa['temas']  == '6') {
                    $temas = 'Fórum';
                } else if ($pesquisa['temas']  == '7') {
                    $temas = 'Palestra';
                } else if ($pesquisa['temas']  == '8') {
                    $temas = 'Seminário';
                } else if ($pesquisa['temas']  == '9') {
                    $temas = 'Simpósio';
                } else if ($pesquisa['temas']  == '10') {
                    $temas = 'Trilha de aprendizagem';
                } else {
                    $temas = 'Webinar ';
                }

                //genero
                if ($pesquisa['genero']  == '1') {
                    $genero = 'Masculino';
                } else if ($pesquisa['genero']  == '2') {
                    $genero = 'Feminino';
                } else if ($pesquisa['genero']  == '3') {
                    $genero = 'Mulher Transexual';
                } else if ($pesquisa['genero']  == '4') {
                    $genero = 'Travesti';
                } else if ($pesquisa['genero']  == '5') {
                    $genero = 'Homem Transexual';
                } else if ($pesquisa['genero']  == '6') {
                    $genero = 'Não binário';
                } else if ($pesquisa['genero']  == '7') {
                    $genero = 'Outro ';
                } else {
                    $genero = 'Não selecionou ';
                }

                //Maior de 60 anos
                if ($pesquisa['60anos'] == '1') {
                    $anos = 'Sim';
                } else {
                    $anos = 'Não';
                }

                //Portador de necessidades especiais
                if ($pesquisa['especiais'] == '1') {
                    $especiais = 'Sim';
                } else {
                    $especiais = 'Não';
                }

                //Você é inscrito no CRF-SP
                if ($pesquisa['crf-sp'] == '1') {
                    $crfsp = 'Sim';
                } else {
                    $crfsp = 'Não';
                }

                //Qual a sua forma de participação
                if ($pesquisa['participacao'] == '1') {
                    $forma = 'Presencial';
                } else {
                    $forma = 'On-line';
                }

                //Qual a atividade deseja avaliar

                //município 

                //Ministrante/palestrante
                //conduta
                if ($pesquisa['conduta']  == '1') {
                    $conduta = 'Muito satisfeito';
                } else if ($pesquisa['conduta']  == '2') {
                    $conduta = 'Satisfeito';
                } else if ($pesquisa['conduta']  == '3') {
                    $conduta = 'Neutro';
                } else if ($pesquisa['conduta']  == '4') {
                    $conduta = 'Insatisfeito';
                } else if ($pesquisa['conduta']  == '5') {
                    $conduta = 'Muito insatisfeito';
                } else {
                    $conduta = 'Não avaliar';
                }

                //Abordagem
                if ($pesquisa['abordagem']  == '1') {
                    $abordagem = 'Muito satisfeito';
                } else if ($pesquisa['abordagem']  == '2') {
                    $abordagem = 'Satisfeito';
                } else if ($pesquisa['abordagem']  == '3') {
                    $abordagem = 'Neutro';
                } else if ($pesquisa['abordagem']  == '4') {
                    $abordagem = 'Insatisfeito';
                } else if ($pesquisa['abordagem']  == '5') {
                    $abordagem = 'Muito insatisfeito';
                } else {
                    $abordagem = 'Não avaliar';
                }

                //conhecimento teórico
                if ($pesquisa['conhecimento']  == '1') {
                    $conhecimento = 'Muito satisfeito';
                } else if ($pesquisa['conhecimento']  == '2') {
                    $conhecimento = 'Satisfeito';
                } else if ($pesquisa['conhecimento']  == '3') {
                    $conhecimento = 'Neutro';
                } else if ($pesquisa['conhecimento']  == '4') {
                    $conhecimento = 'Insatisfeito';
                } else if ($pesquisa['conhecimento']  == '5') {
                    $conhecimento = 'Muito insatisfeito';
                } else {
                    $conhecimento = 'Não avaliar';
                }

                //experiencia prática
                if ($pesquisa['experiencia']  == '1') {
                    $experiencia = 'Muito satisfeito';
                } else if ($pesquisa['experiencia']  == '2') {
                    $experiencia = 'Satisfeito';
                } else if ($pesquisa['experiencia']  == '3') {
                    $experiencia = 'Neutro';
                } else if ($pesquisa['experiencia']  == '4') {
                    $experiencia = 'Insatisfeito';
                } else if ($pesquisa['experiencia']  == '5') {
                    $experiencia = 'Muito insatisfeito';
                } else {
                    $experiencia = 'Não avaliar';
                }


                //Material
                //Conteúdo técnico 
                if ($pesquisa['conteudo']  == '1') {
                    $conteudo = 'Muito satisfeito';
                } else if ($pesquisa['conteudo']  == '2') {
                    $conteudo = 'Satisfeito';
                } else if ($pesquisa['conteudo']  == '3') {
                    $conteudo = 'Neutro';
                } else if ($pesquisa['conteudo']  == '4') {
                    $conteudo = 'Insatisfeito';
                } else if ($pesquisa['conteudo']  == '5') {
                    $conteudo = 'Muito insatisfeito';
                } else {
                    $conteudo = 'Não avaliar';
                }

                //Forma de apresentacao 
                if ($pesquisa['apresentacao']  == '1') {
                    $apresentacao = 'Muito satisfeito';
                } else if ($pesquisa['apresentacao']  == '2') {
                    $apresentacao = 'Satisfeito';
                } else if ($pesquisa['apresentacao']  == '3') {
                    $apresentacao = 'Neutro';
                } else if ($pesquisa['apresentacao']  == '4') {
                    $apresentacao = 'Insatisfeito';
                } else if ($pesquisa['apresentacao']  == '5') {
                    $apresentacao = 'Muito insatisfeito';
                } else {
                    $apresentacao = 'Não avaliar';
                }

                //objetividade
                if ($pesquisa['objetividade']  == '1') {
                    $objetividade = 'Muito satisfeito';
                } else if ($pesquisa['objetividade']  == '2') {
                    $objetividade = 'Satisfeito';
                } else if ($pesquisa['objetividade']  == '3') {
                    $objetividade = 'Neutro';
                } else if ($pesquisa['objetividade']  == '4') {
                    $objetividade = 'Insatisfeito';
                } else if ($pesquisa['objetividade']  == '5') {
                    $objetividade = 'Muito insatisfeito';
                } else {
                    $objetividade = 'Não avaliar';
                }

                //Atendimento
                if ($pesquisa['Atendimento']  == '1') {
                    $Atendimento = 'Muito satisfeito';
                } else if ($pesquisa['Atendimento']  == '2') {
                    $Atendimento = 'Satisfeito';
                } else if ($pesquisa['Atendimento']  == '3') {
                    $Atendimento = 'Neutro';
                } else if ($pesquisa['Atendimento']  == '4') {
                    $Atendimento = 'Insatisfeito';
                } else if ($pesquisa['Atendimento']  == '5') {
                    $Atendimento = 'Muito insatisfeito';
                } else {
                    $Atendimento = 'Não avaliar';
                }

                //Infraestrutura
                if ($pesquisa['Infraestrutura']  == '1') {
                    $Infraestrutura = 'Muito satisfeito';
                } else if ($pesquisa['Infraestrutura']  == '2') {
                    $Infraestrutura = 'Satisfeito';
                } else if ($pesquisa['Infraestrutura']  == '3') {
                    $Infraestrutura = 'Neutro';
                } else if ($pesquisa['Infraestrutura']  == '4') {
                    $Infraestrutura = 'Insatisfeito';
                } else if ($pesquisa['Infraestrutura']  == '5') {
                    $Infraestrutura = 'Muito insatisfeito';
                } else {
                    $Infraestrutura = 'Não avaliar';
                }

                //Contribuicao
                if ($pesquisa['Contribuicao']  == '1') {
                    $Contribuicao = 'Muito satisfeito';
                } else if ($pesquisa['Contribuicao']  == '2') {
                    $Contribuicao = 'Satisfeito';
                } else if ($pesquisa['Contribuicao']  == '3') {
                    $Contribuicao = 'Neutro';
                } else if ($pesquisa['Contribuicao']  == '4') {
                    $Contribuicao = 'Insatisfeito';
                } else if ($pesquisa['Contribuicao']  == '5') {
                    $Contribuicao = 'Muito insatisfeito';
                } else {
                    $Contribuicao = 'Não avaliar';
                }

                //online
                if ($pesquisa['online']  == '1') {
                    $online = 'Muito satisfeito';
                } else if ($pesquisa['online']  == '2') {
                    $online = 'Satisfeito';
                } else if ($pesquisa['online']  == '3') {
                    $online = 'Neutro';
                } else if ($pesquisa['online']  == '4') {
                    $online = 'Insatisfeito';
                } else if ($pesquisa['online']  == '5') {
                    $online = 'Muito insatisfeito';
                } else {
                    $online = 'Não avaliar';
                }

                //profissional
                if ($pesquisa['profissional']  == '1') {
                    $profissional = 'Muito satisfeito';
                } else if ($pesquisa['profissional']  == '2') {
                    $profissional = 'Satisfeito';
                } else if ($pesquisa['profissional']  == '3') {
                    $profissional = 'Neutro';
                } else if ($pesquisa['profissional']  == '4') {
                    $profissional = 'Insatisfeito';
                } else if ($pesquisa['profissional']  == '5') {
                    $profissional = 'Muito insatisfeito';
                } else {
                    $profissional = 'Não avaliar';
                }



                $table .= "<tr>" .
                    "<td>" . $temas . "</td>" .
                    "<td>" . $genero . "</td>" .
                    "<td>" . $anos . "</td>" .
                    "<td>" . $especiais . "</td>" .
                    "<td>" . $crfsp . "</td>" .
                    "<td>" . $forma . "</td>" .
                    "<td>" . $pesquisa['titulo'] . "</td>" .
                    "<td>" . $pesquisa['municipio'] . "</td>" .
                    "<td>" . $pesquisa['data'] . "</td>" .
                    "<td>" . $conduta . "</td>" .
                    "<td>" . $abordagem . "</td>" .
                    "<td>" . $conhecimento . "</td>" .
                    "<td>" . $experiencia . "</td>" .
                    "<td>" . $conteudo . "</td>" .
                    "<td>" . $apresentacao . "</td>" .
                    "<td>" . $objetividade . "</td>" .
                    "<td>" . $pesquisa['manifestacao'] . "</td>" .
                    "<td>" . $Atendimento . "</td>" .
                    "<td>" . $Infraestrutura . "</td>" .
                    "<td>" . $Contribuicao . "</td>" .
                    "<td>" . $online . "</td>" .
                    "<td>" . $profissional . "</td>" .
                    "</tr>";
            }
            $table .= "</table>";
            $name = 'Relatorio_Geral' . date('d-m-Y') . '.xls';
            header("Content-Type: application/vnd.ms-excel; charset=utf-8");
            header("Cache-Control: no-cache, must-revalidate");
            header('Content-Disposition: attachment; filename="' . $name . '"');
            echo utf8_decode($table);

            exit;
        }
    }
}
