@php
    $layout = isset($webView) && $webView ? 'layouts.appWebView' : 'layouts.app';
@endphp

@extends($layout, ['menu' => 'barang'])

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <h4 class="mb-4">Data Barang</h4>

        <div class="widget-content widget-content-area br-6">


            <!-- Filter -->
            <div class="row mb-4 align-items-end g-3">
                <div class="col-md-5">
                    <label class="form-label">Periode Tanggal Input</label>
                    <input type="text" id="tanggal_range" class="form-control" placeholder="Pilih rentang tanggal..."
                        readonly>
                </div>
                <div class="col-md-auto">
                    <button type="button" class="btn btn-success" id="btnProses">
                        <i class="fas fa-search"></i> Proses
                    </button>
                </div>
                <div class="col-md-auto">
                    <button type="button" class="btn btn-info" id="btnTampilkanSemua">
                        Tampilkan Semua
                    </button>
                </div>
                <div class="col-md-auto ms-auto">
                    <button type="button" class="btn btn-primary add-button" data-bs-toggle="modal"
                        data-bs-target="#addTransaksi">
                        Tambah Barang
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-plus">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="table-responsive mb-4 mt-4">
                <table id="barang-table" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Seri</th>
                            <th class="text-end">Stok Awal</th>
                            <th class="text-end">Harga Satuan</th>
                            {{-- <th class="text-end">Jumlah Satuan</th> --}}
                            <th>Tanggal Input</th>

                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Seri</th>
                            <th class="text-end">Stok Awal</th>
                            <th class="text-end">Harga Satuan</th>
                            {{-- <th class="text-end">Jumlah Satuan</th> --}}
                            <th>Tanggal Input</th>

                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- ==================== MODAL ADD ==================== --}}
    <div class="modal fade" id="addBarang" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">Tambah Barang Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{-- ROW 1 --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Kode Barang
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="kode_barang_new"
                                    placeholder="Contoh: BRG001">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Nama Barang
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="nama_barang_new">
                            </div>
                        </div>
                    </div>
                    {{-- ROW 2 --}}
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Seri / Tipe</label>
                                <input type="text" class="form-control" id="seri_new">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status Barang</label>
                                <select class="form-select" id="status_barang_new">
                                    <option value="1">AKTIF</option>
                                    <option value="0">BARU</option>
                                    <option value="2">NON-AKTIF</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- ROW 3 --}}
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Stok Awal</label>
                                <input type="text" class="form-control text-end currency-mask" id="stok_awal_new"
                                    value="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Harga Satuan</label>
                                <input type="text" class="form-control text-end currency-mask" id="harga_satuan_new"
                                    value="0">
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label>Jumlah Satuan</label>
                                <input type="text" class="form-control text-end currency-mask" id="jumlah_satuan_new"
                                    value="0">
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button class="btn btn-primary px-4" id="doneAdd">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ==================== MODAL EDIT ==================== --}}
    <div class="modal fade" id="editBarang" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_barang">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Kode Barang
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="kode_barang">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Nama Barang
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="nama_barang">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Seri / Tipe</label>
                                <input type="text" class="form-control" id="seri">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status Barang</label>
                                <select class="form-select" id="status_barang">
                                    <option value="0">BARU</option>
                                    <option value="1">AKTIF</option>
                                    <option value="2">NON-AKTIF</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Stok Awal</label>
                                <input type="text" class="form-control text-end currency-mask" id="stok_awal"
                                    value="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Harga Satuan</label>
                                <input type="text" class="form-control text-end currency-mask" id="harga_satuan"
                                    value="0">
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label>Jumlah Satuan</label>
                                <input type="text" class="form-control text-end currency-mask" id="jumlah_satuan"
                                    value="0">
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="modal-footer bg-light">

                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn btn-primary px-4" id="doneEdit">
                        Simpan Perubahan
                    </button>

                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.10.5"></script>
    <script>
        $(document).ready(function() {



            let fp;

            // ==================== FLATPICKR RANGE ====================
            // ==================== FLATPICKR RANGE ====================
            fp = flatpickr("#tanggal_range", {
                mode: "range",
                locale: "id",
                dateFormat: "Y-m-d",
                defaultDate:"",
                separator: " to ",
                onOpen: function(selectedDates, dateStr, instance) {
                    // Saat kalender terbuka, fokus ke hari ini
                    instance.jumpToDate(new Date());
                },
                onChange: function(selectedDates, dateStr) {
                    // Optional: reload otomatis saat range diubah
                    table.ajax.reload();
                }
            });

            // ==================== INIT MASK ====================
            const numericOptions = {
                digitGroupSeparator: '.',
                decimalCharacter: ',',
                decimalPlaces: 0,
                unformatOnSubmit: true,
                modifyValueOnWheel: false
            };

            function initMask() {
                $('.currency-mask').each(function() {
                    if (!AutoNumeric.getAutoNumericElement(this)) {
                        new AutoNumeric(this, numericOptions);
                    }
                });
            }

            initMask();

            // ==================== DATATABLE ====================
            const table = $('#barang-table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                pageLength: 25,
                lengthMenu: [
                    [10, 25, 50, 100, 500, 1000],
                    [10, 25, 50, 100, 500, 1000]
                ],
                ajax: {
                    url: '{{ route('barang.data') }}',
                    data: function(d) {
                        const dateStr = $('#tanggal_range').val().trim();
                        if (dateStr) {
                            const dates = dateStr.includes(' to ') ?
                                dateStr.split(' to ') :
                                dateStr.split(' - ');
                            d.tanggal_awal = dates[0];
                            d.tanggal_akhir = dates[1] || dates[0];
                        }
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kode_barang'
                    },
                    {
                        data: 'nama_barang'
                    },
                    {
                        data: 'seri'
                    },
                    {
                        data: 'stok_awal',
                        className: 'text-center',
                        render: data => Number(data || 0).toLocaleString('id-ID')
                    },
                    {
                        data: 'harga_satuan',
                        className: 'text-center',
                        render: data => `Rp ${data}`
                    },
                    {
                        data: 'tanggal_input',
                        className: 'text-center',
                    },
                    {
                        data: 'STATUS_BARANG',
                        render: function(data) {
                            if (data == 0) return `<span class="badge badge-primary">BARU</span>`;
                            if (data == 1) return `<span class="badge badge-success">AKTIF</span>`;
                            return `<span class="badge badge-danger">NON-AKTIF</span>`;
                        }
                    },
                    {
                        data: 'id_barang',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return `
                        <button class="btn btn-primary btn-sm me-1" onclick="editBarang(${data})" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                            </svg>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deleteBarang(${data})" title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7 a2 2 0 0 1-2-2V6m3 0V4 a2 2 0 0 1 2-2h4 a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                        </button>`;
                        }
                    }
                ],
                order: [
                    [1, 'asc']
                ]
            });

            // ==================== BUTTON FILTER ====================
            $('#btnProses').on('click', function() {
                table.ajax.reload();
            });

            $('#btnTampilkanSemua').on('click', function() {
                $('#tanggal_range').val('');
                table.ajax.reload();
            });

            // ===================== ADD =====================
            $('.add-button').on('click', function() {
                $('#addBarang').modal('show');
                $('#kode_barang_new').focus();
                $('#addBarang').find('input[type=text]').val('');
                $('.currency-mask').each(function() {
                    const an = AutoNumeric.getAutoNumericElement(this);
                    if (an) an.set(0);
                });
            });

            $('#doneAdd').on('click', function() {
                axiosPost('/barang', {
                        kode_barang: $('#kode_barang_new').val(),
                        nama_barang: $('#nama_barang_new').val(),
                        seri: $('#seri_new').val(),
                        stok_awal: AutoNumeric.getNumber('#stok_awal_new'),
                        harga_satuan: AutoNumeric.getNumber('#harga_satuan_new'),
                        STATUS_BARANG: $('#status_barang_new').val()
                    })
                    .then(() => {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Barang berhasil ditambahkan",
                            icon: "success",
                            timer: 1500
                        });
                        $('#addBarang').modal('hide');
                        table.ajax.reload(null, false);
                    })
                    .catch(err => {
                        Swal.fire({
                            title: "Gagal",
                            text: err.response?.data?.message || "Terjadi kesalahan",
                            icon: "error"
                        });
                    });
            });
            // ===================== EDIT =====================
            window.editBarang = function(id) {
                axiosGet(`/barang/getBarangDetail/${id}`)
                    .then(response => {
                        const b = response.data;
                        $('#id_barang').val(b.id_barang);
                        $('#kode_barang').val(b.kode_barang);
                        $('#nama_barang').val(b.nama_barang);
                        $('#seri').val(b.seri);
                        AutoNumeric.getAutoNumericElement('#stok_awal').set(b.stok_awal || 0);
                        AutoNumeric.getAutoNumericElement('#harga_satuan').set(b.harga_satuan || 0);
                        // AutoNumeric.getAutoNumericElement('#jumlah_satuan').set(b.jumlah_satuan || 0);
                        $('#status_barang').val(b.STATUS_BARANG);

                        // disable input
                        // $('#kode_barang').prop('disabled', true);
                        // $('#seri').prop('disabled', true);
                        $('#stok_awal').prop('disabled', true);
                        // $('#harga_satuan').prop('disabled', true);
                        $('#status_barang').prop('disabled', true);

                        $('#editBarang').modal('show');
                    });
            };

            $('#doneEdit').on('click', function() {
                const id = $('#id_barang').val();
                axiosPut(`/barang/${id}`, {
                        kode_barang: $('#kode_barang').val(),
                        nama_barang: $('#nama_barang').val(),
                        seri: $('#seri').val(),
                        stok_awal: AutoNumeric.getNumber('#stok_awal'),
                        harga_satuan: AutoNumeric.getNumber('#harga_satuan'),
                        // jumlah_satuan: AutoNumeric.getNumber('#jumlah_satuan'),
                        STATUS_BARANG: $('#status_barang').val()
                    })
                    .then(() => {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data berhasil diperbarui",
                            icon: "success",
                            timer: 1500
                        });
                        $('#editBarang').modal('hide');
                        table.ajax.reload(null, false);
                    })
                    .catch(err => {
                        Swal.fire({
                            title: "Gagal",
                            text: "Terjadi kesalahan saat mengupdate",
                            icon: "error"
                        });
                    });
            });

            // ===================== DELETE =====================
            window.deleteBarang = function(id) {
                Swal.fire({
                    title: 'Yakin hapus barang ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then(result => {
                    if (result.isConfirmed) {
                        axiosDelete(`/barang/${id}`)
                            .then((response) => {

                                Swal.fire({
                                    title: "Terhapus!",
                                    text: response.data?.message ||
                                        "Barang berhasil dihapus",
                                    icon: "success",
                                    timer: 1500,
                                    showConfirmButton: false
                                });

                                table.ajax.reload(null, false);

                            })
                            .catch((err) => {

                                Swal.fire({
                                    title: "Gagal",
                                    text: err.response?.data?.message ||
                                        err.response?.data?.error ||
                                        "Terjadi kesalahan saat menghapus barang",
                                    icon: "error"
                                });

                            });
                    }
                });
            };

        });
    </script>
@endsection
