@extends('layouts.app', ['menu' => 'hakAkses'])
@section('content')
    <style>
        .form-check-input {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .form-check-label {
            font-size: 1.1rem;
            color: #333;
        }
    </style>
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <h4 class="mb-5">Hak Akses</h4>
        <div class="widget-content widget-content-area br-6">
            <button type="button" class="btn btn-primary add-button" data-bs-toggle="modal" data-bs-target="#addHakAkses">
                Tambah Hak Akses
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-plus">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </button>
            <div class="table-responsive mb-4 mt-4">
                <table id="hakAkses-table" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center sorting_asc" aria-sort="ascending">#</th>
                            <th>Nama Hak Akses</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama Hak Akses</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
    <!-- Modal Add Hak Akses -->
<div class="modal fade"
    id="detailHakAkses"
    tabindex="-1"
    role="dialog"
    aria-labelledby="addHakAkses"
    aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable"
        role="document">

        <div class="modal-content border-0 shadow-lg">

            {{-- HEADER --}}
            <div class="modal-header bg-light">

                <h5 class="modal-title fw-semibold">
                    Ubah Hak Akses
                </h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            {{-- BODY --}}
            <div class="modal-body">

                <input type="hidden"
                    id="id_hak_akses_detail">

                <div class="card border-0 bg-light">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <div>
                                <h6 class="fw-bold text-primary mb-1">
                                    Pengaturan Hak Akses
                                </h6>

                                <small class="text-muted">
                                    Pilih menu yang dapat diakses oleh user.
                                </small>
                            </div>

                        </div>

                        {{-- LIST MENU --}}
                        <div class="row g-3">

                            @foreach ($hakAksesMenu as $item)

                                <div class="col-md-4 col-sm-6">

                                    <div class="border rounded p-3 bg-white h-100">

                                        <div class="form-check m-0">

                                            <input class="form-check-input"
                                                type="checkbox"
                                                value="{{ $item->id_menu }}"
                                                id="menu_{{ $item->id_menu }}">

                                            <label class="form-check-label fw-semibold"
                                                for="menu_{{ $item->id_menu }}">

                                                {{ $item->nama_menu }}

                                            </label>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                        {{-- INFO --}}
                        <div class="alert alert-light border small mt-4 mb-0">

                            Hak akses menentukan menu yang dapat dilihat dan digunakan oleh user.

                        </div>

                    </div>

                </div>

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer bg-light">

                <button type="button"
                    class="btn btn-outline-secondary"
                    data-bs-dismiss="modal">
                    Batal
                </button>

                <button type="button"
                    class="btn btn-primary px-4"
                    id="submitAddHakAkses">
                    Simpan
                </button>

            </div>

        </div>

    </div>

</div>


    <script>
        $(document).ready(function() {

            var hakAksesTable = $('#hakAkses-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('hakAkses.data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'nama_hak_akses',
                        name: 'nama_hak_akses'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                                <div class="table-controls">
                                    <button type="button" class="btn btn-primary detail-button" data-id="${row.id_hak_akses}" data-bs-toggle="modal" data-bs-target="#detailHakAkses" onclick="showDetail('${row.id_hak_akses}')">
                                        Detail
                                    </button>
                                    <button type="button" class="btn btn-primary delete-button" data-id="${row.id_hak_akses}" onclick="deleteHakAkses('${row.id_hak_akses}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                </div>
                            `;
                        }
                    },
                ],
            });




            //masih disini
            window.showDetail = function(id) {
                //reset checkbox
                $('input[type=checkbox]').prop('checked', false);
                axiosGet(`/hakAkses/detailHakAkses/${id}`)
                    .then(response => {
                        const data = response.data.data;
                        data.forEach(item => {
                            $(`#menu_${item}`).prop('checked', true);
                        });
                        $('#id_hak_akses_detail').val(id);
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong. Please try again.',
                            icon: 'error',
                            padding: '2em'
                        });
                        console.log(error.response.data);
                    });
            }
            //submit add hak akses
            $('#submitAddHakAkses').on('click', function() {
                const id = $('#id_hak_akses_detail').val();
                const menus = [];
                $('input[type=checkbox]:checked').each(function() {
                    menus.push($(this).val());
                });

                const menuNames = $('input[type=checkbox]:checked').map(function() {
                    return `<b>${$(this).next('label').text()}</b>`;
                }).get().join(', ');

                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    html: `Anda akan menyimpan hak akses dengan menu: ${menuNames}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axiosPost(`/hakAkses/updateHakAkses/${id}`, {
                                menus: menus
                            })
                            .then(response => {
                                Swal.fire({
                                    title: "Success!",
                                    text: "Data Berhasil Diubah",
                                    icon: "success",
                                }).then(() => {
                                    $('#hakAkses-table').DataTable().ajax.reload(null,
                                        false);
                                    $('#detailHakAkses').modal('hide');
                                });
                            })
                            .catch(error => {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Gagal Mengubah Data',
                                    icon: 'error',
                                    padding: '2em'
                                });
                                console.log(error.response.data);
                            });
                    }
                });
            });

            $('.add-button').on('click', function() {
                Swal.fire({
                    title: "Tambah Hak Akses",
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Simpan',
                    showLoaderOnConfirm: true,
                    preConfirm: (nama_hak_akses) => {
                        axiosPost('/hakAkses', {
                                nama_hak_akses: nama_hak_akses
                            })
                            .then(function(response) {
                                Swal.fire({
                                    title: "Success!",
                                    text: "Data Berhasil Ditambahkan",
                                    icon: "success",
                                }).then(() => {
                                    $('#hakAkses-table').DataTable().ajax.reload(
                                        null, false);

                                });
                            })
                            .catch(function(error) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Gagal Menambahkan Data',
                                    icon: 'error',
                                    padding: '2em'
                                });
                                console.log(error.response.data);
                            });
                    },
                })
            });

            $('.edit-button').on('click', function() {
                const id = $(this).data('id');
                axiosGet(`/hak_akses/${id}`)
                    .then(response => {
                        const data = response.data;
                        Swal.fire({
                            title: 'Edit Hak Akses',
                            input: 'text',
                            inputValue: data.nama_hak_akses,
                            inputAttributes: {
                                autocapitalize: 'off'
                            },
                            showCancelButton: true,
                            confirmButtonText: 'Simpan',
                            showLoaderOnConfirm: true,
                            preConfirm: (nama_hak_akses) => {
                                axiosPut(`/hak_akses/${id}`, {
                                        nama_hak_akses: nama_hak_akses
                                    })
                                    .then(function(response) {
                                        Swal.fire({
                                            title: "Success!",
                                            text: "Data Berhasil Diubah",
                                            icon: "success",
                                        }).then(() => {
                                            $('#hakAkses-table').DataTable()
                                                .ajax.reload(null, false);
                                            $('#detailHakAkses').modal('hide');
                                        });
                                    })
                                    .catch(function(error) {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'Gagal Mengubah Data',
                                            icon: 'error',
                                            padding: '2em'
                                        });
                                        console.log(error.response.data);
                                    });
                            },
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong. Please try again.',
                            icon: 'error',
                            padding: '2em'
                        });
                        console.log(error.response.data);
                    });
            });

            window.deleteHakAkses = function(id) {
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
                        axiosDelete("/hakAkses/" + id)
                            .then(function(response) {
                                if (response.data.status == 'error') {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.data.message,
                                        icon: 'error',
                                        padding: '2em'
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Success!",
                                        text: response.data.message,
                                        icon: "success",
                                    }).then(() => {
                                        $('#hakAkses-table').DataTable().ajax.reload(null,
                                            false);
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Terjadi Kesalahan, Gagal Menghapus Data',
                                    icon: 'error',
                                    padding: '2em'
                                });
                                console.log(error.response.data);
                            });
                    } else {
                        Swal.fire(
                            'Batal',
                            'Data tidak jadi dihapus.',
                            'error'
                        );
                    }
                });
            }
        });
    </script>
@endsection
