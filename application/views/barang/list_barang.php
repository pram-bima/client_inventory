<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				<a href="#" onclick="loadMenu('<?=base_url('barang/form_create')?>')" class="btn btn-primary">Tambah Data Barang</a>
				<hr/>

				<h4>Dibawah Ini Adalah Data Barang</h4>
				<table id="tabel_barang" class="table">
					
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function loadKonten(url) {
		$.ajax(url, {
			type: 'GET',
			success: function (data, status, xhr) {
				var objData = JSON.parse(data);

				$('#tabel_barang').html(objData.konten);
			},
			error: function (jqXHR, textStatus, errorMsg) {
				alert('Error : '+errorMsg);
			}
		})
	}

	loadKonten('http://localhost/backend_inventory/barang/list_barang');
</script>