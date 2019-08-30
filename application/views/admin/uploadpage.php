<input type="hidden" class="base_url" value="<?=base_url()?>">

<div class="box-body">
    <?php if($this->session->flashdata('alert-product') == 'success'): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Berhasil</h4>            
        </div>
    <?php elseif($this->session->flashdata('alert-product') == 'error'): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Terjadi error</h4>            
        </div>
    <?php endif; ?>

    <br>    
    <?php if(isset($edit)):?>
        <form method="post" action="<?=base_url()?>admin/editProduct/<?=$id_produk?>">
    <?php else: ?>
        <form method="post" action="<?=base_url()?>admin/uploadProduct">
    <?php endif;?>
        <div class="form-group" id="file-choose">
            <label class="text-success">Foto Produk</label>
            <br>
            <button class="btn btn-xs btn-success" id="addPhoto" style="margin:5px 0;">+ tambah foto</button>
            <div class="parent-photos" style="display:flex;flex-direction:column;width:400px;">

            <?php if(isset($edit)):?>
                <?php foreach($photos as $i=>$photo): ?>
                    <div class="form-group" style="position:relative;display:inline-block;padding:10px;border:1px solid grey;">
                        <!-- <label class="text-success" for="file">Pilih Foto</label> -->
                        <input class="file" type="hidden" accept="image/*" required onchange="uploadFile(this, '<?=base_url()?>')">      
                        <div class="image-wrapper" style="padding:5px 0px;">
                            <img src="<?=base_url()?>assets/images/upload/<?=$photo->nama_foto?>" width="150" height="100">
                            <input type="hidden" value="<?=$photo->nama_foto?>" name="image[]">
                        </div>
                        <button onclick="deletePhotoDb(this, '<?=$product->id_produk?>', '<?=$photo->nama_foto?>')" class="btn btn-xs btn-danger delete-photo-db" type="button" style="position:absolute;top:0;right:0;">hapus</button>
                    </div>
                <?php endforeach;?>
            <?php else: ?>
                <div class="form-group" style="position:relative;display:inline-block;padding:10px;border:1px solid grey;">
                    <label class="text-success" for="file">Pilih Foto</label>
                    <input class="file" type="file" accept="image/*" required onchange="uploadFile(this, '<?=base_url()?>')">      
                    <div class="image-wrapper" style="padding:5px 0px;">
                        <!-- SUCCESS IMAGE UPLOAD SET HERE -->
                    </div>               
                </div>
            <?php endif;?>
                           
            </div>
        </div>

        <div class="form-group">
            <label class="text-success">Nama Produk</label>
            <input required type="text" class="form-control" placeholder="Masukkan Nama Produk" name="namaproduk" value="<?=isset($product)?$product->nama_produk:''?>">
        </div> 
        <div class="form-group">
            <label class="text-success">Harga Produk</label>
            <input required type="number" min="0" class="form-control" placeholder="Rp.0" name="harga" value="<?=isset($product)?$product->harga:''?>">
        </div> 
        <div class="form-group">
            <label class="text-success">Stok Tersedia</label>
            <input required type="number" min="0" class="form-control" placeholder="Masukkan yang tersedia" name="stok" value="<?=isset($product)?$product->stok:''?>">
        </div> 
        

        <div class="form-group">
            <label class="text-success">Pilih Kategori Produk</label>
            <select class="form-control" name="kategori">
                    <option value="" selected disabled>pilih kategori</option>
                <?php foreach($categories as $category): ?>
                    <option <?=$category->nama_kategori==$product->kategori?'selected':''?> value="<?=$category->nama_kategori?>"><?=$category->nama_kategori?></option>
                <?php endforeach; ?>                
            </select>
        </div>
        
        <div class="form-group">
            <label class="text-success">Deskripsi</label>
            <textarea class="form-control" rows="3" placeholder="Masukkan deskripsi produk disini" name="deskripsi"><?=isset($product)?$product->deskripsi:''?></textarea>
        </div>
       
        <div class="form-group">
            <button type="submit" class="btn btn-success"><?=$title?></button>
        </div>
        
    </form>    
</div>
