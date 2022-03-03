<?= $this->extend('default') ?>

<?= $this->section('content') ?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<style>
    .data {
        margin-left: 30%;
        margin-top: -51px;
    }

    .fundo {
        background-color: #e9e9e9;
    }

    @media only screen and (min-width: 1200px) {
        .session {
            margin-left: 150px;
            text-transform: uppercase;
        }

        .evento {
            margin-left: -50px;
        }

        .menu {
            margin-left: 200px;
        }

        .nav2 {
            margin-left: 50px;
            margin-right: 50px;
        }

        .pesq {
            margin-left: 50px;
        }

        .campanha {
            margin-left: 50px;
        }
    }
</style>
<main id="t3-content">
    <div class="container fundo" style="display: grid;">

        <a href="<?= base_url('listaPesquisa') ?>">Voltar</a>
        <h1 style="text-align: center; margin-top: 20px;">Resultados</h1>
        <p>Escolha o período</p>

        <div class="row">
            <div class="form-group col-4" id="inicial">
                <div class="form-label-group">
                    <label for="dtIni">Data inicial:</label>
                    <input id="dtIni" type="date" name="dtIni">
                </div>
            </div>
            <div class="form-group col-4" id="final">
                <div class="form-label-group">
                    <label for="dtFim">Data final:</label>
                    <input id="dtFim" type="date" name="dtFim">
                </div>
            </div>
            <div class="form-group  col-4 ">
                <div class="form-label-group">
                    <button type="button" class="btn btn-info" onclick="filtrarResultados();"><i class="fa fa-filter" aria-hidden="true"> Filtrar</i>
                    </button>
                    <p></p>
                </div>
            </div>
        </div>

        <div id="genero"></div>
        <div id="anos"></div>
        <div id="especiais"></div>
        <div id="crfsp"></div>
        <div id="participacao"></div>
        <div id="conduta"></div>
        <div id="abordagem"></div>
        <div id="conhecimento"></div>
        <div id="experiencia"></div>
        <div id="conteudo"></div>
        <div id="apresentacao"></div>
        <div id="objetividade"></div>
        <div id="Atendimento"></div>
        <div id="Infraestrutura"></div>
        <div id="Contribuicao"></div>
        <div id="online"></div>
        <div id="profissional"></div>
        <p></p>
    </div>
