<style type="text/css">
	.upload-area {
		width: 70%;
		height: 350px;
		border: 2px solid lightgray;
		border-radius: 3px;
		margin: 0 auto;
		text-align: center;
		overflow: auto;
	}

	.upload-area:hover {
		cursor: pointer;
	}

	.upload-area h2 {
		text-align: center;
		font-weight: normal;
		font-family: sans-serif;
		line-height: 50px;
		color: darkslategray;
	}

	#file {
		display: none;
	}

	/* Thumbnail */
	.thumbnail {
		width: 80px;
		height: 80px;
		padding: 2px;
		border: 2px solid lightgray;
		border-radius: 3px;
		float: left;
	}

	.size {
		font-size: 12px;
	}
</style>
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
						<label class="col-md-12">Upload Foto</label>
						<div class="col-md-12">
							<input type="file" name="file" id="file">

							<!-- Drag and Drop Container -->

							<div class="upload-area" id="uploadfile">
								<h2>Drag and Drop file here<br> or <br>Click to select file</h2>
							</div>
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

	function sendDataPost() {
		<?php
			if ($titel == 'Form Edit Data Barang') {
				echo "var link = 'http://localhost/backend_inventory/barang/update_action/';";
			} else {
				echo "var link = 'http://localhost/backend_inventory/barang/create_action/';";
			}
		?>

		var dataForm = new FormData();
		var allInput = $('.form-user-input');

		$.each(allInput, function (i, val) {
			dataForm.append(val['name'], val['value']);
		});

		var file = $('#file')[0].files[0];
		dataForm.append('file', file);

		$.ajax(link, {
			type: 'POST',
			data: dataForm,
			contentType: false,
			processData: false,
			dataType: 'json',
			success: function (data, status, xhr) {
				alert(data_str['pesan']);
				loadMenu('<?= base_url('barang')?>');
			},
			error: function (jqXHR, textStatus, errorMsg) {
				alert('Error : ' + errorMsg);
			}
		});
	}

	function getDetail(id_barang) {
		var link = 'http://localhost/backend_inventory/barang/detail?id_barang='+id_barang;

		$.ajax(link, {
			type: 'GET',
			success: function (data, status, xhr) {
				var data_obj = JSON.parse(data);

				if (data_obj['sukses'] == 'ya') {
					var detail = data_obj['detail'];
					$('#nama_barang').val(detail['nama_barang']);
					$('#id_barang').val(detail['id_barang']);
					$('#deskripsi').val(detail['deskripsi']);
					$('#stok').val(detail['stok']);
				} else {
					alert('Data Tidak Ditemukan');
				}
			},
			error:  function (jqXHR, textStatus, errorMsg) {
				alert('Error : ' + errorMsg);
			}
		});
	}

	<?php 
		if ($titel == 'Form Edit Data Barang') {
			echo 'getDetail('.$id_barang.');';
		}
	?>

	$('#formBarang').on('submit', function (e) {
		e.preventDefault();
		sendDataPost();
	});
	
	<!-- Agar browser tidak membuka file yang didrop -->
	$("html").on("drop", function(e) {
		e.preventDefault();
		e.stopPropagation();
	});

	<!-- Untuk merubah text pada field menjadi Drag here -->
	$("html").on("dragover", function(e) {
		e.preventDefault();
		e.stopPropagation();
		$(".upload-area > h2").text("Drag here");
	});

	<!-- Untuk merubah text pada field menjadi Drop -->
	$('.upload-area').on('dragenter', function(e) {
		e.stopPropagation();
		e.preventDefault();
		$(".upload-area > h2").text("Drop");
	});

	$('.upload-area').on('dragover', function(e) {
		e.stopPropagation();
		e.preventDefault();
		$(".upload-area > h2").text("Drop !!");
	});

	<!-- Untuk menampilkan nama file gambar yang dilampirkan -->
	$(".upload-area").on("drop", function(e) {
		e.preventDefault();
		e.stopPropagation();

		var file = e.originalEvent.dataTransfer.files;
		$("#file")[0].files = file;
		console.log(file);
		$(".upload-area > h2").text("File yang dipilih: "+file[0].name);
	});

	<!-- Untuk menampilkan file browser ketika diklik -->
	$(".upload-area").click(function() {
		$("#file").click();
	});

	$("#file").change(function() {
		var file = $("#file")[0].files[0];
		console.log(file);
		$(".upload-area > h2").text("File yang dipilih :"+file.name);
	});
</script>