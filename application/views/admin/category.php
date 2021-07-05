<div class="box-body">
    <?php if ($this->session->flashdata('alert-category') == 'success') : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Berhasil</h4>
        </div>
    <?php elseif ($this->session->flashdata('alert-category') == 'error') : ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-close"></i> Hay un error silahkan coba lagi</h4>
        </div>
    <?php endif; ?>


    <div style="display:flex;justify-content:center;padding: 20px;">
        <form action="<?= base_url() ?>admin/addCategory" method="post">
            <div class="form-group">
                <label class="text-success">Tambah Kategori Produk</label>
                <input type="text" class="form-control" placeholder="Masukkan Kategori Produk" name="category">
                <div style="text-align:center;padding:10px;">
                    <button class="btn btn-sm btn-success">Tambah</button>
                </div>
            </div>
        </form>
    </div>
    <div class="box box-info table-responsive no-padding">
        <table class="table table-hover table-bordered">
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
            <?php $i = 1;
            foreach ($categories as $category) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td>
                        <div style="padding: 2px 5px;border-radius:5px;background:#3EA65B;color:white;display:inline-block;">
                            <?= $category->nama_kategori ?>
                        </div>
                    </td>
                    <td>
                        <form action="<?= base_url() ?>admin/deleteCategory/<?= $category->id_kategori ?>">
                            <button class="btn btn-xs btn-danger" onclick="return confirm('Eliminar categoria <?= $category->nama_kategori ?>')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>