</main>
<script>
    var resultado = <?php echo json_encode($resultado); ?>;


    var masculino = 0;
    var feminino = 0;
    var mulherTransexual = 0;
    var travesti = 0;
    var homemTransexual = 0;
    var naoBinario = 0;
    var outro = 0;
    var sim_anos = 0;
    var nao_anos = 0;
    var nenhum_anos = 0;
    var sim_especiais = 0;
    var nao_especiais = 0;
    var nenhum_especiais = 0;
    var sim_crf = 0;
    var nao_crf = 0;
    var nenhum_crf = 0;
    var presencial = 0;
    var online = 0;
    var muitoSatisfeito = 0;
    var satisfeito = 0;
    var neutro = 0;
    var insatisfeito = 0;
    var muitoInsatisfeito = 0;
    var naoAvaliar = 0;

    function filtrarResultados() {
        var dtIni = document.getElementById("dtIni").value;
        var dtFim = document.getElementById("dtFim").value;

        $.each(resultado, function(key, item) {
            if (item.data > dtIni && item.data < dtFim) {
                if (item.genero == "1") {
                    masculino++;
                } else if (item.genero == "2") {
                    feminino++;
                } else if (item.genero == "3") {
                    mulherTransexual++;
                } else if (item.genero == "4") {
                    travesti++;
                } else if (item.genero == "5") {
                    homemTransexual++;
                } else if (item.genero == "6") {
                    naoBinario++;
                } else {
                    outro++;
                }

                //Idade
                if (item.anos == "1") {
                    sim_anos++;
                } else if (item.anos == "2") {
                    nao_anos++;
                } else {
                    nenhum_anos++;
                }


                //Portador de necessidades especiais
                if (item.especiais == "1") {
                    sim_especiais++;
                } else if (item.especiais == "2") {
                    nao_especiais++;
                } else {
                    nenhum_especiais++;
                }


                //inscrito crf-sp
                if (item.crfsp == 1) {
                    sim_crf++;
                } else if (item.crfsp == 2) {
                    nao_crf++;
                } else {
                    nenhum_crf++;
                }


                // forma de participação
                if (item.participacao == 1) {
                    presencial++;
                } else {
                    online++;
                }


                // conduta
                if (item.conduta == 1) {
                    muitoSatisfeito++;
                } else if (item.conduta == 2) {
                    satisfeito++;
                } else if (item.conduta == 3) {
                    neutro++;
                } else if (item.conduta == 4) {
                    insatisfeito++;
                } else if (item.conduta == 5) {
                    muitoInsatisfeito++;
                } else {
                    naoAvaliar++;
                }


                // abordagem
                if (item.abordagem == 1) {
                    muitoSatisfeito++;
                } else if (item.abordagem == 2) {
                    satisfeito++;
                } else if (item.abordagem == 3) {
                    neutro++;
                } else if (item.abordagem == 4) {
                    insatisfeito++;
                } else if (item.abordagem == 5) {
                    muitoInsatisfeito++;
                } else {
                    naoAvaliar++;
                }


                // conhecimento
                if (item.conhecimento == 1) {
                    muitoSatisfeito++;
                } else if (item.conhecimento == 2) {
                    satisfeito++;
                } else if (item.conhecimento == 3) {
                    neutro++;
                } else if (item.conhecimento == 4) {
                    insatisfeito++;
                } else if (item.conhecimento == 5) {
                    muitoInsatisfeito++;
                } else {
                    naoAvaliar++;
                }


                // experiencia
                if (item.experiencia == 1) {
                    muitoSatisfeito++;
                } else if (item.experiencia == 2) {
                    satisfeito++;
                } else if (item.experiencia == 3) {
                    neutro++;
                } else if (item.experiencia == 4) {
                    insatisfeito++;
                } else if (item.experiencia == 5) {
                    muitoInsatisfeito++;
                } else {
                    naoAvaliar++;
                }


                // conteudo
                if (item.conteudo == 1) {
                    muitoSatisfeito++;
                } else if (item.conteudo == 2) {
                    satisfeito++;
                } else if (item.conteudo == 3) {
                    neutro++;
                } else if (item.conteudo == 4) {
                    insatisfeito++;
                } else if (item.conteudo == 5) {
                    muitoInsatisfeito++;
                } else {
                    naoAvaliar++;
                }


                // apresentação
                if (item.apresentacao == 1) {
                    muitoSatisfeito++;
                } else if (item.apresentacao == 2) {
                    satisfeito++;
                } else if (item.apresentacao == 3) {
                    neutro++;
                } else if (item.apresentacao == 4) {
                    insatisfeito++;
                } else if (item.apresentacao == 5) {
                    muitoInsatisfeito++;
                } else {
                    naoAvaliar++;
                }


                // objetividade
                if (item.objetividade == 1) {
                    muitoSatisfeito++;
                } else if (item.objetividade == 2) {
                    satisfeito++;
                } else if (item.objetividade == 3) {
                    neutro++;
                } else if (item.objetividade == 4) {
                    insatisfeito++;
                } else if (item.objetividade == 5) {
                    muitoInsatisfeito++;
                } else {
                    naoAvaliar++;
                }

                //Atendimento
                if (item.Atendimento == '1') {
                    muitoSatisfeito++;
                } else if (item.Atendimento == '2') {
                    satisfeito++;
                } else if (item.Atendimento == '3') {
                    neutro++;
                } else if (item.Atendimento == '4') {
                    insatisfeito++;
                } else if (item.Atendimento == '5') {
                    muitoInsatisfeito++;
                } else {
                    naoAvaliar++;
                }

                //Infraestrutura
                if (item.Infraestrutura == '1') {
                    muitoSatisfeito++;
                } else if (item.Infraestrutura == '2') {
                    satisfeito++;
                } else if (item.Infraestrutura == '3') {
                    neutro++;
                } else if (item.Infraestrutura == '4') {
                    insatisfeito++;
                } else if (item.Infraestrutura == '5') {
                    muitoInsatisfeito++;
                } else {
                    naoAvaliar++;
                }

                //Contribuicao
                if (item.Contribuicao == '1') {
                    muitoSatisfeito++;
                } else if (item.Contribuicao == '2') {
                    satisfeito++;
                } else if (item.Contribuicao == '3') {
                    neutro++;
                } else if (item.Contribuicao == '4') {
                    insatisfeito++;
                } else if (item.Contribuicao == '5') {
                    muitoInsatisfeito++;
                } else {
                    naoAvaliar++;
                }

                //online
                if (item.online == '1') {
                    muitoSatisfeito++;
                } else if (item.online == '2') {
                    satisfeito++;
                } else if (item.online == '3') {
                    neutro++;
                } else if (item.online == '4') {
                    insatisfeito++;
                } else if (item.online == '5') {
                    muitoInsatisfeito++;
                } else {
                    naoAvaliar++;
                }

                //profissional
                if (item.profissional == '1') {
                    muitoSatisfeito++;
                } else if (item.profissional == '2') {
                    satisfeito++;
                } else if (item.profissional == '3') {
                    neutro++;
                } else if (item.profissional == '4') {
                    insatisfeito++;
                } else if (item.profissional == '5') {
                    muitoInsatisfeito++;
                } else {
                    naoAvaliar++;
                }
            };

        });

        google.charts.setOnLoadCallback(genero);
        google.charts.setOnLoadCallback(anos);
        google.charts.setOnLoadCallback(especiais);
        google.charts.setOnLoadCallback(crfsp);
        google.charts.setOnLoadCallback(participacao);
        google.charts.setOnLoadCallback(conduta);
        google.charts.setOnLoadCallback(abordagem);
        google.charts.setOnLoadCallback(conhecimento);
        google.charts.setOnLoadCallback(experiencia);
        google.charts.setOnLoadCallback(conteudo);
        google.charts.setOnLoadCallback(apresentacao);
        google.charts.setOnLoadCallback(objetividade);
        google.charts.setOnLoadCallback(Atendimento);
        google.charts.setOnLoadCallback(Infraestrutura);
        google.charts.setOnLoadCallback(Contribuicao);
        google.charts.setOnLoadCallback(online);
        google.charts.setOnLoadCallback(profissional);
    }


    google.charts.load('current', {
        'packages': ['corechart']
    });

    // //Gênero
    function genero() {
        var genero = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Masculino', masculino],
            ['Feminino', feminino],
            ['Mulher Transexual', mulherTransexual],
            ['Travesti', travesti],
            ['HomemTransexual', homemTransexual],
            ['Não Binario', naoBinario],
            ['Não respondeu', outro],
        ]);

        var options = {
            title: 'Gênero'
        };

        var chart = new google.visualization.PieChart(document.getElementById('genero'));

        chart.draw(genero, options);
    }


    //60 anos
    function anos() {
        var anos = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Sim', sim_anos],
            ['Não', nao_anos],
            ['Não respondeu', nenhum_anos],
        ]);

        var options = {
            title: 'Maior de 60 anos'
        };

        var chart = new google.visualization.PieChart(document.getElementById('anos'));

        chart.draw(anos, options);
    }


    //especiais
    function especiais() {
        var especiais = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Sim', sim_especiais],
            ['Não', nao_especiais],
            ['Não respondeu', nenhum_especiais]

        ]);

        var options = {
            title: 'Portador de necessidades especiais'
        };

        var chart = new google.visualization.PieChart(document.getElementById('especiais'));

        chart.draw(especiais, options);
    }


    //crf-sp
    function crfsp() {
        var crfsp = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Sim', sim_crf],
            ['Não', nao_crf],
            ['Não respondeu', nenhum_crf]

        ]);

        var options = {
            title: 'Você é inscrito no CRF-SP'
        };

        var chart = new google.visualization.PieChart(document.getElementById('crfsp'));

        chart.draw(crfsp, options);
    }


    //participacao
    function participacao() {
        var participacao = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Presencial', presencial],
            ['Online', online],

        ]);

        var options = {
            title: 'Qual a sua forma de participação?'
        };

        var chart = new google.visualization.PieChart(document.getElementById('participacao'));

        chart.draw(participacao, options);
    }


    //conduta
    function conduta() {
        var conduta = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Muito satisfeito', muitoSatisfeito],
            ['Satisfeito', satisfeito],
            ['Neutro', neutro],
            ['Insatisfeito', insatisfeito],
            ['Muito insatisfeito', muitoInsatisfeito],
            ['Não Avaliar', naoAvaliar],

        ]);

        var options = {
            title: 'Conduta'
        };

        var chart = new google.visualization.PieChart(document.getElementById('conduta'));

        chart.draw(conduta, options);
    }


    //abordagem
    function abordagem() {
        var abordagem = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Muito satisfeito', muitoSatisfeito],
            ['Satisfeito', satisfeito],
            ['Neutro', neutro],
            ['Insatisfeito', insatisfeito],
            ['Muito insatisfeito', muitoInsatisfeito],
            ['Não Avaliar', naoAvaliar],

        ]);

        var options = {
            title: 'Abordagem'
        };

        var chart = new google.visualization.PieChart(document.getElementById('abordagem'));

        chart.draw(abordagem, options);
    }


    //conhecimento
    function conhecimento() {
        var conhecimento = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Muito satisfeito', muitoSatisfeito],
            ['Satisfeito', satisfeito],
            ['Neutro', neutro],
            ['Insatisfeito', insatisfeito],
            ['Muito insatisfeito', muitoInsatisfeito],
            ['Não Avaliar', naoAvaliar],

        ]);

        var options = {
            title: 'Conhecimento teórico'
        };

        var chart = new google.visualization.PieChart(document.getElementById('conhecimento'));

        chart.draw(conhecimento, options);
    }


    //experiencia
    function experiencia() {
        var experiencia = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Muito satisfeito', muitoSatisfeito],
            ['Satisfeito', satisfeito],
            ['Neutro', neutro],
            ['Insatisfeito', insatisfeito],
            ['Muito insatisfeito', muitoInsatisfeito],
            ['Não Avaliar', naoAvaliar],

        ]);

        var options = {
            title: 'Experiência prática'
        };

        var chart = new google.visualization.PieChart(document.getElementById('experiencia'));

        chart.draw(experiencia, options);
    }


    //conteudo
    function conteudo() {
        var conteudo = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Muito satisfeito', muitoSatisfeito],
            ['Satisfeito', satisfeito],
            ['Neutro', neutro],
            ['Insatisfeito', insatisfeito],
            ['Muito insatisfeito', muitoInsatisfeito],
            ['Não Avaliar', naoAvaliar],

        ]);

        var options = {
            title: 'Conteúdo técnico'
        };

        var chart = new google.visualization.PieChart(document.getElementById('conteudo'));

        chart.draw(conteudo, options);
    }


    //apresentacao
    function apresentacao() {
        var apresentacao = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Muito satisfeito', muitoSatisfeito],
            ['Satisfeito', satisfeito],
            ['Neutro', neutro],
            ['Insatisfeito', insatisfeito],
            ['Muito insatisfeito', muitoInsatisfeito],
            ['Não Avaliar', naoAvaliar],

        ]);

        var options = {
            title: 'Forma de apresentação'
        };

        var chart = new google.visualization.PieChart(document.getElementById('apresentacao'));

        chart.draw(apresentacao, options);
    }


    //objetividade
    function objetividade() {
        var objetividade = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Muito satisfeito', muitoSatisfeito],
            ['Satisfeito', satisfeito],
            ['Neutro', neutro],
            ['Insatisfeito', insatisfeito],
            ['Muito insatisfeito', muitoInsatisfeito],
            ['Não Avaliar', naoAvaliar],

        ]);

        var options = {
            title: 'Objetividade'
        };

        var chart = new google.visualization.PieChart(document.getElementById('objetividade'));

        chart.draw(objetividade, options);
    }


    //Atendimento
    function Atendimento() {
        var Atendimento = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Muito satisfeito', muitoSatisfeito],
            ['Satisfeito', satisfeito],
            ['Neutro', neutro],
            ['Insatisfeito', insatisfeito],
            ['Muito insatisfeito', muitoInsatisfeito],
            ['Não Avaliar', naoAvaliar],

        ]);

        var options = {
            title: 'Atendimento'
        };

        var chart = new google.visualization.PieChart(document.getElementById('Atendimento'));

        chart.draw(Atendimento, options);
    }


    //Infraestrutura
    function Infraestrutura() {
        var Infraestrutura = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Muito satisfeito', muitoSatisfeito],
            ['Satisfeito', satisfeito],
            ['Neutro', neutro],
            ['Insatisfeito', insatisfeito],
            ['Muito insatisfeito', muitoInsatisfeito],
            ['Não Avaliar', naoAvaliar],

        ]);

        var options = {
            title: 'Infraestrutura'
        };

        var chart = new google.visualization.PieChart(document.getElementById('Infraestrutura'));

        chart.draw(Infraestrutura, options);
    }


    //Contribuicao
    function Contribuicao() {
        var Contribuicao = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Muito satisfeito', muitoSatisfeito],
            ['Satisfeito', satisfeito],
            ['Neutro', neutro],
            ['Insatisfeito', insatisfeito],
            ['Muito insatisfeito', muitoInsatisfeito],
            ['Não Avaliar', naoAvaliar],

        ]);

        var options = {
            title: 'Contribuição para seu exercício profissional'
        };

        var chart = new google.visualization.PieChart(document.getElementById('Contribuicao'));

        chart.draw(Contribuicao, options);
    }



    //online
    function online() {
        var online = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Muito satisfeito', muitoSatisfeito],
            ['Satisfeito', satisfeito],
            ['Neutro', neutro],
            ['Insatisfeito', insatisfeito],
            ['Muito insatisfeito', muitoInsatisfeito],
            ['Não Avaliar', naoAvaliar],

        ]);

        var options = {
            title: 'Acesso e participação por meio on-line	'
        };

        var chart = new google.visualization.PieChart(document.getElementById('online'));

        chart.draw(online, options);
    }


    //profissional
    function profissional() {
        var profissional = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Muito satisfeito', muitoSatisfeito],
            ['Satisfeito', satisfeito],
            ['Neutro', neutro],
            ['Insatisfeito', insatisfeito],
            ['Muito insatisfeito', muitoInsatisfeito],
            ['Não Avaliar', naoAvaliar],

        ]);

        var options = {
            title: 'Contribuição para seu exercício profissional'
        };

        var chart = new google.visualization.PieChart(document.getElementById('profissional'));

        chart.draw(profissional, options);
    }
</script>
<?= $this->endSection() ?>