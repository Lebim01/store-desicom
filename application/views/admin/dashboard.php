<div class="box-body">
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover table-bordered">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <!--<th>Categoria</th>-->
                <th>Descripción</th>
                <th>Ultima actualización</th>
                <th>Acciones</th>
            </tr>

            <?php $i = 1;
            foreach ($products as $product) : ?>
                <tr>
                    <td>
                        <?= $product->id_produk ?>
                    </td>
                    <td><?= $product->nama_produk ?></td>
                    <td>$<?= number_format($product->harga) ?></td>
                    <td><?= $product->stok ?></td>
                    <!--<td><?= $product->kategori ?></td>-->
                    <td><?= $product->deskripsi ?></td>
                    <td><?= $product->tgl_upload ?></td>
                    <td>
                        <form action="<?= base_url() ?>admin/deleteProduct/<?= $product->id_produk ?>" style="display:inline-block;">
                            <button class="btn btn-xs btn-danger" onclick="return confirm('Eliminar producto <?= $product->nama_produk ?>?')">Eliminar</button>
                        </form>
                        <a href="<?= base_url() ?>admin/editPage/<?= $product->id_produk ?>">
                            <button class="btn btn-xs btn-success">Editar</button>
                        </a>
                        <a href="<?= base_url() ?>product/<?= $product->id_produk ?>">
                            <button class="btn btn-xs btn-primary">Ver</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>