@extends('layouts.master')

@section('navigation')
	@include('layouts.navigation')
@stop

@section('content')

@if(isset($nota_pengganti) && $nota_pengganti == true)
@include('components.page.header', [
	'extra' => 'Penjualan:',
	'title' => 'Nota Pengganti Kena Pajak',
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
		'title' => 'Nota Kena Pajak (Pengganti)',
	])
	@else
	@include('components.page.header', [
		'extra' => 'Penjualan:',
		'title' => 'Nota Kena Pajak',
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
				{{ Form::open(array('route' => 'penjualan.batal.pajak', 'method' => 'PUT', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
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
				{{ Form::open(array('route' => 'penjualan.lanjutan.pajak', 'method' => 'PUT', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
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
					{{ Form::open(array('route' => array('penjualan.update.pajak', $penjualan->id_penjualan), 'method' => 'PUT', 'class' => 'form form-horizontal', 'autocomplete' => 'off')) }}
					@else
					{{ Form::open(array('route' => 'penjualan.store.pajak', 'class' => 'form form-horizontal', 'autocomplete' => 'off')) }}
					@endif

					@if(isset($draft_penjualan))
					<input type="hidden" name="id_draft" id="id_draft" value="{{$data_draft->id_draft}}">
					@endif

					<input type="hidden" name="bebas_pajak" id="bebas_pajak" value="0">

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
									@if(isset($penjualan))
										{{ Form::text('customer', $penjualan->nama_customer, array('class' => 'form-control', 'id' => 'customer', 'readonly' => 'true')) }}
									@else
										{{ Form::text('customer', '', array('class' => 'form-control', 'id' => 'customer')) }}
									@endif
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									@if(isset($penjualan))
										{{ Form::text('alamat', $penjualan->alamat_customer, array('class' => 'form-control', 'placeholder' => 'Alamat', 'id' => 'alamat', 'readonly' => 'readonly')) }}
									@else
										{{ Form::text('alamat', '', array('class' => 'form-control', 'placeholder' => 'Alamat', 'id' => 'alamat', 'readonly' => 'readonly')) }}
									@endif
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									@if(isset($penjualan))
										{{ Form::text('npwp', $penjualan->npwp_customer, array('class' => 'form-control', 'placeholder' => 'NPWP', 'id' => 'npwp', 'readonly' => 'readonly')) }}
									@else
										{{ Form::text('npwp', '', array('class' => 'form-control', 'placeholder' => 'NPWP', 'id' => 'npwp', 'readonly' => 'readonly')) }}
									@endif
								</div>
							</div>
						</div>


						@if(Session::has('nama_barang'))
							<input type="hidden" id="id_customer" name="id_customer" value="{{Input::old('id_customer')}}" type="text">
						@elseif(isset($penjualan))
							<input type="hidden" id="id_customer" name="id_customer" value="{{$penjualan->id_customer}}" type="text">
						@else
							<input type="hidden" id="id_customer" name="id_customer" type="text">
						@endif
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

                                @if(Session::has('nama_barang'))
                                @foreach(Session::get('nama_barang') as $i => $nama_barang)
                                <tr id='entry-{{ $i }}'>
                                    <input type="hidden" value="{{ $i }}" id="row">
                                    <td><input id='nama_barang-{{ $i }}' value='{{ $nama_barang }}' class='nama form-control' type='text' readonly name='nama_barang[]'></td>
                                    <td><input id='merk_barang-{{ $i }}' value='{{ Session::get('merk_barang')[$i] }}' class='merk form-control' type='text' readonly name='merk_barang[]'></td>
                                    <td><input id='jumlah_barang-{{ $i }}' value='{{ Session::get('jumlah_barang')[$i] }}' class='jumlah form-control' type='text' readonly name='jumlah_barang[]'></td>
                                    <td><input id='harga_barang-{{ $i }}'  value='{{ Session::get('harga_barang')[$i] }}' class='harga form-control' type='text' readonly name='harga_barang[]'></td>
                                    <td><input id='total_harga-{{ $i }}'   value='{{ Session::get('total_harga')[$i] }}' class='total form-control' type='text' readonly name='total_harga[]'></td>
                                    <td><a href='#' class='delete_barang text-danger' onclick='removeBarang({{ $i }})'>Hapus</a></td>
                                </tr>
                                @endforeach

                                @elseif(isset($penjualan) || isset($draft_penjualan))
                                @foreach($penjualan_item as $i => $pi)
                                <tr id='entry-{{ $i }}'>
                                    <input type="hidden" value="{{ $i }}" id="row">
                                    <td><input id='nama_barang-{{ $i }}' value='{{ $pi->nama }}' class='nama form-control' type='text' @if(!isset($draft_penjualan)) readonly @endif name='nama_barang[]'></td>
                                    <td><input id='merk_barang-{{ $i }}' value='{{ $pi->merk }}' class='merk form-control' type='text' @if(!isset($draft_penjualan)) readonly @endif name='merk_barang[]'></td>
                                    <td><input id='jumlah_barang-{{ $i }}' value='{{ $pi->jumlah }}' class='jumlah form-control' type='text' @if(!isset($draft_penjualan)) readonly @endif name='jumlah_barang[]'></td>
                                    <td><input id='harga_barang-{{ $i }}'  value='{{ $pi->harga }}' class='harga form-control' type='text' @if(!isset($draft_penjualan)) readonly @endif name='harga_barang[]'></td>
                                    <td><input id='total_harga-{{ $i }}'   value='{{ $pi->total }}' class='total form-control' type='text' readonly name='total_harga[]'></td>
                                    <td><a href='#' class='delete_barang text-danger' onclick='removeBarang({{ $i }})'>Hapus</a></td>
                                </tr>
                                @endforeach
                                @endif
                                <input id="shadow_count" type="hidden" value="{{ isset($countbarang) ? $countbarang : 1 }}">
                            </tbody>
						</table>
					</div>

					<div class="hr-line-dashed"></div>
					<div class="row">
						<div class="col-lg-6 col-lg-offset-6">
							<div class="form-group">
								{{ Form::label('sub_total', 'Sub Total', array('class' => 'col-lg-3 control-label')) }}
								<div class="col-lg-9">
									@if(isset($penjualan))
									{{ Form::text('sub_total', $penjualan->sub_total, array('class' => 'form-control', 'id' => 'sub_total', 'readonly' => 'true')) }}
									@else
									{{ Form::text('sub_total', null, array('class' => 'form-control', 'id' => 'sub_total', 'readonly' => 'true')) }}
									@endif
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-lg-offset-6">
							<div class="form-group">
								{{ Form::label('diskon_persen', 'Diskon', array('class' => 'col-lg-3 control-label')) }}
								<div class="col-lg-2">
									@if(isset($penjualan))
									{{ Form::text('diskon_persen', $penjualan->diskon_persen, array('class' => 'form-control', 'id' => 'diskon_persen', 'readonly' => 'true')) }}
									@else
									{{ Form::text('diskon_persen', null, array('class' => 'form-control', 'id' => 'diskon_persen')) }}
									@endif
								</div>
								<div class="col-lg-1">
									{{ Form::label('%', '%', array('class' => 'control-label')) }}
								</div>
								<div class="col-lg-6">
									@if(isset($penjualan))
									{{ Form::text('diskon_rupiah', $penjualan->diskon_rupiah, array('class' => 'form-control', 'id' => 'diskon_rupiah', 'readonly' => 'true')) }}
									@else
									{{ Form::text('diskon_rupiah', null, array('class' => 'form-control', 'id' => 'diskon_rupiah', 'readonly' => 'true')) }}
									@endif
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-lg-offset-6">
							<div class="form-group">
								{{ Form::label('dpp', 'DPP', array('class' => 'col-lg-3 control-label')) }}
								<div class="col-lg-9">
									@if(isset($penjualan))
									{{ Form::text('dpp', $penjualan->dpp, array('class' => 'form-control', 'id' => 'dpp', 'readonly' => 'true')) }}
									@else
									{{ Form::text('dpp', null, array('class' => 'form-control', 'id' => 'dpp', 'readonly' => 'true')) }}
									@endif
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-lg-offset-6">
							<div class="form-group">
								@if(isset($penjualan))
								@php $ppn = floatval($penjualan->ppn) * 100 / floatval($penjualan->dpp); @endphp
								@else
								@php $ppn = $master->ppn_persen @endphp
								@endif
								{{ Form::label('ppn', $ppn . '% PPN', array('class' => 'col-lg-3 control-label')) }}
								<div class="col-lg-9">
									@if(isset($penjualan))
									{{ Form::text('ppn', $penjualan->ppn, array('class' => 'form-control', 'id' => 'ppn', 'readonly' => 'true')) }}
									@else
									{{ Form::text('ppn', null, array('class' => 'form-control', 'id' => 'ppn', 'readonly' => 'true')) }}
									@endif
								</div>
							</div>
						</div>
					</div>

					<div class="hr-line-dashed"></div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('no_po', 'Nomor PO', array('class' => 'col-lg-3 control-label')) }}
								<div class="col-lg-9">
									@if(isset($penjualan))
									{{ Form::text('no_po', $penjualan->no_po, array('class' => 'form-control', 'id' => 'no_po', 'readonly' => 'true')) }}
									@elseif(isset($draft_penjualan))
									{{ Form::text('no_po', $data_draft->no_po, array('class' => 'form-control', 'id' => 'no_po', 'readonly' => 'true')) }}
									@else
									{{ Form::text('no_po', null, array('class' => 'form-control', 'id' => 'no_po')) }}
									@endif
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('grand_total', 'Grand Total', array('class' => 'col-lg-3 control-label')) }}
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
							<button class="btn btn-success" type="submit" id="simpanPenjualan">Simpan Nota Pajak</button>
							<button class="btn btn-warning" type="button" id="batalPerubahan">Batal Perubahan</button>
							@endif
							{{ Form::close() }}
						</div>
					</div>

					<div class="col-lg-12 text-center">
						@if(!isset($nota_pengganti))
							@if(isset($penjualan) && $penjualan->status != "batal")
							<button class="btn btn-info" id="editPenjualan">Ubah Nota Pajak</button>
							<a href="{{ route('penjualan.print.suratjalan', $penjualan->id_penjualan) }}" target="_blank" class="btn btn-primary" id="printSuratJalan">Print Surat Jalan</a>
							<a href="{{ route('penjualan.print.pajak', $penjualan->id_penjualan) }}" target="_blank" class="btn btn-primary" id="printPenjualan">Print Nota Pajak</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="{{ route('penjualan.pengganti.pajak', $penjualan->id_penjualan) }}" class="btn btn-warning" id="notaPengganti">Buat Nota Pengganti</a>
							<a href="#BatalPenjualan" class="btn btn-danger" id="batalPenjualanKenaPAjak" data-bs-toggle="modal">Batal Nota Kena Pajak</a>
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
	//Barang
	var suggest3 = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,

		remote: {
			url: '{{ route('customer.search') }}#%QUERY',
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
		$('#diskon_persen').attr('readonly', false);
		$('#no_po').attr('readonly', false);
		$('#tanggal').attr('readonly', true);
		$('#notaPengganti').css('display', 'none');

		$('#editPenjualan').css('display', 'none');
		$('#printPenjualan').css('display', 'none');
		$('#printSuratJalan').css('display', 'none');
		$('#batalPenjualanKenaPAjak').css('display', 'none');
		$('#HapusNotaPengganti').css('display', 'none');
		$('#NotaLanjutan').css('display', 'none');
		$('#simpanPenjualan').css('display', 'inline');
		$('#addBarang').css('display', 'block');
		$('.delete_barang').css('display', 'block');

		@if(isset($nota_pengganti) && $nota_pengganti == true)
			$('#alamat').attr('readonly', false);
			$('#customer').attr('readonly', false);
		@endif

		@if(!isset($nota_pengganti) && !isset($penjualan))
			$('#tanggal').attr('readonly', false);
			$('#customer').attr('readonly', false);
		@endif

		@if(!isset($penjualan))
			$('#batalPerubahan').css('display', 'none');
		@endif

		$('.nama').attr('readonly', false);
		$('.jumlah').attr('readonly', false);
		$('.harga').attr('readonly', false);
		$('.merk').attr('readonly', false);

		@if(!isset($nota_pengganti) || $nota_pengganti != true)
		@endif

		$('#customer').typeahead({
			minLength: 1
		},{
			name: 'value',
			display: 'nama',
			limit: 10,
			source: suggest3,
			templates: {
				suggestion: function (suggest3) {
					return '<p>' + suggest3.show + '</p>';
				}
			}
		}).bind('typeahead:select', function(ev, suggestion) {
			$('#bebas_pajak').val(suggestion.bebas_pajak);
			$('#customer').val(suggestion.nama);
			$('#alamat').val(suggestion.alamat);
			$('#npwp').val(suggestion.npwp);
			$('#id_customer').val(suggestion.id_customer);
			calculateGrandTotal();
		});

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
			$('#diskon_persen').attr('readonly', true);
			$('#customer').attr('readonly', true);
			$('#no_po').attr('readonly', true);
			$('#addBarang').css('display', 'none');
			$('.delete_barang').css('display', 'none');
			$('#simpanPenjualan').css('display', 'none');
			$('#batalPerubahan').css('display', 'none');
		@else
			$('#diskon_persen').attr('readonly', false);
			$('#customer').attr('readonly', false);
			$('#no_po').attr('readonly', false);

			@if(Auth::user()->is_superadmin == true)
				$('#tanggal').attr('readonly', false);
			@else
				$('#tanggal').attr('readonly', true);
			@endif
			//$('#tanggal').attr('readonly', false);

			$('#editPenjualan').css('display', 'none');
			$('#printPenjualan').css('display', 'none');
			$('#printSuratJalan').css('display', 'none');
			$('#batalPenjualanKenaPAjak').css('display', 'none');
			$('#HapusNotaPengganti').css('display', 'none');
			$('#NotaLanjutan').css('display', 'none');
			$('#batalPerubahan').css('display', 'none');
		@endif
	@endif

	$('#batalPerubahan').click(function (e) {
		location.reload(true);
	});

	$('#editPenjualan').click(function (e) {
		//jika yang edit adalah superadmin
		@if(Auth::user()->is_superadmin == true)
			$('#tanggal').attr('readonly', false);
		@endif

		$('#diskon_persen').attr('readonly', false);
		$('#customer').attr('readonly', false);
		$('#alamat').attr('readonly', false);
		$('#npwp').attr('readonly', false);

		$('#no_po').attr('readonly', false);

		$('#editPenjualan').css('display', 'none');
		$('#printPenjualan').css('display', 'none');
		$('#printSuratJalan').css('display', 'none');
		$('#notaPengganti').css('display', 'none');
		$('#batalPenjualanKenaPAjak').css('display', 'none');
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

		$('#customer').typeahead({
			minLength: 1
		},{
			name: 'value',
			display: 'nama',
			limit: 10,
			source: suggest3,
			templates: {
				suggestion: function (suggest3) {
					return '<p>' + suggest3.show + '</p>';
				}
			}
		}).bind('typeahead:select', function(ev, suggestion) {
			$('#bebas_pajak').val(suggestion.bebas_pajak);
			$('#customer').val(suggestion.nama);
			$('#alamat').val(suggestion.alamat);
			$('#npwp').val(suggestion.npwp);
			$('#id_customer').val(suggestion.id_customer);
			calculateGrandTotal();
		});

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

	function addDecimalPointsForSatuan(id) {
        var inputElement = document.getElementById(id);
        inputElement.value=inputElement.value.replace(/\D/g, '');

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
        inputElement.value = final_result;
    }

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

	// function addDecimalPoints(id) {
 //        var inputElement = document.getElementById(id);
 //        inputElement.value=inputElement.value.replace(/\D/g, '');

 //        var split_comma = inputElement.value.split(",");
 //        var inputValue = split_comma[0].replace('.', '').split("").reverse().join(""); // reverse
 //        var newValue = '';

 //        for (var i = 0; i < inputValue.length; i++) {
 //        	if (i % 3 == 0 && i >= 3) {
 //        		newValue += '.';
 //        	}
 //            newValue += inputValue[i];
 //        }

 //        var final_result = newValue.split("").reverse().join("");

 //        inputElement.value = final_result;

 //        //jika ada comma2
 //        // if(split_comma[1] != null) {
 //        // 	final_result += ',';
	//        //  final_result += split_comma[1];
 //        // }
 //        // inputElement.value = final_result;
 //        // console.log(final_result);

 //    }

	$(".jumlah").keyup(function(){
		calculateHarga($(this));
	});

	$(".harga").keyup(function(){
		calculateHarga($(this));
	});

	$("#diskon_persen").keyup(function(){
		calculateGrandTotal();
	});

	function calculateHarga(row) {
		//get count
		var table_id = row.closest('tr').attr('id');
		var values = table_id.split('-');
		var entry = values[1];

		addDecimalPointsForSatuan('harga_barang-'+entry);

		//get harga total
		var harga = $('#harga_barang-'+entry).val().replace(/\./g, '');

		//temp function to calculate
		harga = harga.replace(',', '.');

		var jumlah = $('#jumlah_barang-'+entry).val();
		var total = harga*jumlah;
		//total = total.toFixed(2);

		//set harga ke dalam field total
		$('#total_harga-'+entry).val(total);
		addDecimalPoints('total_harga-'+entry);

		calculateGrandTotal();
	}


	function calculateGrandTotal(){
		const master_ppn = @php echo $master->ppn_persen; @endphp;

		//get and set sub total
		var sub_total = 0;
		$(".total").each(function() {
			//sub_total = sub_total+$(this).val().replace(/\./g, '')*1;

			//temp data
			var temp = $(this).val().replace(/\./g, '');
			var temp2 = temp.replace(',', '.')*1;


			sub_total = (sub_total*1000)+(temp2*1000);
			sub_total = sub_total/1000;

		}).get();

		$("#sub_total").val(sub_total);
		var temp = $("#sub_total").val().replace('.', ',');
		$("#sub_total").val(temp);
		addDecimalPoints('sub_total');

		//get and set diskon
		var diskon_persen = $("#diskon_persen").val();
		var diskon_rupiah = sub_total*diskon_persen/100;

		diskon_rupiah = diskon_rupiah.toFixed(2);

		$("#diskon_rupiah").val(diskon_rupiah);
		var temp = $("#diskon_rupiah").val().replace('.', ',');
		$("#diskon_rupiah").val(temp);
		addDecimalPoints('diskon_rupiah');

		//get and set ppn
		var dpp = sub_total-diskon_rupiah;

		dpp = dpp.toFixed(2);

		$("#dpp").val(dpp);
		var temp = $("#dpp").val().replace('.', ',');
		$("#dpp").val(temp);
		addDecimalPoints('dpp');

		//check ppn type
		var bebas_pajak = $("#bebas_pajak").val();
		//set ppn
		if(bebas_pajak == null || bebas_pajak == 0) {
			var ppn = dpp * master_ppn / 100;
		} else {
			var ppn = 0;
		}

		//set ppn
		ppn = ppn.toFixed(2);
		$("#ppn").val(ppn);
		var temp = $("#ppn").val().replace('.', ',');
		$("#ppn").val(temp);
		addDecimalPoints('ppn');

		//get and set grand total
		var grand_total = dpp*1+ppn*1;

		grand_total = grand_total.toFixed(2);

		$("#grand_total").val(grand_total);
		var temp = $("#grand_total").val().replace('.', ',');
		$("#grand_total").val(temp);
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

		//typeahead on new item
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

		$('#customer').typeahead({
			minLength: 1
		},{
			name: 'value',
			display: 'nama',
			limit: 10,
			source: suggest3,
			templates: {
				suggestion: function (suggest3) {
					return '<p>' + suggest3.show + '</p>';
				}
			}
		}).bind('typeahead:select', function(ev, suggestion) {
			$('#bebas_pajak').val(suggestion.bebas_pajak);
			$('#customer').val(suggestion.nama);
			$('#alamat').val(suggestion.alamat);
			$('#npwp').val(suggestion.npwp);
			$('#id_customer').val(suggestion.id_customer);
			calculateGrandTotal();
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
