<!doctype html>
<html lang="pt-Br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, shrink-to-fit=no" />
    <meta name="theme-color" content="#0a346d">
    <meta name="apple-mobile-web-app-status-bar-style" content="#0a346d">
    <meta name="msapplication-navbutton-color" content="#0a346d">

    <!-- Bootstrap CSS -->
    <link rel="icon" href="<?= base_url() ?>/public/favicon.ico" type="image/ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdn.tiny.cloud/1/v3a7dc1nzdd06k29ac2c2ubbcppcvjzd8s3bkrezrxj56hnf/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


    <title><?php echo $title ?></title>
    <style>
        header {
            background-color: #fff;
            max-height: 100px;
        }

        .bg-custom {
            background-image: linear-gradient(15deg, #092e48 0%, #00557a 100%);
        }

        body {
            min-height: 100vh;
            position: relative;
            padding-bottom: 100px;
            box-sizing: border-box;
            background-color: #f4f4f4;
        }

        footer {
            position: absolute;
            bottom: 0;
            height: 100px;
        }

        main {
            padding: 45px 0;
        }

        /* width */
        ::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #0a346d;
        }


        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #1598ef;
        }

        #mostrar {
            display: none;
        }

        #passar_mouse:hover #mostrar {
            display: block;
        }

        a.disabled {
            pointer-events: none;
            cursor: default;
        }


        @media only screen and (min-width: 250px) {
            .logo-img {
                min-width: 120px;
            }


        }


        .navbar {
            width: 100%;
        }

        .custom {
            width: 100%;
        }

        /* #anchorpt1 {
            margin-top: 20px;
            float: right;
            width: 750px;
        } */

        .anchor {
            margin-left: 20px;
        }

        .logo-img {
            width: 50%;
            margin-left: 20px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        /* @media only screen and (min-width: 1200px) {
            .session {
                margin-left: 260px;
                text-transform: uppercase;
            }

            .menu {
                margin-left: 260px;
            }

            .nav2 {
                margin-left: 70px;
                margin-right: 70px;
            }

            .menuUser {
                margin-left: 260px;
            }

            .sessionUser {
                margin-left: 260px;
                text-transform: uppercase;
            }
        } */

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
    <?= $this->renderSection("css"); ?>


</head>


<header>
    <div class="row" style="margin: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <div class="logo-image">
                        <a href="<?= base_url('inicio'); ?>" title="CRF-SP - Conselho Regional de Farmácia do Estado de São Paulo">
                            <img class="logo-img" src="<?= base_url('public/img/logo.png'); ?>" alt="CRF-SP - Conselho Regional de Farmácia do Estado de São Paulo" />
                        </a>
                    </div>
                </div>
                <div class="col-9" style="text-align: right;">

                    <a accesskey="1" href="javascript:void(0);" class="anchor acess" title="conteudo" onclick="abrirConteudo()">
                        ir para conteudo <span>1</span>
                    </a>
                    <a accesskey="2" href="javascript:void(0);" class="anchor acess" title="menu" onclick="abrirMenu()">
                        ir para menu <span>2</span>
                    </a>
                    <a accesskey="3" href="javascript:void(0);" class="anchor acess" title="rodapé" onclick="abrirRodape()">
                        ir para rodapé <span>3</span>
                    </a>
                    <a accesskey="4" href="javascript:void(0);" class="anchor acess" title="contraste" onclick="contraste();" id="contrasteLink">
                        alto contraste <span>4</span>
                    </a>
                    <a accesskey="5" href="<?= base_url('acessibilidade'); ?>" class="anchor acess " title="acessibilidade">
                        acessibilidade <span>5</span>
                    </a>

                </div>
            </div>

            <div class=" header-utils">
                <div class="social-icons ">
                    <div vw class="enabled">
                        <div vw-access-button class="active"></div>
                        <div vw-plugin-wrapper>
                            <div class="vw-plugin-top-wrapper"></div>
                        </div>
                    </div>
                    <!-- <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script> -->
                    <script>
                        (function(window, document, Loading, MessageBox) {
                            function VLibrasPlugin() {
                                this.loaded = false;
                                this.chooser = new qdClient.Chooser();
                                this.glosa = undefined;
                                this.loading = new Loading('#loading-screen', '#message-box');
                                this.message = new MessageBox('#message-box');
                                this.lastReq = {
                                    url: null,
                                    millis: null,
                                    response: null
                                };
                            }

                            VLibrasPlugin.prototype.sendGlosa = function(glosa) {
                                var glosa = glosa || this.glosa;

                                if (glosa !== undefined && this.loaded === true) {
                                    window.SendMessage('PlayerManager', 'catchGlosa', glosa);
                                }
                            };

                            VLibrasPlugin.prototype.translate = function(text) {
                                var self = this;
                                self.loading.show('Traduzindo...');
                                self.chooser.choose(self.lastReq.url, self.lastReq.millis, self.lastReq.response,
                                    function(url) {
                                        var start = new Date().getTime();

                                        if (!url) {
                                            self.loading.hide();
                                            self.message.show('warning', 'Não foi possível se conectar ao servidor. Irei soletrar!', 3000);

                                            self.glosa = decodeURI(text).toUpperCase();
                                            self.sendGlosa();
                                            return;
                                        }

                                        qdClient.request(url + '?texto=' + text, "GET", {},
                                            function(status, response) {
                                                self.lastReq.response = status !== 200 ? -1 : status;
                                                self.lastReq.millis = (new Date().getTime() - start);
                                                self.lastReq.url = url;

                                                self.loading.hide();
                                                if (status !== 200)
                                                    self.message.show('warning', 'Não foi possível se conectar ao servidor. Irei soletrar!', 3000);

                                                self.glosa = response || decodeURI(text).toUpperCase();
                                                self.sendGlosa();
                                            });
                                    });
                            };

                            VLibrasPlugin.prototype.showMessage = function(level, message, time) {
                                this.message.show(level, message, time);
                            };

                            VLibrasPlugin.prototype.hideMessage = function() {
                                this.message.hide();
                            };

                            VLibrasPlugin.prototype.load = function() {
                                this.loaded = true;
                                this.sendGlosa();
                            };

                            VLibrasPlugin.prototype.errorHandler = function() {
                                console.log('ErrorHandler!');
                                this.message.show('warning', 'Ops! Ocorreu um problema, por favor entre em contato com a gente.');
                            };

                            // Expose
                            window.VLibrasPlugin = new VLibrasPlugin();
                            window.onerror = function() {
                                this.VLibrasPlugin.errorHandler();
                            };

                            window.onLoadPlayer = function() {
                                this.VLibrasPlugin.load();
                            };
                        })(window, document, Loading, MessageBox);
                    </script>
                    <script>
                        new window.VLibras.Widget('https://vlibras.gov.br/app');
                    </script>
                </div>
            </div>
        </div>
    </div>
</header>

<body class="d-flex flex-column min-vh-100">
    <?php $uri = service('uri'); ?>
    <?php if (session()->get('isLoggedIn')) : ?>

        <nav class="navbar navbar-expand-lg navbar-dark  bg-custom">
            <div class="container" id="menuanchor">

                <?php
                if (
                    isset($_SESSION['id']) &&
                    $_SESSION['type'] == 0
                ) {
                ?>
                    <div class="col-12">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav mr-auto" id="inicio">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('inicio'); ?>">Inicio</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav mr-auto menu ">
                                <li class="nav-item dropdown ">
                                    <a class="nav-link evento" href="<?= base_url('alterarEventos') ?>">Eventos</a>
                                </li>
                                <li class="nav-item dropdown nav2 ">
                                    <a class="nav-link" href="<?= base_url('alterarAtividades') ?>">Atividades</a>
                                </li>
                                <li class="nav-item dropdown  ">
                                    <a class="nav-link user" href="<?= base_url('alterarUser') ?>">Usuários</a>
                                </li>
                                <li class="nav-item dropdown  ">
                                    <a class="nav-link pesq" href="<?= base_url('listaPesquisa') ?>">Pesquisas</a>
                                </li>
                                <li class="nav-item dropdown  ">
                                    <a class="nav-link campanha" href="<?= base_url('listarCampanhas') ?>">Campanhas</a>
                                </li>
                            </ul>

                            <ul class="navbar-nav mr-auto  session">
                                <li class="nav-item dropdown ">
                                    <a class="nav-link dropdown-toggle fa fa-sign-out" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php
                                        echo $_SESSION['firstname'];
                                        ?>

                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="<?php echo base_url('editarUser') . '/' . $_SESSION['id'] ?>">Editar</a>
                                        <a class="dropdown-item" href="<?= base_url('logout') ?>">Sair</a>
                                    </div>
                            </ul>
                        <?php
                    } else {
                        ?>
                            <div class="col-12">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="navbar-nav" id="inicio">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url('inicio'); ?>">Inicio</a>
                                        </li>
                                    </ul>
                                    <ul class="navbar-nav  menuUser" style=" margin-left: 320px;">
                                        <li class="nav-item dropdown ">
                                            <!-- <a class="nav-link" href="<?= base_url('inscrevase') ?>">Inscreva-se</a> -->
                                        </li>
                                        <li class="nav-item  nav2 ">
                                            <a class="nav-link" href="<?= base_url('listarEventosUser') ?>">Minhas inscrições</a>
                                        </li>
                                        <!-- <li class="nav-item dropdown  ">
                                <a class="nav-link" href="<?= base_url('listarAtividades') ?>">Atividades</a>
                            </li> -->
                                    </ul>

                                    <ul class="navbar-nav sessionUser">
                                        <li class="nav-item dropdown ">
                                            <a class="nav-link dropdown-toggle fa fa-sign-out" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?php
                                                echo $_SESSION['firstname'];
                                                ?>

                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                <a class="dropdown-item editarUser" href="<?php echo base_url('editarUser') . '/' . $_SESSION['id'] ?>">Editar</a>
                                                <a class="dropdown-item" href="<?= base_url('logout') ?>">Sair</a>
                                            </div>
                                    </ul>

                                <?php
                            }
                                ?>

                                </div>
                            </div>
        </nav>

    <?php
    endif;
    ?>

    <?= $this->renderSection("content"); ?>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ST5941BK0S"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-ST5941BK0S');

        function abrirConteudo() {

            var urlAtual = document.location.href;
            if (urlAtual.includes("#")) {
                urlAtual = urlAtual.substr(0, urlAtual.indexOf('#')) + "#t3-content";
            } else {
                urlAtual = urlAtual + "#t3-content";
            }

            window.location.replace(urlAtual);

        }


        function abrirMenu() {

            var urlAtual = document.location.href;
            if (urlAtual.includes("#")) {
                urlAtual = urlAtual.substr(0, urlAtual.indexOf('#')) + "#menuanchor";
            } else {
                urlAtual = urlAtual + "#menuanchor";
            }

            window.location.replace(urlAtual);

        }


        function abrirRodape() {

            var urlAtual = document.location.href;
            if (urlAtual.includes("#")) {
                urlAtual = urlAtual.substr(0, urlAtual.indexOf('#')) + "#rodape";
            } else {
                urlAtual = urlAtual + "#rodape";
            }

            window.location.replace(urlAtual);

        }


        function contraste() {
            var body = document.getElementsByTagName('body');
            if (body[0].style.backgroundColor == "black") {
                window.location.reload(true);
            } else {

                for (var i = 0; i < body.length; i++) {
                    body[i].style.backgroundColor = "black";
                }

                var divs = document.getElementsByTagName('div');
                for (var i = 0; i < divs.length; i++) {
                    divs[i].style.backgroundColor = "black";
                    divs[i].style.color = "yellow";
                }
                var navs = document.getElementsByTagName('nav');
                for (var i = 0; i < navs.length; i++) {
                    navs[i].style.backgroundColor = "black";
                    navs[i].style.color = "yellow";
                }
                var header = document.getElementsByTagName('header');
                for (var i = 0; i < header.length; i++) {
                    header[i].style.backgroundColor = "black";
                    header[i].style.color = "yellow";
                }
                var footer = document.getElementsByTagName('footer');
                for (var i = 0; i < footer.length; i++) {
                    footer[i].style.backgroundColor = "black";
                    footer[i].style.color = "yellow";
                }

                var as = document.getElementsByTagName('a');
                for (var i = 0; i < as.length; i++) {
                    as[i].style.backgroundColor = "black";
                    as[i].style.color = "yellow";
                }
                var ps = document.getElementsByTagName('p');
                for (var i = 0; i < ps.length; i++) {
                    ps[i].style.backgroundColor = "black";
                    ps[i].style.color = "yellow";
                }
                var ps = document.getElementsByTagName('h1');
                for (var i = 0; i < ps.length; i++) {
                    ps[i].style.backgroundColor = "black";
                    ps[i].style.color = "yellow";
                }
                var is = document.getElementsByTagName('i');
                for (var i = 0; i < is.length; i++) {
                    is[i].style.color = "yellow";
                }
                var spans = document.getElementsByTagName('span');
                for (var i = 0; i < spans.length; i++) {
                    spans[i].style.backgroundColor = "black";
                    spans[i].style.color = "yellow";
                }
                var iframes = document.getElementsByTagName('iframe');
                for (var i = 0; i < iframes.length; i++) {
                    iframes[i].style.backgroundColor = "white";
                    iframes[i].style.color = "yellow";
                }
                var tables = document.getElementsByTagName('table');
                for (var i = 0; i < tables.length; i++) {
                    tables[i].style.backgroundColor = "black";
                    tables[i].style.color = "yellow";
                }
                var tbodys = document.getElementsByTagName('tbody');
                for (var i = 0; i < tbodys.length; i++) {
                    tbodys[i].style.backgroundColor = "black";
                    tbodys[i].style.color = "yellow";
                }
                var trs = document.getElementsByTagName('tr');
                for (var i = 0; i < trs.length; i++) {
                    trs[i].style.backgroundColor = "black";
                    trs[i].style.color = "yellow";
                }
                var tds = document.getElementsByTagName('td');
                for (var i = 0; i < tds.length; i++) {
                    tds[i].style.backgroundColor = "black";
                    tds[i].style.color = "yellow";
                }
                var button = document.getElementsByClassName('socialList_item');
                for (var i = 0; i < button.length; i++) {
                    button[i].style.backgroundColor = "black";
                    button[i].style.color = "yellow";
                }
            }
        }

        $(document).ready(function() {

            var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

            tinymce.init({
                selector: 'textarea',
                plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
                imagetools_cors_hosts: ['picsum.photos'],
                menubar: 'file edit view insert format tools table help',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                toolbar_sticky: true,
                autosave_ask_before_unload: true,
                autosave_interval: '30s',
                autosave_prefix: '{path}{query}-{id}-',
                autosave_restore_when_empty: false,
                autosave_retention: '2m',
                image_advtab: true,
                link_list: [{
                        title: 'My page 1',
                        value: 'https://www.tiny.cloud'
                    },
                    {
                        title: 'My page 2',
                        value: 'http://www.moxiecode.com'
                    }
                ],
                image_list: [{
                        title: 'My page 1',
                        value: 'https://www.tiny.cloud'
                    },
                    {
                        title: 'My page 2',
                        value: 'http://www.moxiecode.com'
                    }
                ],
                image_class_list: [{
                        title: 'None',
                        value: ''
                    },
                    {
                        title: 'Some class',
                        value: 'class-name'
                    }
                ],
                importcss_append: true,
                file_picker_callback: function(callback, value, meta) {
                    /* Provide file and text for the link dialog */
                    if (meta.filetype === 'file') {
                        callback('https://www.google.com/logos/google.jpg', {
                            text: 'My text'
                        });
                    }

                    /* Provide image and alt text for the image dialog */
                    if (meta.filetype === 'image') {
                        callback('https://www.google.com/logos/google.jpg', {
                            alt: 'My alt text'
                        });
                    }

                    /* Provide alternative source and posted for the media dialog */
                    if (meta.filetype === 'media') {
                        callback('movie.mp4', {
                            source2: 'alt.ogg',
                            poster: 'https://www.google.com/logos/google.jpg'
                        });
                    }
                },
                templates: [{
                        title: 'New Table',
                        description: 'creates a new table',
                        content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                    },
                    {
                        title: 'Starting my story',
                        description: 'A cure for writers block',
                        content: 'Once upon a time...'
                    },
                    {
                        title: 'New list with dates',
                        description: 'New List with dates',
                        content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                    }
                ],
                template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                height: 600,
                image_caption: true,
                quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                noneditable_noneditable_class: 'mceNonEditable',
                toolbar_mode: 'sliding',
                contextmenu: 'link image imagetools table',
                skin: useDarkMode ? 'oxide-dark' : 'oxide',
                content_css: useDarkMode ? 'dark' : 'default',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
            });

        });
    </script>

    <?= $this->renderSection("js"); ?>
    <style>
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background-image: linear-gradient(15deg, #00557a 0%, #092e48 100%);
        }


        <?php if (isset($color)) {
            echo ('h2, h1,th {                
                color: ' . $color . ';
        }');
        } ?><?php if (isset($colorSecundaria)) {
                echo (' .btn, #card-footer, #card-header , .card-footer, .card-header {                
            background-color: ' . $colorSecundaria . ';
        }');
            } ?><?php if (isset($colorFH) && isset($colorSecundariaFH)) {
                    echo ('.bg-custom, .footer {
            background-image: linear-gradient(15deg,  ' . $colorFH . '  0%, ' . $colorSecundariaFH . ' 100%);
        }');
                } ?>
    </style>
    <?php
    if (session()->get('isLoggedIn')) : ?>
        <footer class="footer" id="rodape">
            <div class="container">
                <span class="text-muted"></span>
            </div>
        </footer>
</body>

</html>
<?php endif; ?>