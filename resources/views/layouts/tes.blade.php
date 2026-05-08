@extends('layouts.master')

@section('navigation')
	@include('layouts.navigation')
@stop

@section('content')

@if(isset($nota_pengganti) && $nota_pengganti == true)
@include('components.page.header', [
	'extra' => 'Penjualan:',
	'title' => 'Nota Pengganti Sederhana',
])
@else
	@if(isset($penjualan) && $penjualan->dilanjutkan_dari != null)
	@include('components.page.header', [
		'extra' => 'Penjualan:',
		'title' => 'Nota Kena Pajak (Lanjutan Dari Nota : '.$penjualan->dilanjutkan_dari.')',
	])
	@elseif(isset($penjualan) && $penjualan->old_id_penjualan != null)
	@include('components.page.header', [
		'extra' => 'Penjualan:',
		'title' => 'Nota Sederhana (Pengganti)',
	])
	@else
	@include('components.page.header', [
		'extra' => 'Penjualan:',
		'title' => 'Nota Sederhana',
	])
	@endif
@endif

@if(isset($penjualan))
<div id="BatalPenjualan" class="modal fade" style="z-index:9999">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="color-line"></div>
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Batal Nota Kena Pajak</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<h4 class="text-danger">Nota yang dibatalkan tidak dapat dinyalakan kembali, apakah anda yakin untuk membatalkan nota ini ?</h4>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				{{ Form::open(array('route' => 'penjualan.batal.sederhana', 'method' => 'PUT', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
					<input type="hidden" id="id_customer" name="id_penjualan" type="text" value="{{$penjualan->id_penjualan}}">
					<button type="submit" class="btn btn-danger">Ya, Batalkan Nota</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Tidak</button>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

<div id="NotaLanjutanModal" class="modal fade" style="z-index:9999">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="color-line"></div>
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Buat Nota Lanjutan</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<h4 class="text-warning">Apakah yakin untuk membuat nota lanjutan ?</h4>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				{{ Form::open(array('route' => 'penjualan.lanjutan.sederhana', 'method' => 'PUT', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
					<input type="hidden" id="id_customer" name="id_penjualan" type="text" value="{{$penjualan->id_penjualan}}">
					<button type="submit" class="btn btn-warning">Ya, Buat Nota Lanjutan</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Tidak</button>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

<div id="HapusNotaPenggantiModal" class="modal fade" style="z-index:9999">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="color-line"></div>
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Hapus Nota Pengganti</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<h4 class="text-danger">Nota yang dihapus tidak dapat dikembalikan, apakah anda yakin untuk menghapus nota ini ?</h4>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				{{ Form::open(array('route' => 'penjualan.hapus.pajak', 'method' => 'DELETE', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
					<input type="hidden" id="id_customer" name="id_penjualan" type="text" value="{{$penjualan->id_penjualan}}">
					<button type="submit" class="btn btn-danger">Ya, Hapus Nota Pengganti</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Tidak</button>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@endif

<div class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="hpanel">
				<div class="panel-body">
					@include('components.page.error_catcher')

					@if(isset($penjualan) && !isset($nota_pengganti))
					{{ Form::open(array('route' => array('penjualan.update.sederhana',$penjualan->id_penjualan), 'method' => 'PUT', 'class' => 'form form-horizontal', 'autocomplete' => 'off')) }}
					@else
					{{ Form::open(array('route' => 'penjualan.store.sederhana', 'class' => 'form form-horizontal', 'autocomplete' => 'off')) }}
					@endif

					@if(isset($draft_penjualan))
					<input type="hidden" name="id_draft" id="id_draft" value="{{$data_draft->id_draft}}">
					@endif

					@if(isset($nota_pengganti) && $nota_pengganti == true)
					<input type="hidden" name="is_nota_pengganti" value="true">
					<input type="hidden" name="old_id_penjualan" value="{{$penjualan->id_penjualan}}">
					@endif
					<div class="row">
						@if(isset($penjualan))
						<div class="col-lg-4">
							<div class="form-group">
								{{ Form::label('no_nota', 'Nomor Nota', array('class' => 'col-lg-6 control-label')) }}
								<div class="col-lg-6">
									{{ Form::text('no_nota', $penjualan->no_nota, array('class' => 'form-control', 'id' => 'no_nota', 'readonly' => 'true')) }}
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-lg-offset-2">
						@else
						<div class="col-lg-6 col-lg-offset-6">
						@endif
							<div class="form-group">
								{{ Form::label('tanggal', 'Surabaya ,', array('class' => 'col-lg-6 control-label')) }}
								<div class="col-lg-6">
									@if(isset($penjualan))
										{{ Form::text('tanggal', $penjualan->tanggal, array('class' => 'datePicker form-control', 'id' => 'tanggal', 'required' => 'required')) }}
									@else
										{{ Form::text('tanggal', null, array('class' => 'datePicker form-control', 'id' => 'tanggal', 'required' => 'required')) }}
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<!-- nehi here -->
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('customer', 'Tuan/Toko', array('class' => 'col-lg-3 control-label')) }}
								<div class="col-lg-9">
									{{ Form::text('customer', 'CASH', array('class' => 'form-control', 'id' => 'customer', 'readonly' => 'readonly')) }}
								</div>
							</div>
						</div>
					</div>

					<button type="button" class="btn btn-primary m-b" data-bs-toggle="modal" id="addBarang">Tambah Barang</button>
					<div>
						<table cellpadding="1" cellspacing="1" class="table table-striped">
							<thead>
								<tr>
									<th width="30%">Nama Barang</th>
									<th width="10%">Merk</th>
									<th width="5%">Banyak</th>
									<th width="10%">Harga Satuan</th>
									<th width="10%">Jumlah</th>
									<th width="5%">Action</th>
								</tr>
							</thead>
                            <tbody id="list_barang">
                                @if(!isset($penjualan) && !Session::has('nama_barang') && !isset($draft_penjualan))
                                <tr id='entry-0'>
                                    <input type="hidden" value="0" id="row">
                                    <td><input id='nama_barang-0' class='form-control' type='text' name='nama_barang[]'></td>
                                    <td><input id='merk_barang-0' class='form-control' type='text' name='merk_barang[]'></td>
                                    <td><input id='jumlah_barang-0' class='jumlah form-control' type='text' name='jumlah_barang[]'></td>
                                    <td><input id='harga_barang-0'  class='harga form-control' type='text' name='harga_barang[]'></td>
                                    <td><input id='total_harga-0'  class='total form-control' type='text' readonly name='total_harga[]'></td>
                                    <td><a href='#' class='text-danger' onclick='removeBarang(0)'>Hapus</a></td>
                                </tr>
                                @endif

                                @php
                                    $items = Session::has('nama_barang') ? Session::get('nama_barang') : (isset($penjualan) || isset($draft_penjualan) ? $penjualan_item : []);
                                    $countbarang = count($items);
                                @endphp

                                @foreach($items as $i => $item)
                                <tr id='entry-{{ $i }}'>
                                    <input type="hidden" value="{{ $i }}" id="row">
                                    <td><input id='nama_barang-{{ $i }}' value='{{ $item->nama ?? $item }}' class='nama form-control' type='text' @if(!isset($draft_penjualan)) readonly @endif name='nama_barang[]'></td>
                                    <td><input id='merk_barang-{{ $i }}' value='{{ $item->merk ?? $merk_barang[$i] ?? '' }}' class='merk form-control' type='text' @if(!isset($draft_penjualan)) readonly @endif name='merk_barang[]'></td>
                                    <td><input id='jumlah_barang-{{ $i }}' value='{{ $item->jumlah ?? $jumlah_barang[$i] ?? '' }}' class='jumlah form-control' type='text' @if(!isset($draft_penjualan)) readonly @endif name='jumlah_barang[]'></td>
                                    <td><input id='harga_barang-{{ $i }}'  value='{{ $item->harga ?? $harga_barang[$i] ?? '' }}' class='harga form-control' type='text' @if(!isset($draft_penjualan)) readonly @endif name='harga_barang[]'></td>
                                    <td><input id='total_harga-{{ $i }}'   value='{{ $item->total ?? $total_harga[$i] ?? '' }}' class='total form-control' type='text' readonly name='total_harga[]'></td>
                                    <td><a href='#' class='delete_barang text-danger' onclick='removeBarang({{ $i }})'>Hapus</a></td>
                                </tr>
                                @endforeach

                                <input id="shadow_count" type="hidden" value="{{ $countbarang }}">
                            </tbody>
						</table>
					</div>

					<div class="hr-line-dashed"></div>
					<div class="row">
						<div class="col-lg-6 col-lg-offset-6">
							<div class="form-group">
								{{ Form::label('grand_total', 'Total', array('class' => 'col-lg-3 control-label')) }}
								<div class="col-lg-9">
									@if(isset($penjualan))
									{{ Form::text('grand_total', $penjualan->grand_total, array('class' => 'form-control', 'id' => 'grand_total', 'readonly' => 'true')) }}
									@else
									{{ Form::text('grand_total', null, array('class' => 'form-control', 'id' => 'grand_total', 'readonly' => 'true')) }}
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="form-group">
						<div class="col-lg-12 text-center">
							@if(isset($nota_pengganti) && $nota_pengganti == true)
							<button class="btn btn-success" type="submit" id="simpanPengganti">Simpan Nota Pengganti</button>
							@else
							<button class="btn btn-success" type="submit" id="simpanPenjualan">Simpan Nota Sederhana</button>
							<button class="btn btn-warning" type="button" id="batalPerubahan">Batal Perubahan</button>
							@endif
							{{ Form::close() }}
						</div>
					</div>

					<div class="col-lg-12 text-center">
						@if(!isset($nota_pengganti))
							@if(isset($penjualan) && $penjualan->status != "batal")
							<button class="btn btn-info" id="editPenjualan">Ubah Nota Sederhana</button>
							<a href="{{ route('penjualan.print.sederhana', $penjualan->id_penjualan) }}" target="_blank" class="btn btn-primary" id="printPenjualan">Print Nota Sederhana</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="{{ route('penjualan.pengganti.sederhana', $penjualan->id_penjualan) }}" class="btn btn-warning" id="notaPengganti">Buat Nota Pengganti</a>
							<a href="#BatalPenjualan" class="btn btn-danger" id="batalPenjualanSederhana" data-bs-toggle="modal">Batal Nota Sederhana</a>
							<a href="#NotaLanjutanModal" class="btn btn-warning" id="NotaLanjutan" data-bs-toggle="modal">Buat Nota Lanjutan</a>

							@if( Gate::check('admin-blank-role') && isset($penjualan) && $penjualan->old_id_penjualan != null )
							<a href="#HapusNotaPenggantiModal" class="btn btn-danger" id="HapusNotaPengganti" data-bs-toggle="modal">Hapus Nota Pengganti</a>
							@endif

							@elseif(isset($penjualan) && $penjualan->status == "batal")
							<h2 style="color:red"> Nota ini Telah Dibatalkan </h2>
							@else
							@endif
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('script')
<script>
	var count_row = $('#shadow_count').val();

	$(".form").bind("keypress", function (e) {
        if (e.keyCode == 13) {
            e.preventDefault()
        }
    });

    @if(isset($draft_penjualan))
    	calculateGrandTotal();
    @endif

	////////////////////////////////////////////////////////////////////
	//INITIALIZE BLOODHOUND
	////////////////////////////////////////////////////////////////////

	//Barang
	var suggest2 = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,

		remote: {
			url: '{{ route('barang.search.nama') }}#%QUERY',
			wildcard: '%QUERY',
			transport: function (opts, onSuccess, onError) {
				var url = opts.url.split("#")[0];
				var query = opts.url.split("#")[1];
				$.ajax({
					url: url,
					data: "search=" + query,
					type: "POST",
					success: onSuccess,
					error: onError,
				})
			}
		}
	});
	////////////////////////////////////////////////////////////////////

	@if(Session::has('nama_barang') || isset($nota_pengganti))
		$('#tanggal').attr('readonly', false);
		$('#notaPengganti').css('display', 'none');

		$('#editPenjualan').css('display', 'none');
		$('#printPenjualan').css('display', 'none');
		$('#batalPenjualanSederhana').css('display', 'none');
		$('#HapusNotaPengganti').css('display', 'none');
		$('#NotaLanjutan').css('display', 'none');
		$('#simpanPenjualan').css('display', 'inline');
		$('#addBarang').css('display', 'block');
		$('.delete_barang').css('display', 'block');

		@if(!isset($penjualan))
			$('#batalPerubahan').css('display', 'none');
		@endif

		$('.nama').attr('readonly', false);
		$('.jumlah').attr('readonly', false);
		$('.harga').attr('readonly', false);
		$('.merk').attr('readonly', false);

		for (i=0; i < count_row; i++) {
			$('#nama_barang-'+i).typeahead({
				minLength: 1
			},{
				name: 'value',
				display: 'nama_barang',
				limit: 10,
				source: suggest2,
				templates: {
			        suggestion: function (suggest2) {
			            return '<p>' + suggest2.show + '</p>';
			        }
			    }
			}).bind('typeahead:select', function(ev, suggestion) {
				var row = $(this).closest('tr').find('#row').val();
				//$(this).closest('tr').find('#kode_barang-'+row).val(suggestion.kode);
				//$(this).closest('tr').find('#merk_barang-'+row).val(suggestion.merk);
			});
		}
	@else
		@if(isset($penjualan))
			$('#tanggal').attr('readonly', true);
			$('#addBarang').css('display', 'none');
			$('.delete_barang').css('display', 'none');
			$('#simpanPenjualan').css('display', 'none');
			$('#batalPerubahan').css('display', 'none');
		@else
			@if(Auth::user()->is_superadmin == true)
				$('#tanggal').attr('readonly', false);
			@else
				$('#tanggal').attr('readonly', true);
			@endif
			//$('#tanggal').attr('readonly', false);

			$('#editPenjualan').css('display', 'none');
			$('#printPenjualan').css('display', 'none');
			$('#batalPenjualanSederhana').css('display', 'none');
			$('#HapusNotaPengganti').css('display', 'none');
			$('#NotaLanjutan').css('display', 'none');
			$('#batalPerubahan').css('display', 'none');
		@endif
	@endif

	$('#batalPerubahan').click(function (e) {
		location.reload(true);
	});

	$('#editPenjualan').click(function (e) {
		//$('#tanggal').attr('readonly', false);
		//jika yang edit adalah superadmin
		@if(Auth::user()->is_superadmin == true)
			$('#tanggal').attr('readonly', false);
		@endif

		$('#notaPengganti').css('display', 'none');

		$('#editPenjualan').css('display', 'none');
		$('#printPenjualan').css('display', 'none');
		$('#batalPenjualanSederhana').css('display', 'none');
		$('#HapusNotaPengganti').css('display', 'none');
		$('#NotaLanjutan').css('display', 'none');
		$('#simpanPenjualan').css('display', 'inline');
		$('#addBarang').css('display', 'block');
		$('.delete_barang').css('display', 'block');
		$('#batalPerubahan').css('display', 'inline');

		$('.nama').attr('readonly', false);
		$('.jumlah').attr('readonly', false);
		$('.harga').attr('readonly', false);
		$('.merk').attr('readonly', false);

		var count_penjualan = 0;
		@if(isset($penjualan_item))
			@foreach($penjualan_item as $pi)
				$('#nama_barang-'+count_penjualan).typeahead({
					minLength: 1
				},{
					name: 'value',
					display: 'nama_barang',
					limit: 10,
					source: suggest2,
					templates: {
				        suggestion: function (suggest2) {
				            return '<p>' + suggest2.show + '</p>';
				        }
				    }
				}).bind('typeahead:select', function(ev, suggestion) {
					var row = $(this).closest('tr').find('#row').val();
					//$(this).closest('tr').find('#kode_barang-'+row).val(suggestion.kode);
					//$(this).closest('tr').find('#merk_barang-'+row).val(suggestion.merk);
				});
				count_penjualan++;
			@endforeach
		@endif
	});

	function addDecimalPoints(id) {
        var inputElement = document.getElementById(id);
        //inputElement.value=inputElement.value.replace(/\D/g, '');

        var split_comma = inputElement.value.split(",");
        var inputValue = split_comma[0].replace('.', '').split("").reverse().join(""); // reverse
        var newValue = '';

        for (var i = 0; i < inputValue.length; i++) {
        	if (i % 3 == 0 && i >= 3) {
        		newValue += '.';
        	}
            newValue += inputValue[i];
        }

        var final_result = newValue.split("").reverse().join("");

        //jika ada comma2
        if(split_comma[1] != null) {
        	final_result += ',';
	        final_result += split_comma[1];
        }
        inputElement.value = final_result;

    }


	//funtion lama
	// function addDecimalPoints(id) {
 //        var inputElement = document.getElementById(id);
 //        inputElement.value=inputElement.value.replace(/\D/g, '');
 //        var inputValue = inputElement.value.replace('.', '').split("").reverse().join(""); // reverse
 //        var newValue = '';
 //        for (var i = 0; i < inputValue.length; i++) {
 //            if (i % 3 == 0 && i >= 3) {
 //                newValue += '.';
 //            }
 //            newValue += inputValue[i];
 //        }
 //        inputElement.value = newValue.split("").reverse().join("");
 //    }

	$(".jumlah").keyup(function(){
		calculateHarga($(this));
	});

	$(".harga").keyup(function(){
		calculateHarga($(this));
	});

	function calculateHarga(row) {
		//get count
		var table_id = row.closest('tr').attr('id');
		var values = table_id.split('-');
		var entry = values[1];

		//addDecimalPoints('harga_barang-'+entry);

		//get harga total
		var harga = $('#harga_barang-'+entry).val().replace(/\./g, '');

		//temp function to calculate
		harga = harga.replace(',', '.')*1000;

		var jumlah = $('#jumlah_barang-'+entry).val();
		var total = harga*jumlah/1000;
		total = total.toFixed(2);

		//set harga ke dalam field total
		$('#total_harga-'+entry).val(total);

		//also temp solution
		var temp = $('#total_harga-'+entry).val().replace('.', ',');
		$('#total_harga-'+entry).val(temp);

		addDecimalPoints('total_harga-'+entry);
		calculateGrandTotal();
	}


	function calculateGrandTotal(){
		//get grand total
		var grand_total = 0;
		$(".total").each(function() {

			//temp data
			var temp = $(this).val().replace(/\./g, '');
			var temp2 = temp.replace(',', '.')*1;


			grand_total = (grand_total*1000)+(temp2*1000);
			grand_total = grand_total/1000;

		}).get();

		grand_total = grand_total.toFixed(2);

		//set sub_total
		$("#grand_total").val(grand_total);

		//also temp solution
		var temp = $('#grand_total').val().replace('.', ',');
		$('#grand_total').val(temp);

		addDecimalPoints('grand_total');
	}

	function removeBarang(id) {
		$("#entry-"+id).remove();
		calculateGrandTotal();
	}

	$('#addBarang').click(function (e) {
		$('#list_barang').append(
			"<tr id='entry-"+count_row+"'>"+
				"<input type='hidden' value='"+count_row+"' id='row'>"+
				"<td><input id='nama_barang-"+count_row+"' class='form-control' type='text' name='nama_barang[]'></td>"+
				"<td><input id='merk_barang-"+count_row+"' class='form-control' type='text' name='merk_barang[]'></td>"+
				"<td><input id='jumlah_barang-"+count_row+"' class='jumlah form-control' type='text' name='jumlah_barang[]'></td>"+
				"<td><input id='harga_barang-"+count_row+"' class='harga form-control' type='text' name='harga_barang[]'></td>"+
				"<td><input id='total_harga-"+count_row+"' class='total form-control' type='text' readonly name='total_harga[]'></td>"+
				"<td><a href='#' class='text-danger' onclick='removeBarang("+count_row+")'>Hapus</a></td>"+
			"</tr>"
		);

		$(".jumlah").keyup(function(){
			calculateHarga($(this));
		});

		$(".harga").keyup(function(){
			calculateHarga($(this));
		});

		$('#nama_barang-'+count_row).typeahead({
			minLength: 1
		},{
			name: 'value',
			display: 'nama_barang',
			limit: 10,
			source: suggest2,
			templates: {
		        suggestion: function (suggest2) {
		            return '<p>' + suggest2.show + '</p>';
		        }
		    }
		}).bind('typeahead:select', function(ev, suggestion) {
			var row = $(this).closest('tr').find('#row').val();
			//$(this).closest('tr').find('#kode_barang-'+row).val(suggestion.kode);
			//$(this).closest('tr').find('#merk_barang-'+row).val(suggestion.merk);
		});

		//for new row
		count_row++;
	});

	@if(!isset($penjualan))
		$('#nama_barang-0').typeahead({
			minLength: 1
		},{
			name: 'value',
			display: 'nama_barang',
			limit: 10,
			source: suggest2,
			templates: {
		        suggestion: function (suggest2) {
		            return '<p>' + suggest2.show + '</p>';
		        }
		    }
		}).bind('typeahead:select', function(ev, suggestion) {
			//$(this).closest('tr').find('#kode_barang-0').val(suggestion.kode);
			//$(this).closest('tr').find('#merk_barang-0').val(suggestion.merk);
		});
	@endif

	$(function () {
		var tgl = $('#tanggal').val();
		if (tgl !== '') {
			tgl = new Date(tgl);
		} else {
			tgl = new Date();
		}
		$('.datePicker').datetimepicker({
			date: tgl,
			format: 'dddd, DD MMMM YYYY',
			widgetPositioning: ({
				vertical: 'bottom'
			})
		});
	});

</script>
@stop
