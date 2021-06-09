<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4>Isikan data dengan lengkap</h4>
				<form class="form-horizontal form-material" id="formBarang">
					<div class="form-group">
						<label class="col-md-12">Nama Barang</label>
						<div class="col-md-12">
							<input type="text" placeholder="Inputkan nama barang" class="form-control form-control-line form-user-input" name="nama_barang" id="nama_barang">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12">Deskripsi</label>
						<div class="col-md-12">
							<textarea rows="5" class="form-control form-control-line form-user-input" name="deskripsi" id="deskripsi" placeholder="Ceritakan Barang"></textarea>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-12">
							<input class="form-user-input" type="hidden" name="id_barang" id="id_barang" value="">
							<input class="form-user-input" type="hidden" name="stok" id="stok" value="0">
							<button class="btn btn-success" type="submit">Simpan Data Barang</button>
						</div>
					</div>
				</form>
			</div>
			
		</div>
	</div>
</div>


<script>
	
	$('#formBarang').on('submit', function (e) {
		e.preventDefault();
		sendDataPost();
	});

	function sendDataPost() {
		var link = 'http://localhost/backend_inventory/barang/create_action';

		var dataForm = {};
		var allInput = $('.form-user-input');

		$.each(allInput, function (i, val) {
			dataForm[val['name']] = val['value'];
		});

		$.ajax(link, {
			type: 'POST',
			data: dataForm,
			success: function (data, status, xhr) {
				var data_str = JSON.parse(data);
				alert(data_str['pesan']);
				loadMenu('<?= base_url('barang')?>');
			},
			error: function (jqXHR, textStatus, errorMsg) {
				alert('Error : ' + errorMsg);
			}
		});
	}
</script>