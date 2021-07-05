<div class="box-body">
    <form action="<?= base_url() ?>admin/changePassword" method="post">
        <div class="form-group">
            <label class="text-success" for="judul">Contraseña anterior</label>
            <input required type="text" class="form-control" id="judul" placeholder="Ingrese la contraseña anterior ..." name="old-password">
        </div>
        <div class="form-group">
            <label class="text-success" for="judul">Nueva contraseña</label>
            <input required type="text" class="form-control" id="judul" placeholder="Introduzca una nueva contraseña..." name="new-password">
        </div>
        <div class="form-group">
            <button class="btn btn-sm btn-success text-light" type="submit">Cambiar</button>
        </div>

        <?php if ($this->session->flashdata('changePassword') == 'success') : ?>
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4>
                    <i class="icon fa fa-ban"></i>
                    Contraseña cambiada con éxito
                </h4>
            </div>
        <?php elseif ($this->session->flashdata('changePassword') == 'error') : ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4>
                    <i class="icon fa fa-ban"></i>
                    No se pudo cambiar la contraseña, tal vez la contraseña anterior sea incorrecta
                </h4>
            </div>
        <?php endif; ?>
    </form>
</div>