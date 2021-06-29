<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				<a href="#" onclick="loadMenu('<?=base_url('barang/form_create')?>')" class="btn btn-primary">Tambah Data Barang</a>
				<hr/>
				<div class="row">
					<div class="col-md-3">
						<label>Nama Barang</label><br>
						<input type="text" name="cari_nama" id="cari_nama" class="form-control form-input-cari">
					</div>
					<div class="col-md-3">
						<label>Deskripsi</label><br>
						<input type="text" name="cari_desk" id="cari_desk" class="form-control form-input-cari">
					</div>
					<div class="col-md-3">
						<label>Maksimal Stok</label><br>
						<input type="number" name="cari_stok" id="cari_stok" class="form-control form-input-cari">
					</div>
					<div class="col-md-3">
						<br>
						<button class="btn btn-info" id="btn-cari">Cari Barang</button>
					</div>
				</div>
				<hr>
				<h4>Dibawah Ini Adalah Data Barang</h4>
				<table id="tabel_barang" class="table">
					<thead>
						<tr>
							<th>Nama</th>
							<th>Deskripsi</th>
							<th>Stok</th>
							<th>Foto</th>
							<th>Aksi</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?= base_url('assets/datatable/datatables.min.js')?>"></script>

<script type="text/javascript">
	function loadKonten(url) {
		$.ajax(url, {
			type: 'GET',
			success: function (data, status, xhr) {
				var objData = JSON.parse(data);

				$('#tabel_barang').html(objData.konten);

				reload_event();
			},
			error: function (jqXHR, textStatus, errorMsg) {
				alert('Error : '+errorMsg);
			}
		})
	}

	function reload_event() {
		$('.linkEditBarang').on('click', function() {
			var hashClean = this.hash.replace('#','');
			loadMenu('<?= base_url('barang/form_edit/')?>' + hashClean);
		});

		$('.linkHapusBarang').on('click', function() {
			var hashClean = this.hash.replace('#', '');
			hapusData(hashClean);
		});

//		$('#tabel_barang').DataTable();
	}

	function hapusData(id_barang) {
		var url = 'http://localhost/backend_inventory/barang/soft_delete_data?id_barang='+id_barang;

		$.ajax(url, {
			type: 'GET',
			success: function (data, status, xhr) {
				var objData = JSON.parse(data);
				alert(objData['pesan']);
				loadKonten('http://localhost/backend_inventory/barang/list_barang');
			},
			error: function (jqXHR, textStatus, errorMsg) {
				alert('Error : ' + errorMsg);
			}
		})
	}

	$('#btn-cari').on('click', function() {
		cariData();
	});

	function cariData() {
		var url = 'http://localhost/backend_inventory/barang/cari_barang';
		var dataForm = {};
		var allInput = $('.form-input-cari');

		$.each(allInput, function(i, val) {
			dataForm[val['name']] = val['value'];
		});

		$.ajax(url, {
			type: 'POST',
			data: dataForm,
			success: function(data, status, xhr) {
				var objData = JSON.parse(data);
				$('#tabel_barang').html(objData.konten);

				reload_event();
			},
			error: function(jqxhr, textstatus, errorMsg) {
				alert('Error : ' + errorMsg);
			}
		})
	}

//	loadKonten('http://localhost/backend_inventory/barang/list_barang');
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tabel_barang').DataTable({
			"processing":true,
			"serverSide":true,
			"lengthMenu":[[1,2,3,-1],[1,2,3,"ALL"]],
			"ajax":"http://localhost/backend_inventory/barang/list_barang_ajax",
			"fnDrawCallback":function() {
				reload_event();
			}
		});
	});
</script>