<?= $this->extend('templates/default'); ?>
<?= $this->section('css'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<main id="t3-content">
    <?php
    if (
        isset($_SESSION['id']) &&
        $_SESSION['type'] == 0
    ) {
    ?>
    <div class="container bg-white" style="padding-bottom: 10em;">
        <div class="row">
            <div class="col-12">
                <form method="post" action="<?= base_url('/PdfController/emitirCertificado'); ?>">
                    <div class="form-group">
                        <label for="textCertificado">Texto do Certificado</label>
                        <textarea type="text" name="textCertificado" id="textCertificado" class="form-control"
                            placeholder="certificado" autofocus>
                            <p>Certificamos que <strong>Fulano de Tal</strong></p>
                            <p>Participou do: "<strong>Cuidado Farmacêutico em Tempos de Pandemia - imunização</strong>"</p>
                            <p>Com carga horária de <strong>3 horas.</strong></p>
                            <p class="data">Realizado no dia 03 de Agosto de 2021 em São Paulo - SP.</p>
                            </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Emitir</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    } else {
        echo "<h3>Não tem permissão para acessar essa página!</h3>";
    }
    ?>
</main>
<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<?= $this->endSection(); ?>