<?= $this->extend('templates/default'); ?>
<?= $this->section('css'); ?>
<style>
    .custom-file-input~.custom-file-label::after {
        content: "Selecionar";
    }
</style>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<main id="t3-content">
    <div class="container bg-white" style="padding-bottom: 10em;">
        <br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="#">Inicio</a></li> -->
                <li class="breadcrumb-item"><a href="<?= base_url('listarCampanhas') ?>">Campanhas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
            </ol>
        </nav>
        <h2 class="card-title text-center">Cadastro de Campanhas</h2>
        <form class="form-signin" id="file" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="titulo" name="titulo" class="form-control" placeholder="O título da campanha será também usado como título do e-mail." maxlength="60" minilength="3" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <label for="conteudo">Conteúdo</label>
                <textarea class="form-control" id="conteudo" name="conteudo" minilength="3" maxlength="1000" rows="3" required autofocus>
                <h2 style="text-align: center;">Bem vindo ao cadastro de campanhas!</h2>
                <p>Por gentileza, leve em considera&ccedil;&atilde;o as informa&ccedil;&otilde;es contidas aqui para ter sucesso na cadastro e envio de suas campanhas.</p>
                <h2>Por que cadastrar uma campanha?</h2>
                <p>As campanhas s&atilde;o uma forma de enviar um documento PDF anexado por e-mail a uma lista de usu&aacute;rios.<br />Para isso &eacute; nescess&aacute;rio fazer o upload de um arquivo contendo uma tabela, veja como:</p>
                <ul>
                <li>Sua tabela pode ser feita no excel, e precisa ser salva como planilha <strong>xml</strong>.</li>
                <li>A primeira linha ser&aacute; identificada como sendo o nome dos campos, por isso &eacute; importante coloc&aacute;-los. Caso n&atilde;o seja, o primeiro registro acabar&aacute; sendo perdido.</li>
                <li>Evite colocar: caract&eacute;res especiais, assentos ou espa&ccedil;os no nome dos campos. Eles s&atilde;o apenas para nossa identifica&ccedil;&atilde;o, aqui menos &eacute; mais.</li>
                <li>N&atilde;o deve haver outras tabelas e planilhas no documento.</li>
                <li>O campo nome e email s&atilde;o obrigat&oacute;rios, identific&aacute;-los exatamente assim:"nome" e "email" sem h&iacute;fen ou espa&ccedil;os.</li>
                </ul>
                <h2>Veja abaixo um exemplo de tabela</h2>
                <table style="border-collapse: collapse; width: 100%; height: 58.7814px;" border="1">
                <thead>
                <tr style="height: 19.5938px;">
                <th style="width: 33.1758%; height: 19.5938px;">nome</th>
                <th style="width: 39.225%; height: 19.5938px;">funcao</th>
                <th style="width: 23.4405%; height: 19.5938px;">depto</th>
                <th style="width: 4.15879%; height: 19.5938px;">email</th>
                </tr>
                </thead>
                <tbody>
                <tr style="height: 19.5938px;">
                <td style="width: 33.1758%; height: 19.5938px;">Felipe Celeri de Souza</td>
                <td style="width: 39.225%; height: 19.5938px;">Desenvolvedor</td>
                <td style="width: 23.4405%; height: 19.5938px;">Tecnologia da Informa&ccedil;&atilde;o</td>
                <td style="width: 4.15879%; height: 19.5938px;">felipe.souza@crfsp.org.br</td>
                </tr>
                <tr style="height: 19.5938px;">
                <td style="width: 33.1758%; height: 19.5938px;">Andr&eacute; Luiz Gomes Duarte</td>
                <td style="width: 39.225%; height: 19.5938px;">Gerente</td>
                <td style="width: 23.4405%; height: 19.5938px;">Tecnologia da Informa&ccedil;&atilde;o</td>
                <td style="width: 4.15879%; height: 19.5938px;">andre.duarte@crfsp.org.br</td>
                </tr>
                </tbody>
                </table>
                <h2>Plano de fundo</h2>
                <p>O conte&uacute;do do arquivo PDF ser&aacute; o que for informado nesse campo, por&eacute;m o plano de fundo dever&aacute; ser carregado no pr&oacute;ximo campo.</p>
                <ul>
                <li>A imagem deve ser JPG</li>
                <li>As dimens&otilde;es da imagem devem ser 1049x742</li>
                <li>Se houver assinatura, ela deve estar contida na imagem.</li>
                </ul>
                <p><img style="display: block; margin-left: auto; margin-right: auto;" src="https://www.crfsp.org.br/eventos//public/img/campanhas/certblankexample.jpg" alt="" width="391" height="276" /></p>
                <h2>Vari&aacute;veis</h2>
                <p>Voc&ecirc; poder&aacute; usar vari&aacute;veis que ser&atilde;o substitu&iacute;das automaticamente pelo conte&uacute;do correspondente.<br />As vari&aacute;veis s&atilde;o os nomes do campos informados na tabela, por isso &eacute; interessante que eles n&atilde;o tenham caracteres especiais, acentos e espa&ccedil;os.<br />Para us&aacute;-las, voc&ecirc; precisa indic&aacute;-las da seguinte forma. [@nomedocampo]</p>
                <p>Usando o exemplo da tabela acima veja como ficaria o certificado.<br /><br />Ex.</p>
                <div style="text-align: center;">Certificamos que <strong>[@nome]</strong><br />possui a fun&ccedil;&atilde;o de <strong>[@funcao]</strong><br />no departamento <strong>[@depto] </strong>desta entidade.</div>
                <div style="text-align: center;">&nbsp;</div>
                <div style="text-align: center;">&nbsp;</div>
                <p><img style="display: block; margin-left: auto; margin-right: auto;" src="https://www.crfsp.org.br/eventos//public/img/campanhas/certificadoexample.jpg" alt="" width="391" height="276" /></p>
                <h2>Finalmente ...</h2>
                <p>N&atilde;o se esque&ccedil;a de apagar as informa&ccedil;&otilde;es contidas aqui.</p>
                <p><br /><br /><br /><br /></p>
            </textarea>
            </div>
            <div class="form-group">
                <label for="mensagem">Mensagem do corpo e-mail</label>
                <textarea class="form-control" id="mensagem" name="mensagem" minilength="3" maxlength="1000" rows="3" required autofocus>
                <h2 style="text-align: center;">Informe aqui a mensagem do corpo de e-mail.</h2>
                <p>O conte&uacute;do do campo acima &eacute; o que ser&aacute; inserido no meio do documento PDF anexado ao e-mail.<br />Por&eacute;m a mensagem do corpo do e-mail precisa ser informada nesse espa&ccedil;o.&nbsp;</p>
                <h2>Vari&aacute;veis</h2>
                <p>As regras de v&aacute;ri&aacute;veis tambem se aplicam aqui.</p>
                <p>Ex.<br /><br />Prezado(a) [@nome].</p>
                <p>Informamos que em anexo est&aacute; seu atestado/men&ccedil;&atilde;o/certificado...&nbsp;</p>
                <p>Qualquer d&uacute;vida, estamos &agrave; disposi&ccedil;&atilde;o.<br />Atenciosamente,<br />Conselho Regional de Farm&aacute;cia do Estado de S&atilde;o Paulo<br />eventos@crfsp.org.br<br />(11) 3067.1450 <br />www.crfsp.org.br</p>
            </textarea>
            </div>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="background_image" name="background_image" class="custom-file-input" accept="image/*" readonly="true" required autofocus onchange="readURL(this);">
                    <label class="custom-file-label" for="background_image">Escolha a imagem de fundo.</label>
                </div>
            </div>
            <br>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="xmlfields" name="xmlfields" class="custom-file-input" accept="text/xml" readonly="true" required autofocus>
                    <label class="custom-file-label" for="xmlfields">Importe a tabela Excel no formato xml. É obrigatório ter o campo 'email'.</label>
                </div>
            </div>
            <div><img id="blah" alt="imagem" /></div>
            <br>
            <button class="btn btn-primary float-right" name="cadastrar" type="submit">Cadastrar</button>
        </form>
    </div>
</main>
<?= $this->endSection(); ?>
<?= $this->section('js'); ?>

<script>
    $('#blah').hide();

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah')
                    .attr('src', e.target.result);
                $('#blah').show();
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
   
</script>
<?= $this->endSection(); ?>