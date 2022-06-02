<?= $this->extend('default') ?>

<?= $this->section('content') ?>
<style>
    input {
        margin-left: 10px;
        margin-right: 10px;
    }

    textarea {
        height: 150px;
        width: 100%;
    }


    .oculto,
    #conteudo,
    #menu,
    #rodape {
        display: none;
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
<main>
    <?php
    if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
        $origin = $_SERVER['HTTP_ORIGIN'];
    } else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
        $origin = $_SERVER['HTTP_REFERER'];
    } else {
        $origin = $_SERVER['REMOTE_ADDR'];
    }

    ?>
    <div class="container">
        <h1 style="text-align: center; margin-top: 20px;">AVALIAÇÃO DE EVENTOS TÉCNICOS</h1>

        <p style="text-align: center; margin-top: 20px;">Queremos saber, em poucos minutos, como você avalia o evento realizado pelo CRF-SP. Por favor, responda as
            perguntas abaixo.</p>
        </br></br>

        <form id="form" name='form' method="post">
            <input type="hidden" name="origin" value="<?php echo $origin; ?>">
            <h2>Campos não obrigatórios:</h2>
            <div class="questao">
                <h3>Gênero</h3>
                <label>
                    <input type="radio" name="genero" value="1">Masculino </label></br>
                <label>
                    <input type="radio" name="genero" value="2">Feminino </label></br>
                <label>
                    <input type="radio" name="genero" value="3">Mulher Transexual </label></br>
                <label>
                    <input type="radio" name="genero" value="4">Travesti </label></br>
                <label>
                    <input type="radio" name="genero" value="5">Homem Transexual </label></br>
                <label>
                    <input type="radio" name="genero" value="6">Não binário </label></br>
                <label>
                    <input type="radio" name="genero" value="7">Outro </label></br>
            </div>
            </br></br>

            <div class="questao">
                <h3>Maior de 60 anos?</h3>
                <label>
                    <input type="radio" name="maior60" value="1">Sim </label></br>
                <label>
                    <input type="radio" name="maior60" value="2">Não </label>
            </div>
            </br></br>

            <div class="questao">
                <h3>Portador de necessidades especiais?</h3>
                <label>
                    <input type="radio" name="portador" value="1">Sim </label></br>
                <label>
                    <input type="radio" name="portador" value="2">Não </label>
            </div>
            </br></br>

            <div class="questao">
                <h3>Você é inscrito no CRF-SP?</h3>
                <label>
                    <input type="radio" name="inscrito" value="1">Sim </label></br>
                <label>
                    <input type="radio" name="inscrito" value="2">Não </label>
            </div>
            <hr>
            </br>

            <h2>Avaliação</h2>
            <div class=" participacao">
                <div class="questao" id="participacao" onchange="exibir_ocultar(this)">
                    <h3>Qual a sua forma de participação? </h3>
                    <label>
                        <input type="radio" name="forma" value="1" required>Presencial</label></br>
                    <label>
                        <input type="radio" name="forma" value="2">On-line</label>
                </div>
            </div>
            </br></br>


            <div class="oculto atividade">
                <div class="questao">
                    <h3 for="atividade"> Qual a atividade deseja avaliar?</h3>
                    <select id="atividade" name="atividade" class="form-control" required>
                        <option id="atividade" selected="selected">Selecione a atividade</option>
                    </select>

                </div>
            </div>
            </br></br>


            <div class=" oculto municipio">
                <div class="questao">
                    <h3>Informe o município em que foi realizado o evento:</h3>
                    <select id="city" name="cidades" class="form-control">
                        <option value="0" selected="selected">Selecione o município</option>
                        <?php
                        foreach ($cidades as $key => $cidade) {
                            if ($cidade['uf'] == '26') {
                                echo "<option  value='" . $cidade['id'] . "' >" . $cidade['nome'] . "</option>";
                            }
                        }

                        ?>
                    </select>
                </div>
            </div>
            </br></br>



            <div class=" oculto data">
                <div class="questao">
                    <h3>Em que data participou/concluiu esta atividade?</h3>
                </div>
                <input id="date" type="date" name="data" required>
            </div>
            </br></br>


            <div class=" oculto satisfacao">
                <div class="questao">
                    <h2>Avalie seu grau de satisfação com relação ao Ministrante/palestrante:</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Muito satisfeito</th>
                                <th>Satisfeito</th>
                                <th>Neutro</th>
                                <th>Insatisfeito</th>
                                <th>Muito insatisfeito</th>
                                <th>Não tenho condições de avaliar</th>
                            </tr>
                        </thead>

                        <br />
                        <tbody>
                            <tr class="tipo_1">
                                <td>Conduta</td>
                                <td class="center"><label><input type="radio" name="a" value="1" required></label></td>
                                <td class="center"><label><input type="radio" name="a" value="2"></label></td>
                                <td class="center"><label><input type="radio" name="a" value="3"></label></td>
                                <td class="center"><label><input type="radio" name="a" value="4"></label></td>
                                <td class="center"><label><input type="radio" name="a" value="5"></label></td>
                                <td class="center"><label><input type="radio" name="a" value="6"></label></td>
                            </tr>
                            <tr class="tipo_1">
                                <td>Abordagem</td>
                                <td class="center"><label><input type="radio" name="b" value="1" required></label></td>
                                <td class="center"><label><input type="radio" name="b" value="2"></label></td>
                                <td class="center"><label><input type="radio" name="b" value="3"></label></td>
                                <td class="center"><label><input type="radio" name="b" value="4"></label></td>
                                <td class="center"><label><input type="radio" name="b" value="5"></label></td>
                                <td class="center"><label><input type="radio" name="b" value="6"></label></td>
                            </tr>
                            <tr class="tipo_1">
                                <td>Conhecimento teórico</td>
                                <td class="center"><label><input type="radio" name="c" value="1" required></label></td>
                                <td class="center"><label><input type="radio" name="c" value="2"></label></td>
                                <td class="center"><label><input type="radio" name="c" value="3"></label></td>
                                <td class="center"><label><input type="radio" name="c" value="4"></label></td>
                                <td class="center"><label><input type="radio" name="c" value="5"></label></td>
                                <td class="center"><label><input type="radio" name="c" value="6"></label></td>
                            </tr>
                            <tr class="tipo_1">
                                <td>Experiência prática</td>
                                <td class="center"><label><input type="radio" name="d" value="1" required></label></td>
                                <td class="center"><label><input type="radio" name="d" value="2"></label></td>
                                <td class="center"><label><input type="radio" name="d" value="3"></label></td>
                                <td class="center"><label><input type="radio" name="d" value="4"></label></td>
                                <td class="center"><label><input type="radio" name="d" value="5"></label></td>
                                <td class="center"><label><input type="radio" name="d" value="6"></label></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </br></br>


            <div class=" oculto satisfacao">
                <div class="questao">
                    <h2>Avalie seu grau de satisfação com relação ao Material:</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Muito satisfeito</th>
                                <th>Satisfeito</th>
                                <th>Neutro</th>
                                <th>Insatisfeito</th>
                                <th>Muito insatisfeito</th>
                                <th>Não tenho condições de avaliar</th>
                            </tr>
                        </thead>

                        <br />
                        <tbody>
                            <tr class="tipo_2">
                                <td>Conteúdo técnico</td>
                                <td class="center"><label><input type="radio" name="e" value="1" required></label></td>
                                <td class="center"><label><input type="radio" name="e" value="2"></label></td>
                                <td class="center"><label><input type="radio" name="e" value="3"></label></td>
                                <td class="center"><label><input type="radio" name="e" value="4"></label></td>
                                <td class="center"><label><input type="radio" name="e" value="5"></label></td>
                                <td class="center"><label><input type="radio" name="e" value="6"></label></td>
                            </tr>
                            <tr class="tipo_2">
                                <td>Forma de apresentação</td>
                                <td class="center"><label><input type="radio" name="f" value="1" required></label></td>
                                <td class="center"><label><input type="radio" name="f" value="2"></label></td>
                                <td class="center"><label><input type="radio" name="f" value="3"></label></td>
                                <td class="center"><label><input type="radio" name="f" value="4"></label></td>
                                <td class="center"><label><input type="radio" name="f" value="5"></label></td>
                                <td class="center"><label><input type="radio" name="f" value="6"></label></td>
                            </tr>
                            <tr class="tipo_2">
                                <td>Objetividade</td>
                                <td class="center"><label><input type="radio" name="g" value="1" required></label></td>
                                <td class="center"><label><input type="radio" name="g" value="2"></label></td>
                                <td class="center"><label><input type="radio" name="g" value="3"></label></td>
                                <td class="center"><label><input type="radio" name="g" value="4"></label></td>
                                <td class="center"><label><input type="radio" name="g" value="5"></label></td>
                                <td class="center"><label><input type="radio" name="g" value="6"></label></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </br></br>


            <div class=" oculto manifestacao">
                <div class="questao">
                    <h3>Caso queira se manifestar especificamente sobre os itens avaliados anteriormente referente ao
                        ministrante/palestrante e material, favor descrever: </h3>
                    <textarea name="manifestacao" id="manifestacao" cols="30" rows="10"></textarea>
                </div>
            </div>
            </br></br>


            <div class=" oculto suporte">
                <div class="questao">
                    <h2>Avalie seu grau de satisfação com relação ao evento:</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Muito satisfeito</th>
                                <th>Satisfeito</th>
                                <th>Neutro</th>
                                <th>Insatisfeito</th>
                                <th>Muito insatisfeito</th>
                                <th>Não tenho condições de avaliar</th>
                            </tr>
                        </thead>

                        <br />
                        <tbody>
                            <tr class="tipo_3 h">
                                <td>Atendimento </td>
                                <td class="center"><label><input type="radio" name="h" value="1" required></label></td>
                                <td class="center"><label><input type="radio" name="h" value="2"></label></td>
                                <td class="center"><label><input type="radio" name="h" value="3"></label></td>
                                <td class="center"><label><input type="radio" name="h" value="4"></label></td>
                                <td class="center"><label><input type="radio" name="h" value="5"></label></td>
                                <td class="center"><label><input type="radio" name="h" value="6"></label></td>
                            </tr>
                            <tr class="tipo_3 i">
                                <td>Infraestrutura</td>
                                <td class="center"><label><input type="radio" name="i" value="1" required></label></td>
                                <td class="center"><label><input type="radio" name="i" value="2"></label></td>
                                <td class="center"><label><input type="radio" name="i" value="3"></label></td>
                                <td class="center"><label><input type="radio" name="i" value="4"></label></td>
                                <td class="center"><label><input type="radio" name="i" value="5"></label></td>
                                <td class="center"><label><input type="radio" name="i" value="6"></label></td>
                            </tr>
                            <tr class="tipo_3 j">
                                <td>Contribuição para seu exercício profissional</td>
                                <td class="center"><label><input type="radio" name="j" value="1" required></label></td>
                                <td class="center"><label><input type="radio" name="j" value="2"></label></td>
                                <td class="center"><label><input type="radio" name="j" value="3"></label></td>
                                <td class="center"><label><input type="radio" name="j" value="4"></label></td>
                                <td class="center"><label><input type="radio" name="j" value="5"></label></td>
                                <td class="center"><label><input type="radio" name="j" value="6"></label></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </br></br>


            <div class=" oculto online">
                <div class="questao">
                    <h2>Avalie seu grau de satisfação com relação ao evento:</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Muito satisfeito</th>
                                <th>Satisfeito</th>
                                <th>Neutro</th>
                                <th>Insatisfeito</th>
                                <th>Muito insatisfeito</th>
                                <th>Não tenho condições de avaliar</th>
                            </tr>
                        </thead>

                        <br />
                        <tbody>
                            <tr class="tipo_4 k">
                                <td>Acesso e participação por meio on-line</td>
                                <td class="center"><label><input type="radio" name="k" value="1"></label></td>
                                <td class="center"><label><input type="radio" name="k" value="2"></label></td>
                                <td class="center"><label><input type="radio" name="k" value="3"></label></td>
                                <td class="center"><label><input type="radio" name="k" value="4"></label></td>
                                <td class="center"><label><input type="radio" name="k" value="5"></label></td>
                                <td class="center"><label><input type="radio" name="k" value="6"></label></td>
                            </tr>
                            <tr class="tipo_4 l">
                                <td>Contribuição para seu exercício profissional</td>
                                <td class="center"><label><input type="radio" name="l" value="1"></label></td>
                                <td class="center"><label><input type="radio" name="l" value="2"></label></td>
                                <td class="center"><label><input type="radio" name="l" value="3"></label></td>
                                <td class="center"><label><input type="radio" name="l" value="4"></label></td>
                                <td class="center"><label><input type="radio" name="l" value="5"></label></td>
                                <td class="center"><label><input type="radio" name="l" value="6"></label></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </br></br>


            <div class=" oculto ouvidoria">
                <div class="questao">
                    <h3>Se quiser registrar uma sugestão, elogio ou reclamação acesse a Ouvidoria </h3>
                    <p><a href="https://falabr.cgu.gov.br/publico/SP/Manifestacao/RegistrarManifestacao" target="_blank"> clique aqui </a></p>
                </div>
            </div>
            </br></br>


            <div id="msg"></div>

            <button type="submit" class="btn btn-success oculto"><i class="fa fa-check"></i> Enviar</button>

        </form>
    </div>
