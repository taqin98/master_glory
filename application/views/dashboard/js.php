<script type="text/javascript">
	let table = null;
	$(document).ready(function () {
		table = $('#example').DataTable({
			processing: true,
			serverSide: true,
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			ajax: {
				url : "<?= base_url('main/get_data_table') ?>",
				type: 'post',
				dataType: 'json',
			},
			columnDefs: [{
				orderable: false,
				targets: [0]
			}, {
				className: "text-right",
				"width": "100px",
				"targets": [9]
			},
			],
			order: [[ 1, 'asc' ]],
			dom: "<'row' <'col-sm-6 text-right'l> <'col-sm-6 d-flex justify-content-end'f> ><'row'<'col-sm-12'tr>><'row'<'col-sm-12 d-flex justify-content-between'ip>>",
			"drawCallback": function( settings ) {
				feather.replace()
			}
		});


	});
	const hapus = (idx) => {
		$.ajax({
			url : '<?= base_url('main/delete_pengajuan') ?>',
			method: 'POST',
			data : {
				'id': idx,
			},
			success: function(response){
				if (response == 1) {
					table.ajax.reload()
				} else {
					alert('Gagal Hapus')
				}
			}

		})
	}
</script>