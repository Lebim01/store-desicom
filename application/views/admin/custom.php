<div class="box-body">

    <?php if ($this->session->flashdata('alert-product') == 'success') : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Guardado exitosamente</h4>
        </div>
    <?php endif; ?>

    <form action="<?= base_url() ?>admin/saveLogo" method="post">
        <div class="parent-photos" style="display:flex;flex-direction:column;width:400px;">
            <label>Cambiar el logotipo del sitio web</label>
            <div class="form-group" style="position:relative;display:inline-block;padding:10px;border:1px solid grey;">
                <label class="text-success" for="file">Elija la foto del logotipo</label>
                <input class="file" type="file" accept="image/*" onchange="uploadCustom(this, '<?= base_url() ?>', 'logo')">
                <div class="image-wrapper" style="padding:5px 0px;">
                    <!-- SUCCESS IMAGE UPLOAD SET HERE -->
                </div>
            </div>

            <label>Cambiar el banner del sitio web</label>
            <div class="form-group" style="position:relative;display:inline-block;padding:10px;border:1px solid grey;">
                <label class="text-success" for="file">Elegir banner de foto</label>
                <input class="file" type="file" accept="image/*" onchange="uploadCustom(this, '<?= base_url() ?>', 'banner')">
                <div class="image-wrapper" style="padding:5px 0px;">
                    <!-- SUCCESS IMAGE UPLOAD SET HERE -->
                </div>
            </div>
        </div>
        <button class="btn btn-success">Guardar</button>
    </form>
</div>