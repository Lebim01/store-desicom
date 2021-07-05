<div class="container" style="padding-top:20px;padding-bottom:20px;">
    <div class="row white" style="padding:10px;">
        <div class="col s12 m7">
            <img class="materialboxed" id="primary-image" width="100%" src="<?= base_url() ?>assets/images/upload/<?= $photos[0]->nama_foto ?>" style="border:1px solid #ddd;">
            <div class="image-collection d-flex my-scrollbar">
                <?php foreach ($photos as $idx => $photo) : ?>
                    <img onclick="changeImage('<?= $idx ?>', '<?= base_url() ?>assets/images/upload/<?= $photo->nama_foto ?>')" src="<?= base_url() ?>assets/images/upload/<?= $photo->nama_foto ?>">
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col s12 m5">
            <h4 class="blue-grey-text" style="margin:5px 0;"><?= $produk->nama_produk ?></h4>
            <h5 class="teal-text">$<?= number_format($produk->harga) ?></h5>
            <div class="blue-grey-text font-weight-bold" style="margin:15px 0;">Stock : <?= $produk->stok ?></div>
            <!--<div class="row" style="margin-bottom:0px;">
                <div class="input-field col s6">
                    <small style="margin-bottom:3px 0;">Cantidad</small>
                    <input type="number" class="validate" min="0" placeholder="0" id="kuantitas" value="">
                </div>
            </div>-->
            <a onclick="whatsapp('Quisiera informacion sobre: <?= $produk->nama_produk ?>')">
                <button class="rm-box-shadow waves-effect waves-light btn capitalize">Pedir por whatsapp</button>
            </a>

            <!--<br><br>
            <div>
                <b class="blue-grey-text">Kategori</b>
                <div class="d-flex flex-wrap" style="margin-top:5px;">
                    <div class="chip white-text blue-grey d-flex align-center">
                        <i class="material-icons">loyalty</i>
                        <?= $produk->kategori ?>
                    </div>
                </div>
            </div>-->
        </div>
    </div>

    <div class="row white">
        <div class="col s12">
            <h5 class="teal-text d-flex align-center">
                <i class="material-icons">description</i>
                &nbsp;
                Descripción
            </h5>
            <p class="">
                <?= $produk->deskripsi ?>
            </p>
        </div>
    </div>
</div>