@extends('layouts.app', ['menu' => 'user'])
@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <h4 class="mb-5">User</h4>
        <div class="widget-content widget-content-area br-6">
            <button type="button" class="btn btn-primary add-button" id="tambahUser" data-bs-toggle="modal"
                data-bs-target="#addUser">
                Tambah User
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-plus">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </button>

            <div class="table-responsive mb-4 mt-4">
                <table id="user-table" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama User</th>
                            <th>Username</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Status User</th>
                            <th class="text-center">2FA</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama User</th>
                            <th>Username</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Status User</th>
                            <th class="text-center">2FA</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- ==================== MODAL EDIT USER ==================== --}}
    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUserLabel" aria-hidden="true">

        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">

            <div class="modal-content border-0 shadow-lg">

                {{-- HEADER --}}
                <div class="modal-header bg-light">

                    <h5 class="modal-title fw-semibold" id="editUserLabel">
                        Edit User
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                {{-- BODY --}}
                <div class="modal-body">

                    <div class="row g-4">

                        {{-- ========================= --}}
                        {{-- KOLOM KIRI --}}
                        {{-- ========================= --}}
                        <div class="col-lg-6">

                            <div class="card border-0 bg-light h-100">
                                <div class="card-body">

                                    <h6 class="fw-bold text-primary mb-4">
                                        Informasi Akun
                                    </h6>

                                    {{-- ID USER --}}
                                    <div class="mb-3">
                                        <label for="id_user" class="form-label fw-semibold">
                                            ID User
                                        </label>

                                        <input type="text" class="form-control" id="id_user" readonly>
                                    </div>

                                    {{-- NAMA --}}
                                    <div class="mb-3">
                                        <label for="nama_user" class="form-label fw-semibold">
                                            Nama User
                                        </label>

                                        <input type="text" class="form-control" id="nama_user" required>
                                    </div>

                                    {{-- USERNAME --}}
                                    <div class="mb-3">
                                        <label for="username" class="form-label fw-semibold">
                                            Username
                                        </label>

                                        <input type="text" class="form-control" id="username" required>
                                    </div>

                                    {{-- PASSWORD --}}
                                    <div class="mb-0">
                                        <label for="password" class="form-label fw-semibold">
                                            Password
                                        </label>

                                        <input type="password" class="form-control" id="password"
                                            placeholder="Kosongkan jika tidak diubah">
                                    </div>

                                </div>
                            </div>

                        </div>

                        {{-- ========================= --}}
                        {{-- KOLOM KANAN --}}
                        {{-- ========================= --}}
                        <div class="col-lg-6">

                            <div class="card border-0 bg-light h-100">
                                <div class="card-body">

                                    <h6 class="fw-bold text-success mb-4">
                                        Informasi Tambahan
                                    </h6>

                                    {{-- ALAMAT --}}
                                    <div class="mb-3">
                                        <label for="alamat_user" class="form-label fw-semibold">
                                            Alamat
                                        </label>

                                        <textarea class="form-control" id="alamat_user" rows="3" required></textarea>
                                    </div>

                                    {{-- TELEPON --}}
                                    <div class="mb-3">
                                        <label for="telepon" class="form-label fw-semibold">
                                            Telepon
                                        </label>

                                        <input type="text" class="form-control" id="telepon" required>
                                    </div>

                                    {{-- EMAIL --}}
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-semibold">
                                            Email
                                        </label>

                                        <input type="email" class="form-control" id="email" required>
                                    </div>

                                    <div class="row">

                                        {{-- HAK AKSES --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="hak_akses" class="form-label fw-semibold">
                                                Hak Akses
                                            </label>

                                            <select class="form-control" id="hak_akses" required>

                                                @foreach ($hakAkses as $i)
                                                    <option value="{{ $i->id_hak_akses }}">
                                                        {{ $i->nama_hak_akses }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>

                                        {{-- STATUS --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="status_user" class="form-label fw-semibold">
                                                Status User
                                            </label>

                                            <select class="form-control" id="status_user" required>

                                                <option value="0">BARU</option>
                                                <option value="1">AKTIF</option>
                                                <option value="2">NON-AKTIF</option>

                                            </select>
                                        </div>

                                    </div>

                                    <div class="alert alert-light border small mb-0">
                                        Password hanya diubah jika field password diisi.
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer bg-light">

                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="button" id="doneEdit" class="btn btn-primary px-4">
                        Simpan
                    </button>

                </div>

            </div>
        </div>
    </div>






    {{-- ==================== MODAL TAMBAH USER ==================== --}}
    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">

            <div class="modal-content border-0 shadow-lg">

                {{-- HEADER --}}
                <div class="modal-header bg-light">

                    <h5 class="modal-title fw-semibold" id="addUserLabel">
                        Tambah User
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                {{-- BODY --}}
                <div class="modal-body">

                    <div class="row g-4">

                        {{-- ========================= --}}
                        {{-- KOLOM KIRI --}}
                        {{-- ========================= --}}
                        <div class="col-lg-6">

                            <div class="card border-0 bg-light h-100">
                                <div class="card-body">

                                    <h6 class="fw-bold text-primary mb-4">
                                        Informasi Akun
                                    </h6>

                                    {{-- NAMA --}}
                                    <div class="mb-3">
                                        <label for="nama_user_new" class="form-label fw-semibold">
                                            Nama User
                                        </label>

                                        <input type="text" class="form-control" id="nama_user_new" required>
                                    </div>

                                    {{-- USERNAME --}}
                                    <div class="mb-3">
                                        <label for="username_new" class="form-label fw-semibold">
                                            Username
                                        </label>

                                        <input type="text" class="form-control" id="username_new" required>
                                    </div>

                                    {{-- PASSWORD --}}
                                    <div class="mb-0">
                                        <label for="password_new" class="form-label fw-semibold">
                                            Password
                                        </label>

                                        <input type="password" class="form-control" id="password_new" required>
                                    </div>

                                </div>
                            </div>

                        </div>

                        {{-- ========================= --}}
                        {{-- KOLOM KANAN --}}
                        {{-- ========================= --}}
                        <div class="col-lg-6">

                            <div class="card border-0 bg-light h-100">
                                <div class="card-body">

                                    <h6 class="fw-bold text-success mb-4">
                                        Informasi Tambahan
                                    </h6>

                                    {{-- ALAMAT --}}
                                    <div class="mb-3">
                                        <label for="alamat_user_new" class="form-label fw-semibold">
                                            Alamat
                                        </label>

                                        <textarea class="form-control" id="alamat_user_new" rows="3" required></textarea>
                                    </div>

                                    {{-- TELEPON --}}
                                    <div class="mb-3">
                                        <label for="telepon_new" class="form-label fw-semibold">
                                            Telepon
                                        </label>

                                        <input type="text" class="form-control" id="telepon_new" required>
                                    </div>

                                    {{-- EMAIL --}}
                                    <div class="mb-3">
                                        <label for="email_new" class="form-label fw-semibold">
                                            Email
                                        </label>

                                        <input type="email" class="form-control" id="email_new" required>
                                    </div>

                                    <div class="row">

                                        {{-- HAK AKSES --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="hak_akses_new" class="form-label fw-semibold">
                                                Hak Akses
                                            </label>

                                            <select class="form-control" id="hak_akses_new" required>

                                                @foreach ($hakAkses as $hakAkses)
                                                    <option value="{{ $hakAkses->id_hak_akses }}">
                                                        {{ $hakAkses->nama_hak_akses }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>

                                        {{-- STATUS --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="status_user_new" class="form-label fw-semibold">
                                                Status User
                                            </label>

                                            <select class="form-control" id="status_user_new" required>

                                                <option value="0">BARU</option>
                                                <option value="1">AKTIF</option>
                                                <option value="2">NON-AKTIF</option>

                                            </select>
                                        </div>

                                    </div>

                                    <div class="alert alert-light border small mb-0">
                                        Gunakan password yang kuat untuk keamanan akun.
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer bg-light">

                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="button" id="doneAdd" class="btn btn-primary px-4">
                        Simpan
                    </button>

                </div>

            </div>
        </div>
    </div>

    {{-- Modal Setup 2FA --}}
    <div class="modal fade" id="setup2FAModal" tabindex="-1" role="dialog" aria-labelledby="setup2FALabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="setup2FALabel">Setup Two-Factor Authentication</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="2fa-content">
                    <!-- Konten akan dimuat melalui AJAX -->
                    <div class="text-center py-5">
                        <div class="spinner-border"></div><br>
                        Memuat QR Code...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#user-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_user',
                        name: 'nama_user'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'telepon',
                        name: 'telepon'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'STATUS_USER',
                        name: 'STATUS_USER',
                        render: function(data, type, row) {
                            if (row.activationPin != null) {
                                return '<span class="shadow-none badge badge-warning text-white">Menunggu Konfirmasi Email</span>';
                            }
                            if (data == 0) {
                                return '<span class="shadow-none badge badge-primary text-white">BARU</span>';
                            }
                            if (data == 1) {
                                return '<span class="shadow-none badge badge-success text-white">AKTIF</span>';
                            }
                            return '<span class="shadow-none badge badge-danger text-white">NON-AKTIF</span>';
                        }
                    },
                    {
                        data: 'two_factor_enabled',
                        name: 'two_factor_enabled',
                        className: 'text-center',
                        render: function(data) {
                            if (data == 1) {
                                return '<span class="badge badge-success text-white">✓ Aktif</span>';
                            }
                            return '<span class="badge badge-secondary text-white">✗ Belum Aktif</span>';
                        }
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            let btn2FA = '';

                            if (row.two_factor_enabled == 1) {
                                btn2FA = `
                        <button type="button" class="btn btn-warning btn-sm" 
                                onclick="disable2FA('${row.id_user}', '${row.username}')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" 
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6L6 18M6 6l12 12"></path>
                            </svg>
                            Disable 2FA
                        </button>`;
                            } else {
                                btn2FA = `
                                     <button type="button" class="btn btn-info btn-sm" onclick="setup2FA('${row.id_user}', '${row.username}')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                        </svg>
                        2FA
                    </button>`;
                            }

                            return `
                    <button type="button" class="btn btn-primary btn-sm" onclick="editUser('${row.id_user}')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                    </button>

                    ${btn2FA}
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteUser('${row.id_user}', ${row.STATUS_USER})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                    </button>`;
                        }
                    }
                ]
            });

            // ====================== SETUP 2FA ======================
            window.setup2FA = function(id, username) {
                $('#setup2FAModal').modal('show');
                $('#2fa-content').html(
                    '<div class="text-center py-5"><div class="spinner-border"></div><br>Memuat QR Code...</div>'
                    );

                axiosGet(`/2fa/setup/${id}`)
                    .then(function(response) {
                        $('#2fa-content').html(response.data.html);

                    })
                    .catch(function() {
                        $('#2fa-content').html(
                        '<div class="alert alert-danger">Gagal memuat QR Code</div>');
                    });
            };

            // ====================== DISABLE 2FA ======================
            window.disable2FA = function(id, username) {
                Swal.fire({
                    title: `Nonaktifkan 2FA untuk ${username}?`,
                    text: "User ini tidak akan lagi diminta kode 2FA saat login.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Nonaktifkan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axiosPost(`/2fa/disable/${id}`)
                            .then(function(response) {
                                Swal.fire('Berhasil!', '2FA telah dinonaktifkan.', 'success')
                                    .then(() => {
                                        $('#user-table').DataTable().ajax.reload(null, false);
                                    });
                            })
                            .catch(function() {
                                Swal.fire('Gagal!', 'Terjadi kesalahan saat menonaktifkan 2FA.',
                                    'error');
                            });
                    }
                });
            };

            // ====================== TAMBAH USER ======================
            $('#doneAdd').on('click', function() {
                $('#doneAdd').prop('disabled', true);

                axiosPost('/user/add', {
                        nama_user: $('#nama_user_new').val(),
                        username: $('#username_new').val(),
                        password: $('#password_new').val(),
                        alamat_user: $('#alamat_user_new').val(),
                        telepon: $('#telepon_new').val(),
                        email: $('#email_new').val(),
                        hak_akses: $('#hak_akses_new').val(),
                        STATUS_USER: $('#status_user_new').val()
                    })
                    .then(function(response) {
                        if (response.data.status === "success") {
                            Swal.fire({
                                    title: "Success!",
                                    text: "Data Berhasil Ditambahkan",
                                    icon: "success"
                                })
                                .then(() => {
                                    $('#user-table').DataTable().ajax.reload(null, false);
                                    $('#addUser').modal('hide');
                                });
                        } else {
                            $('#doneAdd').prop('disabled', false);
                            Swal.fire('Gagal!', response.data.message, 'error');
                        }
                    })
                    .catch(() => {
                        Swal.fire('Gagal!', 'Data gagal ditambahkan.', 'error');
                        $('#doneAdd').prop('disabled', false);
                    });
            });

            // ====================== EDIT USER ======================
            window.editUser = function(id) {
                axiosGet('/user/detail/' + id)
                    .then(function(response) {
                        const data = response.data.data;

                        $('#id_user').val(data.id_user);
                        $('#nama_user').val(data.nama_user);
                        $('#username').val(data.username);
                        $('#password').val(''); // kosongkan password
                        $('#alamat_user').val(data.alamat_user);
                        $('#telepon').val(data.telepon);
                        $('#email').val(data.email);
                        $('#hak_akses').val(data.id_hak_akses);
                        $('#status_user').val(data.STATUS_USER);

                        $('#editUser').modal('show');
                        $('#doneEdit').prop('disabled', false);
                    })
                    .catch(console.error);
            };

            $('#doneEdit').on('click', function() {
                $('#doneEdit').prop('disabled', true);
                const id_user = $('#id_user').val();

                axiosPut('/user/' + id_user, {
                        nama_user: $('#nama_user').val(),
                        username: $('#username').val(),
                        password: $('#password').val(),
                        alamat_user: $('#alamat_user').val(),
                        telepon: $('#telepon').val(),
                        email: $('#email').val(),
                        hak_akses: $('#hak_akses').val(),
                        STATUS_USER: $('#status_user').val()
                    })
                    .then(function(response) {
                        if (response.data.status === "success") {
                            Swal.fire({
                                    title: "Success!",
                                    text: "Data Berhasil Diubah",
                                    icon: "success"
                                })
                                .then(() => {
                                    $('#user-table').DataTable().ajax.reload(null, false);
                                    $('#editUser').modal('hide');
                                });
                        } else {
                            $('#doneEdit').prop('disabled', false);
                            Swal.fire('Gagal!', response.data.message, 'error');
                        }
                    })
                    .catch(() => {
                        Swal.fire('Gagal!', 'Data gagal diubah.', 'error');
                        $('#doneEdit').prop('disabled', false);
                    });
            });

            // ====================== DELETE USER ======================
            window.deleteUser = function(id, status_user) {
                const isPermanent = status_user == 2;
                Swal.fire({
                    title: isPermanent ? 'HAPUS PERMANEN?' : 'Apakah anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const url = isPermanent ? '/user/deletePermanent/' : '/user/';
                        axiosDelete(url + id)
                            .then(() => {
                                Swal.fire({
                                        title: "Success!",
                                        text: "Data Berhasil Dihapus",
                                        icon: "success"
                                    })
                                    .then(() => $('#user-table').DataTable().ajax.reload(null,
                                        false));
                            })
                            .catch(() => Swal.fire('Gagal!', 'Data gagal dihapus.', 'error'));
                    }
                });
            };

            // Reset form saat modal tambah dibuka
            $('#tambahUser').on('click', function() {
                $('#doneAdd').prop('disabled', false);
            });
        });
    </script>
@endsection
