<?= $this->extend('default') ?>

<?= $this->section('content') ?>

<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

<style>
    h3 {
        margin-top: 50px;
        text-align: center;
        color: red;
    }

    .pesquisa {
        max-width: 76%;
        padding: 20px;
        text-align: center;
        margin-left: 190px;
    }

    th {
        color: white;
        text-align: left;
        margin-top: 20px;
        font: caption;
    }


    #pesquisa {
        border: solid 2px;
        border-collapse: collapse;
        margin-top: 15px;
        margin-bottom: 15px;
        margin-left: -10px;

    }

    .scroll {
        overflow-y: scroll;
    }


    #pesquisa thead {
        background: #0174DF;
        border: solid 2px;
        opacity: 0.7;
    }

    #pesquisa input {
        color: navy;
        width: 100%;
    }

    #cad {
        width: 100px;
        background-color: #008CBA;
        font-size: 12px;
        border-radius: 8px;
        border: 2px solid;
        float: right;
        margin: 10px;
    }

    #cad:hover {
        box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
    }


    @media only screen and (min-width: 1200px) {
        .session {
            margin-left: 150px;
            text-transform: uppercase;
        }
        .evento{
            margin-left: -50px;
        }

        .menu {
            margin-left: 200px;
        }

        .nav2 {
            margin-left: 50px;
            margin-right: 50px;
        }
        .pesq{
            margin-left: 50px;
        }

        .campanha{
            margin-left: 50px;
        }
    }
</style>
<script>
    //gerar arquivo em excel
    $(document).ready(function() {
        $('#pesquisa').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>
<main id="t3-content pesquisa">
    <?php
    if (
        isset($_SESSION['id']) &&
        $_SESSION['type'] == 0
    ) {
    ?>

        <div class="bg-white container scroll">

            <a href="<?= base_url('listaPesquisa') ?>">Voltar</a>
            <!-- <p style="text-align: right;">Total de Respostas:
                <?php echo 0000 ?>
            </p> -->

            <!-- <a class="btn btn-primary  text-uppercase" id="cad" type="submit" href="'. base_url('resultadosGrafico'). "/" . $pesquisa['id'] . '">Grafico</a>'; -->

            <table class="table-hover" id="pesquisa">

                <thead class="thead">
                    <tr>
                        <th>Genero</th>
                        <th>Maior de 60 anos</th>
                        <th>Portador de necessidades</th>
                        <th>Inscrito CRF-SP</th>
                        <th>Forma de participação</th>
                        <th>Municipio</th>
                        <th>Data</th>
                        <th>Conduta M/P</th>
                        <th>Abordagem M/P</th>
                        <th>Conhecimento M/P</th>
                        <th>Experiência M/P</th>
                        <th>Conteúdo M</th>
                        <th>Apresentacao M</th>
                        <th>Objetividade M</th>
                        <th>manifestacao</th>
                        <th>Atendimento</th>
                        <th>Infraestrutura</th>
                        <th>Contribuicao</th>
                        <th>online</th>
                        <th>profissional </th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pesquisa as $key => $pesquisa) {

                        // if ($pesquisa['temas']  == '1') {
                        //     $temas = 'Campanha de saúde';
                        // } else if ($pesquisa['temas']  == '2') {
                        //     $temas = 'Capacitação';
                        // } else if ($pesquisa['temas']  == '3') {
                        //     $temas = 'Curso';
                        // } else if ($pesquisa['temas']  == '4') {
                        //     $temas = 'Fiscalização Orientativa';
                        // } else if ($pesquisa['temas']  == '5') {
                        //     $temas = 'Encontro';
                        // } else if ($pesquisa['temas']  == '6') {
                        //     $temas = 'Fórum';
                        // } else if ($pesquisa['temas']  == '7') {
                        //     $temas = 'Palestra';
                        // } else if ($pesquisa['temas']  == '8') {
                        //     $temas = 'Seminário';
                        // } else if ($pesquisa['temas']  == '9') {
                        //     $temas = 'Simpósio';
                        // } else if ($pesquisa['temas']  == '10') {
                        //     $temas = 'Trilha de aprendizagem';
                        // } else {
                        //     $temas = 'Webinar ';
                        // }

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


                        echo "<tr>" .
                            "<td>" . $genero . "</td>" .
                            "<td>" . $anos . "</td>" .
                            "<td>" . $especiais . "</td>" .
                            "<td>" . $crfsp . "</td>" .
                            "<td>" . $forma . "</td>" .
                            // "<td>" . $pesquisa['atividade'] . "</td>" .
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

                    ?>
                </tbody>
            </table>


        </div>
    <?php
    } else {
        echo "<h3>Não tem permissão para acessar essa página!</h3>";
    }
    ?>
</main>
<?= $this->endSection() ?>