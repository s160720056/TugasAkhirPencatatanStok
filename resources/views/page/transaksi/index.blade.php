@extends('layouts.app', ['menu' => 'transaksi'])
@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <h4 class="mb-5">Transaksi</h4>
        <div class="widget-content widget-content-area br-6">
            <button type="button" class="btn btn-primary add-button" data-toggle="modal" data-target="#addTransaksi">
                Tambah Transaksi
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-plus">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </button>
            <div class="table-responsive mb-4 mt-4">
                <table id="transaksi-table" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Tanggal</th>
                            <th>Barang</th>

                            <th>Keterangan</th>
                            <th>Pengeluaran</th>
                            <th>Pemasukan</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Tanggal</th>
                            <th>Barang</th>

                            <th>Keterangan</th>
                            <th>Pengeluaran</th>
                            <th>Pemasukan</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal for Edit --}}
    <div class="modal fade" id="editTransaksi" tabindex="-1" role="dialog" aria-labelledby="editTransaksiLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editTransaksiLabel">Edit Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <input type="hidden" class="form-control" id="id_transaksi" name="id_transaksi"
                            placeholder="ID Transaksi">
                    </div>
                    <div class="form-group mb-4">
                        <label for="tanggal_transaksi_edit">Tanggal Transaksi</label>
                        <input type="date" class="form-control" id="tanggal_transaksi_edit" name="tanggal_transaksi"
                            placeholder="Tanggal Transaksi">
                    </div>

                    {{-- barang --}}
                    <div class="form-group mb-4">
                        <label for="barang_edit">Barang</label><br>
                        <select class="form-control select2" id="barang_edit" name="barang" style="width:100%">
                            @foreach ($barang as $item)
                                <option value="{{ $item->id_barang }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="jumlah_barang_edit">Jumlah Barang</label>
                        <input type="number" min="1" class="form-control" id="jumlah_barang_edit"
                            placeholder="Jumlah Barang">
                    </div>

                    <div class="form-group mb-4">
                        <label for="tipe_transaksi_edit">Tipe Transaksi</label>
                        <select class="form-control select2" id="tipe_transaksi_edit" name="tipe_transaksi"
                            style="width:100%">
                            <option value="keluar">Keluar</option>
                            <option value="masuk">Masuk</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="keterangan_transaksi_edit">Keterangan Transaksi</label>
                        <input type="text" class="form-control" id="keterangan_transaksi_edit"
                            name="keterangan_transaksi" placeholder="Keterangan Transaksi">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" id="doneEdit" class="btn btn-primary">Simpan</button>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal for Add --}}
    <div class="modal fade" id="addTransaksi" tabindex="-1" role="dialog" aria-labelledby="addTransaksiLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="addTransaksiLabel">Tambah Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="tanggal_transaksi_new">Tanggal Transaksi</label>
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" id="tanggal_transaksi">
                    </div>

                    {{-- barang --}}
                    <div class="form-group mb-4">
                        <label for="barang_new">Barang</label><br>
                        <select class="form-control select2" id="barang_new" name="barang" style="width:100%">
                            @foreach ($barang as $item)
                                <option value="{{ $item->id_barang }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="jumlah_barang_new">Jumlah Barang</label>
                        <input type="number" min="1" class="form-control" id="jumlah_barang_new"
                            placeholder="Jumlah Barang">
                    </div>

                    <div class="form-group mb-4">
                        <label for="tipe_transaksis_new">Tipe Transaksi</label>
                        <select class="form-control select2" id="tipe_transaksis_new" name="tipe_transaksis"
                            style="width:100%">
                            <option value="keluar">Keluar</option>
                            <option value="masuk">Masuk</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="keterangan_transaksi_new">Keterangan Transaksi</label>
                        <input type="text" class="form-control" id="keterangan_transaksi_new"
                            name="keterangan_transaksi" placeholder="Keterangan Transaksi">
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" id="addTransaksiDone" class="btn btn-primary">Tambah</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize select2
            $(".select2").select2({
                dropdownParent: $('.modal') // Ensure dropdown appears over the modal
            });

            // DataTable initialization
            $('#transaksi-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('transaksi.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'tanggal_transaksi',
                        name: 'tanggal_transaksi'
                    },
                    {
                        data: 'barang',
                        name: 'barang'
                    },

                    {
                        data: 'keterangan_transaksi',
                        name: 'keterangan_transaksi'
                    },
                    {
                        data: 'pengeluaran',
                        name: 'pengeluaran',
                        className: 'text-danger'
                    },
                    {
                        data: 'pemasukan',
                        name: 'pemasukan',
                        className: 'text-success'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }
                ]
            });

            // Add Transaksi
            $('#addTransaksiDone').click(function() {
                var tanggal_transaksi = $('#tanggal_transaksi').val();

                var tipe_transaksi = $('#tipe_transaksi_new').val();
                var keterangan_transaksi = $('#keterangan_transaksi_new').val();
                var id_barang = $('#barang_new').val();
                var jumlah_barang = $('#jumlah_barang_new').val();

                if (!jumlah_barang || jumlah_barang <= 0) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Jumlah barang harus lebih dari 0',
                        icon: 'error'
                    });

                    return;
                }
                axiosPost("/transaksi/store", {
                        tanggal_transaksi: tanggal_transaksi,
                        tipe_transaksi: tipe_transaksi,
                        keterangan_transaksi: keterangan_transaksi,
                        id_barang: id_barang,
                        jumlah_barang: jumlah_barang
                    }).then(response => {
                        if (response.data.status == "success") {
                            Swal.fire({
                                title: "Success!",
                                text: response.data.message,
                                icon: "success",
                            }).then(() => {
                                $('#transaksi-table').DataTable().ajax.reload(null, false);
                                $('#addTransaksi').modal('hide');
                                $('#tanggal_transaksi').val('{{ date('Y-m-d') }}');
                                $('#barang_new').val('').trigger('change');
                                $('#jumlah_barang_new').val('');
                                $('#tipe_transaksis_new').val('keluar').trigger('change');
                                $('#keterangan_transaksi_new').val('');
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.data.message,
                                icon: 'error',
                                padding: '2em'
                            });
                        }
                    })
                    .catch(error => {
                        swal({
                            title: 'Error!',
                            text: response.data.message,
                            type: 'error',
                            icon: 'error',
                            padding: '2em'
                        });

                    });
            });

            // Edit Transaksi
            window.editTransaksi = function(id_transaksi) {
                axiosGet(`/transaksi/${id_transaksi}`)
                    .then(response => {
                        $('#id_transaksi').val(id_transaksi);
                        $('#tanggal_transaksi_edit').val(response.data.tanggal_transaksi);

                        $('#barang_edit').val(response.data.id_barang).trigger('change');
                        $('#tipe_transaksi_edit').val(response.data.tipe_transaksi).trigger('change');
                        $('#keterangan_transaksi_edit').val(response.data.keterangan_transaksi);
                        $('#jumlah_barang_edit').val(response.data.jumlah_barang);
                        $('#editTransaksi').modal('show');
                    })
                    .catch(error => {

                    });
            };

            $('#doneEdit').click(function() {
                var id_transaksi = $('#id_transaksi').val();
                var tanggal_transaksi = $('#tanggal_transaksi_edit').val();
                var tipe_transaksi = $('#tipe_transaksis_edit').val();
                var jumlah_barang = $('#jumlah_barang_edit').val();
                var id_barang = $('#barang_edit').val();
                var keterangan_transaksi = $('#keterangan_transaksi_edit').val();

                axiosPut("/transaksi/update/" + id_transaksi, {
                        tanggal_transaksi: tanggal_transaksi,
                        id_barang: id_barang,
                        tipe_transaksi: tipe_transaksi,
                        jumlah_barang: jumlah_barang,
                        keterangan_transaksi: keterangan_transaksi,
                    }).then(response => {
                        if (response.data.status == "success") {
                            Swal.fire({
                                title: "Success!",
                                text: "Data Berhasil Diupdate",
                                icon: "success",
                            }).then(() => {
                                $('#transaksi-table').DataTable().ajax.reload(null, false);
                                $('#editTransaksi').modal('hide');
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.data.message,
                                icon: 'error',
                                padding: '2em'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong. Please try again.',
                            icon: 'error',
                            padding: '2em'
                        });

                    });
            });

            // Delete Transaksi
            window.deleteTransaksi = function(id) {
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axiosDelete("/transaksi/delete/" + id)
                            .then(function(response) {
                                Swal.fire({
                                    title: "Success!",
                                    text: "Data Berhasil Dihapus",
                                    icon: "success",
                                }).then(() => {
                                    $('#transaksi-table').DataTable().ajax.reload(null,
                                        false);
                                });
                            })
                            .catch(function(error) {

                            });
                    }
                });
            }
        });
    </script>
@endsection
