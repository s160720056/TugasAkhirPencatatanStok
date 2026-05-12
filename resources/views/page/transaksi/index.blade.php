@extends('layouts.app', ['menu' => 'transaksi'])
@section('content')
    <style>
        .readonly-field {
            background-color: #f5f5f5 !important;
            cursor: not-allowed;
        }
    </style>
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <h4 class="mb-5">Transaksi</h4>
        <div class="widget-content widget-content-area br-6">
            <button type="button" class="btn btn-primary add-button" data-bs-toggle="modal" data-bs-target="#addTransaksi">
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
                            <th>Diberikan Oleh</th>
                            <th>Keperluan</th>
                            <th>Keluar</th>
                            <th>Masuk</th>
                            <th class="text-end">Harga Satuan</th>
                            <th class="text-end">Jumlah Satuan</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Tanggal</th>
                            <th>Barang</th>
                            <th>Keterangan</th>
                            <th>Diberikan Oleh</th>
                            <th>Keperluan</th>
                            <th>Keluar</th>
                            <th>Masuk</th>
                            <th class="text-end">Harga Satuan</th>
                            <th class="text-end">Jumlah Satuan</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="editTransaksi" tabindex="-1" role="dialog" aria-labelledby="editTransaksiLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTransaksiLabel">Edit Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_transaksi">

                    <div class="form-group mb-4">
                        <label for="tanggal_transaksi_edit">Tanggal Transaksi</label>
                        <input type="date" class="form-control readonly-field" id="tanggal_transaksi_edit" readonly>
                    </div>

                    <div class="form-group mb-4">
                        <label for="barang_edit">Barang</label>
                        <select class="form-control select2" id="barang_edit" style="width:100%" disabled>
                            @foreach ($barang as $item)
                                <option value="{{ $item->id_barang }}">{{ $item->nama_barang }} - {{ $item->kode_barang }} -
                                    {{ $item->seri }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="id_barang_hidden">
                    </div>

                    <div class="form-group mb-4">
                        <label for="jumlah_barang_edit">Jumlah Barang</label>
                        <input type="number" min="1" class="form-control readonly-field" id="jumlah_barang_edit"
                            readonly>
                    </div>

                    <div class="form-group mb-4">
                        <label for="tipe_transaksi_edit">Tipe Transaksi</label>
                        <select class="form-control select2" id="tipe_transaksi_edit" style="width:100%" disabled>
                            <option value="keluar">Keluar</option>
                            <option value="masuk">Masuk</option>
                        </select>
                        <input type="hidden" id="tipe_transaksi_hidden">
                    </div>

                    <div class="form-group mb-4">
                        <label for="harga_satuan_edit">Harga Satuan</label>
                        <input type="number" min="0" class="form-control" id="harga_satuan_edit" readonly>
                    </div>
                    <div class="form-group mb-4">
                        <label for="jumlah_satuan_edit">Jumlah Satuan</label>
                        <input type="number" min="1" class="form-control" id="jumlah_satuan_edit" readonly>
                    </div>

                    <div class="form-group mb-4">
                        <label for="keterangan_transaksi_edit">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan_transaksi_edit">
                    </div>
                    <div class="form-group mb-4">
                        <label for="diberikan_oleh_edit">Diberikan Oleh</label>
                        <input type="text" class="form-control" id="diberikan_oleh_edit">
                    </div>
                    <div class="form-group mb-4">
                        <label for="keperluan_transaksi_edit">Keperluan</label>
                        <input type="text" class="form-control" id="keperluan_transaksi_edit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="doneEdit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div class="modal fade" id="addTransaksi" tabindex="-1" role="dialog" aria-labelledby="addTransaksiLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransaksiLabel">Tambah Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="tanggal_transaksi_new">Tanggal Transaksi</label>
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}"
                            id="tanggal_transaksi_new">
                    </div>

                    <div class="form-group mb-4">
                        <label for="barang_new">Barang</label>
                        <select class="form-control select2" id="barang_new" style="width:100%">
                            @foreach ($barang as $item)
                                <option value="{{ $item->id_barang }}" data-harga="{{ $item->harga_satuan }}">
                                    {{ $item->kode_barang }} - {{ $item->nama_barang }} - {{ $item->seri }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="jumlah_barang_new">Jumlah Barang</label>
                        <input type="number" min="1" class="form-control" id="jumlah_barang_new">
                    </div>

                    <div class="form-group mb-4">
                        <label for="tipe_transaksi_new">Tipe Transaksi</label>
                        <select class="form-control select2" id="tipe_transaksi_new" style="width:100%">
                            <option value="keluar">Keluar</option>
                            <option value="masuk">Masuk</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="harga_satuan_new">Harga Satuan</label>
                        <input type="text" class="form-control readonly-field" id="harga_satuan_new" readonly>
                    </div>

                    <div class="form-group mb-4">
                        <label for="jumlah_satuan_new">Jumlah Satuan</label>
                        <input type="text" class="form-control readonly-field" id="jumlah_satuan_new" readonly>
                    </div>

                    <div class="form-group mb-4">
                        <label for="keterangan_transaksi_new">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan_transaksi_new">
                    </div>
                    <div class="form-group mb-4">
                        <label for="diberikan_oleh_new">Diberikan Oleh</label>
                        <input type="text" class="form-control" id="diberikan_oleh_new">
                    </div>
                    <div class="form-group mb-4">
                        <label for="keperluan_transaksi_new">Keperluan</label>
                        <input type="text" class="form-control" id="keperluan_transaksi_new">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="addTransaksiDone" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.10.5"></script>
    <script>
        $(document).ready(function() {
            const hargaSatuanMask = new AutoNumeric('#harga_satuan_new', {
                digitGroupSeparator: '.',
                decimalCharacter: ',',
                decimalPlaces: 0
            });

            const jumlahSatuanMask = new AutoNumeric('#jumlah_satuan_new', {
                digitGroupSeparator: '.',
                decimalCharacter: ',',
                decimalPlaces: 0
            });

            function loadBarangInfo() {
                const selected = $('#barang_new option:selected');
                const harga = Number(
                    selected.data('harga')
                ) || 0;
                hargaSatuanMask.set(harga);
                hitungJumlahSatuan();
            }
            $('#barang_new').on('change', function() {
                loadBarangInfo();
            });
            loadBarangInfo();



            // Select2
            // Modal tambah
            $('#barang_new, #tipe_transaksi_new').select2({
                dropdownParent: $('#addTransaksi'),
                width: '100%'
            });

            // Modal edit
            $('#barang_edit, #tipe_transaksi_edit').select2({
                dropdownParent: $('#editTransaksi'),
                width: '100%'
            });

            // DataTable
            $('#transaksi-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('transaksi.data') }}",
                order: [
                    [0, 'desc']
                ],
                columnDefs: [{
                    targets: '_all',
                    className: 'fw-semibold'
                }],

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'tanggal_transaksi',
                        name: 'transaksi.tanggal_transaksi'
                    },
                    {
                        data: 'barang',
                        name: 'barang.nama_barang'
                    },
                    {
                        data: 'keterangan_transaksi',
                        name: 'transaksi.keterangan_transaksi'
                    },
                    {
                        data: 'diberikan_oleh',
                        name: 'transaksi.diberikan_oleh'
                    },
                    {
                        data: 'keperluan_transaksi',
                        name: 'transaksi.keperluan_transaksi'
                    },
                    {
                        data: 'keluar',
                        name: 'transaksi.jumlah_barang',
                        className: 'text-danger fw-bold text-center'
                    },
                    {
                        data: 'masuk',
                        name: 'transaksi.jumlah_barang',
                        className: 'text-success fw-bold text-center'
                    },
                    {
                        data: 'harga_satuan',
                        name: 'transaksi.harga_satuan',
                        render: function(data) {
                            return new Intl.NumberFormat('id-ID').format(data);
                        }
                    },
                    {
                        data: 'jumlah_satuan',
                        name: 'transaksi.jumlah_satuan',
                        render: function(data) {
                            return new Intl.NumberFormat('id-ID').format(data);
                        }
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

            function hitungJumlahSatuan() {
                let jumlahBarang = Number(
                    $('#jumlah_barang_new').val()
                ) || 0;
                let hargaSatuan = Number(
                    hargaSatuanMask.getNumericString()
                ) || 0;
                jumlahSatuanMask.set(
                    jumlahBarang * hargaSatuan
                );
            }

            $('#jumlah_barang_new').on('input', function() {
                hitungJumlahSatuan();
            });

            // ==================== TAMBAH TRANSAKSI ====================
            $('#addTransaksiDone').click(function() {
                const data = {
                    tanggal_transaksi: $('#tanggal_transaksi_new').val(),
                    id_barang: $('#barang_new').val(),
                    jumlah_barang: $('#jumlah_barang_new').val(),
                    tipe_transaksi: $('#tipe_transaksi_new').val(),
                    keterangan_transaksi: $('#keterangan_transaksi_new').val(),
                    diberikan_oleh: $('#diberikan_oleh_new').val(),
                    keperluan_transaksi: $('#keperluan_transaksi_new').val(),
                    harga_satuan: hargaSatuanMask.getNumericString(),
                    jumlah_satuan: jumlahSatuanMask.getNumericString(),

                };




                if (!data.jumlah_barang || data.jumlah_barang <= 0) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Jumlah barang harus lebih dari 0',
                        icon: 'error'
                    });
                    return;
                }

                axiosPost("/transaksi", data).then(response => {
                    if (response.data.status === "success") {
                        Swal.fire({
                                title: "Success!",
                                text: response.data.message,
                                icon: "success"
                            })
                            .then(() => {
                                $('#transaksi-table').DataTable().ajax.reload(null, false);
                                bootstrap.Modal.getInstance(document.getElementById(
                                    'addTransaksi')).hide();
                                resetAddForm();
                            });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.data.message,
                            icon: 'error'
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan',
                        icon: 'error'
                    });
                });
            });

            function resetAddForm() {
                $('#tanggal_transaksi_new').val('{{ date('Y-m-d') }}');
                $('#barang_new').val('').trigger('change');
                $('#jumlah_barang_new').val('');
                $('#tipe_transaksi_new').val('keluar').trigger('change');
                $('#keterangan_transaksi_new').val('');
                $('#diberikan_oleh_new').val('');
                $('#keperluan_transaksi_new').val('');
                hargaSatuanMask.clear();
                jumlahSatuanMask.clear();
            }

            // ==================== EDIT TRANSAKSI ====================
            window.editTransaksi = function(id_transaksi) {
                axiosGet(`/transaksi/${id_transaksi}`)
                    .then(response => {
                        $('#id_transaksi').val(id_transaksi);
                        $('#tanggal_transaksi_edit').val(response.data.tanggal_transaksi);
                        $('#barang_edit').val(response.data.id_barang).trigger('change');

                        $('#tipe_transaksi_edit').val(response.data.tipe_transaksi).trigger('change');
                        //select2


                        $('#keterangan_transaksi_edit').val(response.data.keterangan_transaksi);
                        $('#jumlah_barang_edit').val(response.data.jumlah_barang);
                        $('#diberikan_oleh_edit').val(response.data.diberikan_oleh);
                        $('#keperluan_transaksi_edit').val(response.data.keperluan_transaksi);
                        $('#id_barang_hidden').val(response.data.id_barang);
                        $('#tipe_transaksi_hidden').val(response.data.tipe_transaksi);
                        $('#harga_satuan_edit').val(response.data.harga_satuan);
                        $('#jumlah_satuan_edit').val(response.data.jumlah_satuan);

                        const editModal = new bootstrap.Modal(document.getElementById('editTransaksi'));
                        editModal.show();
                    });
            };

            $('#doneEdit').click(function() {
                const id = $('#id_transaksi').val();
                const data = {
                    tanggal_transaksi: $('#tanggal_transaksi_edit').val(),
                    id_barang: $('#id_barang_hidden').val(),
                    jumlah_barang: $('#jumlah_barang_edit').val(),
                    tipe_transaksi: $('#tipe_transaksi_hidden').val(),
                    keterangan_transaksi: $('#keterangan_transaksi_edit').val(),
                    diberikan_oleh: $('#diberikan_oleh_edit').val(),
                    keperluan_transaksi: $('#keperluan_transaksi_edit').val(),
                    harga_satuan: $('#harga_satuan_edit').val(),
                    jumlah_satuan: $('#jumlah_satuan_edit').val(),
                };

                axiosPut(`/transaksi/${id}`, data).then(response => {
                    if (response.data.status === "success") {
                        Swal.fire({
                                title: "Success!",
                                text: "Data berhasil diupdate",
                                icon: "success"
                            })
                            .then(() => {
                                $('#transaksi-table').DataTable().ajax.reload(null, false);
                                bootstrap.Modal.getInstance(document.getElementById(
                                    'editTransaksi')).hide();
                            });
                    }
                }).catch(() => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan',
                        icon: 'error'
                    });
                });
            });

            // Delete tetap sama...
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
                        axiosDelete("/transaksi/" + id)
                            .then(() => {
                                Swal.fire({
                                        title: "Success!",
                                        text: "Data Berhasil Dihapus",
                                        icon: "success"
                                    })
                                    .then(() => $('#transaksi-table').DataTable().ajax.reload(null,
                                        false));
                            });
                    }
                });
            };
        });
    </script>
@endsection
