
<div class="box-body">
<a href="<?php echo base_url() ?>index.php/supplier/to_form" class="btn btn-primary">Tambah Data</a>
<br>
<br>
  <table id="example1" class="table table-bordered table-hover">
    <thead>
    <tr>
		<th>No</th>
		<th>Kode Supplier</th>
		<th>Nama Supplier</th>
		<th>Email Supplier</th>
		<th>No Telepon</th>
		<th>Action</th>
	</tr>
    </thead>    
    <?php $no = 1; foreach($listsupplier->result() as $supplier){?>
		<tr>
			<td><?= $no++ ?></td>		
			<td><?= $supplier->kode_supplier ?></td>
			<td><?= $supplier->nama ?></td>
			<td><?= $supplier->email ?></td>
			<td><?= $supplier->notelp ?></td>
			<td>
				<a href="to_form/<?= $supplier->kode_supplier ?>">Edit</a> - 
				<a onclick="return confirm('Yakin Hapus?')" href="hapus/<?= $supplier->kode_supplier ?>">Hapus</a>
			</td>
		</tr>
	<?php } ?>
  </table>
</div>
<!-- /.box-body -->
</div>