</main>

<script>
    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "preventDuplicates": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    }

    $msg = <?php echo "'" . $msg . "'"; ?>;
    // $origem = <?php echo "'" . $origem . "'"; ?>;
    if ($msg) {
        toastr.info($msg);
        // if ($origem.length > 5) {
        //     setTimeout(function() {
        //         window.location.href = $origem; // the redirect goes here
        //     }, 5000);
        // }
    }

    const atividades = JSON.parse(JSON.stringify(<?php echo $atividades; ?>));
    console.log(atividades);

    $('input[type=radio][name=forma]').on('change', function() {
        var forma = $('input[type=radio][name=forma]:checked').val();

        if (forma == 1) {
            opt = "";
            Object.entries(atividades).forEach(([keys, atividade]) => {
                if (atividade['forma'] == 1) {
                    dA = new Date(atividade['data']);
                    if (isNaN(dA)) {
                        opt += "<option id='atividade' value='" + atividade['id'] + "' data-date='' data-city='" + atividade['municipio'] + "'>" + atividade['titulo'] + " </option>";
                    } else {
                        dataAtiv = dA.getDate().toString().padStart(2, '0') + '/' + (dA.getMonth() + 1).toString().padStart(2, '0') + '/' + dA.getFullYear();
                        opt += "<option id='atividade' value='" + atividade['id'] + "' data-date='" + atividade['data'] + "' data-city='" + atividade['municipio'] + "'>" + atividade['titulo'] + " - " + dataAtiv + "</option>";

                    }
                }
            });
            $('#atividade').html(opt);
        } else {
            opt = "";
            Object.entries(atividades).forEach(([keys, atividade]) => {
                if (atividade['forma'] == 2) {
                    dA = new Date(atividade['data']);
                    if (isNaN(dA)) {
                        opt += "<option id='atividade' value='" + atividade['id'] + "' data-date='' data-city='" + atividade['municipio'] + "'>" + atividade['titulo'] + " </option>";

                    } else {
                        dataAtiv = dA.getDate().toString().padStart(2, '0') + '/' + (dA.getMonth() + 1).toString().padStart(2, '0') + '/' + dA.getFullYear();
                        opt += "<option id='atividade' value='" + atividade['id'] + "' data-date='" + atividade['data'] + "' data-city='" + atividade['municipio'] + "'>" + atividade['titulo'] + " - " + dataAtiv + "</option>";

                    }
                }
            });
            $('#atividade').html(opt);
        }
        $('#atividade').change();
    });

    // $('input[type=radio][name=forma]').on('change', function() {
    //     var forma = $('input[type=radio][name=forma]:checked').val();

    //     $.post('<?= base_url() . "/atividadesForma" ?>', {
    //         forma: forma
    //     }, function(data) {
    //         $('#atividade').html(data);
    //     });

    // });


    $('#atividade').on('change', function() {
        var selected = $(this).find('option:selected');
        var data = selected.data('date');
        var municipio = selected.data('city');

        const d = new Date(data);
        if (isNaN(d)) {
            $('#date').val();
            $('#date').removeAttr('readonly');
        } else {
            data = d.getFullYear() + '-' + (d.getMonth() + 1).toString().padStart(2, '0') + '-' + d.getDate().toString().padStart(2, '0');
            $('#date').val(data);
            $('#date').attr('readonly', 'true');
        }

        if (Number.isInteger(municipio) && municipio != 0) {
            $('#city').val(municipio);
            $('#city option:not(:selected)').each(function() {
                $(this).attr('disabled', 'disabled');
            });
            $('#city').attr('readonly', 'true');

        } else {
            $('#city').val();
            $('#city option').each(function() {
                $(this).removeAttr('disabled');
            });
            $('#city').removeAttr('readonly');
        }
    });



    function exibir_ocultar() {
        var valor = $('input[name=forma]:checked').val();
        if (valor == 1) {
            $(".atividade").show();
            $(".municipio").show();
            $(".data").show();
            $(".satisfacao").show();
            $(".manifestacao").show();
            $(".suporte").show();
            $(".ouvidoria").show();
            $(".btn").show();
            $(".online").hide();
            $('input[type=radio][name=h]:first').prop('required', true);
            $('input[type=radio][name=i]:first').prop('required', true);
            $('input[type=radio][name=j]:first').prop('required', true);
            $('input[type=radio][name=k]:first').prop('required', false);
            $('input[type=radio][name=l]:first').prop('required', false);

        } else {
            $(".atividade").show();
            $(".data").show();
            $(".satisfacao").show();
            $(".manifestacao").show();
            $(".online").show();
            $(".ouvidoria").show();
            $(".btn").show();
            $(".municipio").hide();
            $(".suporte").hide();
            $('input[type=radio][name=h]:first').prop('required', false);
            $('input[type=radio][name=i]:first').prop('required', false);
            $('input[type=radio][name=j]:first').prop('required', false);
            $('input[type=radio][name=k]:first').prop('required', true);
            $('input[type=radio][name=l]:first').prop('required', true);
        }
    };


    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    $(document).ready(function() {
        // $('#participacao').change();

    });

    $("#form").on('submit', function() {
        // setTimeout(function() {
        //     window.location.href = "<?php echo $origin; ?>"; // the redirect goes here
        // }, 5000);
    });
</script>
<?= $this->endSection() ?>