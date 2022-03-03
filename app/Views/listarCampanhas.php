<?= $this->extend('templates/default'); ?>
<?= $this->section('css'); ?>
<style>
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
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<main id="t3-content">
    <div class="container bg-white" style="padding-bottom: 10em;">
        <br>
        <a name="adicionar" id="btnAdicionar" class="btn btn-success float-right" href='<?php echo base_url('/cadastrarCampanha'); ?>' role="button"><i class="fa fa-plus" aria-hidden="true"></i>
            Adicionar</a>
        <h2 class="card-title text-center">Listagem de Campanhas </h2>
        <table class="table table-hover" id="Campanhas">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Criado em</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $campanha) {
                    echo '<tr><td>' . $campanha['id'] . '</td><td>' . $campanha['titulo'] . '</td><td>' . date_format(new DateTime($campanha['created_at']), "d/m/Y  - H:i") . '</td>';
                    echo '<td>';
                    if (!empty($campanha['sent_by'])) {
                        echo '<i class="fa fa-paper-plane" aria-hidden="true" style="color:grey;" title="Campanha enviada."></i> ';
                        echo '<a id="visualizar" href= ' . base_url('/visualizarCampanha') . "/" . $campanha['id'] . ' style="color:blue;" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" title="Visualizar campanha."></i>
                        </a>';
                    } else {
                        echo '<a id="enviar" href= ' . base_url('/enviarCampanha') . "/" . $campanha['id'] . ' style="color:#28a745;"><i class="fa fa-paper-plane" aria-hidden="true" title="Enviar campanha."></i>
                        </a>';                       
                        echo '<a id="visualizar" href= ' . base_url('/visualizarCampanha') . "/" . $campanha['id'] . ' style="color:blue;" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" title="Visualizar campanha."></i>
                        </a>';
                        echo '<a id="excluir" href= ' . base_url('/excluirCampanha') . "/" . $campanha['id'] . ' style="color:red;"><i class="fa fa-times-circle" aria-hidden="true" title="Excluir campanha."></i>
                        </a>';
                    }

                    echo  '</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
<?= $this->endSection(); ?>
<?= $this->section('js'); ?>

<?= $this->endSection(); ?>