@extends('admin.app', ['menu' => 'userAdmin'])
@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <h4 class="mb-5">User</h4>
        <div class="widget-content widget-content-area br-6">
            <button type="button" class="btn btn-primary add-button" id="tambahUser" data-bs-toggle="modal" data-bs-target="#addUser">
                Tambah User
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-plus">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </button>
            <div class="table-responsive mb-4 mt-4">
                <table id="tableuser" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center sorting_asc" aria-sort="ascending">#</th>
                            <th>ID User</th>
                            <th>Nama User</th>
                            <th>Username</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Status User</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr data-id="{{ $user->id_user }}">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $user->id_user }}</td>
                                <td>{{ $user->nama_user }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->telepon }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->STATUS_USER == 0)
                                        <span class="shadow-none badge badge-primary">Belum Terverifikasi</span>
                                    @elseif($user->STATUS_USER == 1)
                                        <span class="shadow-none badge badge-success">Terverifikasi</span>
                                    @else
                                        <span class="shadow-none badge badge-danger">NON-AKTIF</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <ul class="table-controls">
                                        <button type="button" class="btn btn-primary edit-button"
                                            data-id="{{ $user->id_user }}" onclick="editUser('{{ $user->id_user }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-edit-2">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg>
                                        </button>
                                        <button type="button" class="btn btn-primary delete-button"
                                            data-id="{{ $user->id_user }}"
                                            onclick="deleteUser('{{ $user->id_user }}','{{ $user->STATUS_USER }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </button>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">#</th>
                            <th>ID User</th>
                            <th>Nama User</th>
                            <th>Username</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Status User</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal for Edit --}}
    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editUserLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="id_user">ID User</label>
                        <input type="text" class="form-control" id="id_user" name="id_user" placeholder="ID User"
                            readonly>
                    </div>
                    <div class="form-group mb-4">
                        <label for="nama_user">Nama User</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user"
                            placeholder="Nama User" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Username" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Password" >
                    </div>
                    <div class="form-group mb-4">
                        <label for="alamat_user">Alamat User</label>
                        <textarea class="form-control" id="alamat_user" name="alamat_user" placeholder="Alamat Member" required></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="telepon">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Telepon"
                            required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="status_user">Status User</label>
                        <select class="form-control" id="status_user" name="STATUS_USER" required>
                            <option value="0">BARU</option>
                            <option value="1">AKTIF</option>
                            <option value="2">NON-AKTIF</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" id="doneEdit" class="btn btn-primary">Simpan</button>
                </div>

            </div>
        </div>
    </div>


    {{-- Modal for Add --}}
    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="addUserLabel">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="nama_user_new">Nama User</label>
                        <input type="text" class="form-control" id="nama_user_new" name="nama_user"
                            placeholder="Nama User" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="username_new">Username</label>
                        <input type="text" class="form-control" id="username_new" name="username"
                            placeholder="Username" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="password_new">Password</label>
                        <input type="password" class="form-control" id="password_new" name="password"
                            placeholder="Password" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="alamat_user_new">Alamat User</label>
                        <textarea class="form-control" id="alamat_user_new" name="alamat_user" placeholder="Alamat Member" required></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="telepon_new">Telepon</label>
                        <input type="text" class="form-control" id="telepon_new" name="telepon"
                            placeholder="Telepon" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="email_new">Email</label>
                        <input type="email" class="form-control" id="email_new" name="email" placeholder="Email"
                            required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="status_user_new">Status User</label>
                        <select class="form-control" id="status_user_new" name="STATUS_USER">
                            <option value="0">BARU</option>
                            <option value="1">AKTIF</option>
                            <option value="2">NON-AKTIF</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" id="doneAdd" class="btn btn-primary">Simpan</button>
                </div>

            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $('#tableuser').dataTable();
            const inputMaskOptions = {
                prefix: '',
                groupSeparator: '.',
                radixPoint: ',',
                alias: 'numeric',
                autoGroup: true,
                digits: 0,
                digitsOptional: false,
                clearMaskOnLostFocus: false,
                removeMaskOnSubmit: true,
                rightAlign: false
            };




            // //tambahUser get axios
            // $('#tambahUser').on('click', function() {
            //    axiosGet('/user/getSettings')
            //         .then(function(response) {
            //             var data = response.data.data;

            //            //potongan_terlambat_new

            //             // $('#potongan_terlambat_new').val(data.denda_keterlambatan);

            //         })
            //         .catch(function(error) {
            //             console.log(error);
            //         });
            // });

            $('#doneAdd').click(function() {
                var nama_user = $('#nama_user_new').val();
                var username = $('#username_new').val();
                var password = $('#password_new').val();
                var alamat_user = $('#alamat_user_new').val();
                var telepon = $('#telepon_new').val();
                var email = $('#email_new').val();

                var gaji_harian = $('#gaji_harian_new').val();
                gaji_harian=gaji_harian.replace(/[^0-9]/g, '');
                var uang_makan = $('#uang_makan_new').val();
                uang_makan=uang_makan.replace(/[^0-9]/g, '');
                var lembur = $('#lembur_new').val();
                lembur=lembur.replace(/[^0-9]/g, '');
                // var bonus = $('#bonus_new').val();
                var potongan_terlambat = $('#potongan_terlambat_new').val();
                potongan_terlambat=potongan_terlambat.replace(/[^0-9]/g, '');
                // var potongan_tidak_masuk = $('#potongan_tidak_masuk_new').val();
                // var potongan_lain_lain = $('#potongan_lain_lain_new').val();

                var hak_akses = $('#hak_akses_new').val();
                var status_user = $('#status_user_new').val();
                var check_mengikuti_pengaturan_toko = $('#check_mengikuti_pengaturan_toko_new').is(':checked') ? 1 : 0;
                axiosPost('/user/add', {
                        nama_user: nama_user,
                        username: username,
                        password: password,
                        alamat_user: alamat_user,
                        telepon: telepon,
                        email: email,
                       // NIK: nik,

                        gaji_harian: gaji_harian,
                        uang_makan: uang_makan,
                        lembur: lembur,
                        // bonus: bonus,
                        potongan_terlambat: potongan_terlambat,
                        // potongan_tidak_masuk: potongan_tidak_masuk,
                        // potongan_lain_lain: potongan_lain_lain,
                        hak_akses: hak_akses,
                        STATUS_USER: status_user,
                        check_mengikuti_pengaturan_toko: check_mengikuti_pengaturan_toko
                    })
                    .then(function(response) {
                        if (response.data.status == "success") {
                            Swal.fire({
                                title: "Success!",
                                text: "Data Berhasil Ditambahkan",
                                icon: "success",
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Gagal!',
                                response.data.message,
                                'error'
                            )
                        }
                    })
                    .catch(function(error) {
                        Swal.fire(
                            'Gagal!',
                            'Data gagal ditambahkan.',
                            'error'
                        )
                    });
            });

            $('#doneEdit').click(function() {
                var id_user = $('#id_user').val();
                var nama_user = $('#nama_user').val();
                var username = $('#username').val();
                var password = $('#password').val();
                var alamat_user = $('#alamat_user').val();
                var telepon = $('#telepon').val();
                var email = $('#email').val();
                //var nik = $('#nik').val();
                var gaji_harian = $('#gaji_harian').val();
                gaji_harian=gaji_harian.replace(/[^0-9]/g, '');
                var uang_makan = $('#uang_makan').val();
                uang_makan=uang_makan.replace(/[^0-9]/g, '');
                var lembur = $('#lembur').val();
                lembur=lembur.replace(/[^0-9]/g, '');
                // var bonus = $('#bonus').val();
                var potongan_terlambat = $('#potongan_terlambat').val();
                potongan_terlambat=potongan_terlambat.replace(/[^0-9]/g, '');
                // var potongan_tidak_masuk = $('#potongan_tidak_masuk').val();
                // var potongan_lain_lain = $('#potongan_lain_lain').val();
                var hak_akses = $('#hak_akses').val();
                var status_user = $('#status_user').val();
                var check_mengikuti_pengaturan_toko = $('#check_mengikuti_pengaturan_toko').is(':checked') ? 1 : 0;


                axiosPut('/user/' + id_user, {
                        nama_user: nama_user,
                        username: username,
                        password: password,
                        alamat_user: alamat_user,
                        telepon: telepon,
                        email: email,
                        //NIK: nik,
                        gaji_harian: gaji_harian,
                        uang_makan: uang_makan,
                        lembur: lembur,
                        // bonus: bonus,
                        potongan_terlambat: potongan_terlambat,
                        // potongan_tidak_masuk: potongan_tidak_masuk,
                        // potongan_lain_lain: potongan_lain_lain,
                        hak_akses: hak_akses,
                        STATUS_USER: status_user,
                        check_mengikuti_pengaturan_toko: check_mengikuti_pengaturan_toko
                    })
                    .then(function(response) {
                        if (response.data.status == "success") {
                            Swal.fire({
                                title: "Success!",
                                text: "Data Berhasil Diubah",
                                icon: "success",
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Gagal!',
                                response.data.message,
                                'error'
                            )
                        }
                    })
                    .catch(function(error) {
                        Swal.fire(
                            'Gagal!',
                            'Data gagal diubah.',
                            'error'
                        )
                    });
            });














            window.deleteUser = function(id, status_user) {
                //if status user already 2 then do delete permanent


                if (status_user != 2) {

                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axiosDelete('/user/' + id)
                                .then(function(response) {
                                    if (response.data.status == "success") {
                                        Swal.fire({
                                            title: "Success!",
                                            text: "Data Berhasil Dihapus",
                                            icon: "success"



                                        }).then(() => {
                                            location.reload();
                                        });




                                    } else {
                                        Swal.fire(
                                            'Gagal!',
                                            'Data gagal dihapus.',
                                            'error'
                                        )
                                    }
                                })
                                .catch(function(error) {
                                    Swal.fire(
                                        'Gagal!',
                                        'Data gagal dihapus.',
                                        'error'
                                    )
                                });
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'HAPUS PERMANEN?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axiosDelete('/user/deletePermanent/' + id)
                                .then(function(response) {
                                    if (response.data.status == "success") {
                                        Swal.fire({
                                            title: "Success!",
                                            text: "Data Berhasil Dihapus",
                                            icon: "success"
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire(
                                            'Gagal!',
                                            'Data gagal dihapus.',
                                            'error'
                                        )
                                    }
                                })
                                .catch(function(error) {
                                    Swal.fire(
                                        'Gagal!',
                                        'Data gagal dihapus.',
                                        'error'
                                    )
                                });
                        }
                    });


                }
            }
            window.editUser = function(id) {
                axiosGet('/user/detail/' + id)
                    .then(function(response) {
                        // return response()->json(['status' => 'success', 'data' => $user]);
                        var data = response.data.data;

                        $('#id_user').val(data.id_user);
                        $('#nama_user').val(data.nama_user);
                        $('#username').val(data.username);
                        $('#password').val(data.password);

                        $('#alamat_user').val(data.alamat_user);
                        $('#telepon').val(data.telepon);
                        $('#email').val(data.email);
                        //$('#nik').val(data.NIK);
                        $('#gaji_harian').val(data.gaji_harian);
                        $('#uang_makan').val(data.uang_makan);
                        $('#lembur').val(data.lembur);
                        // $('#bonus').val(data.bonus);
                        $('#potongan_terlambat').val(data.potongan_terlambat);
                        // $('#potongan_tidak_masuk').val(data.potongan_tidak_masuk);
                        // $('#potongan_lain_lain').val(data.potongan_lain_lain);

                        $('#hak_akses').val(data.id_hak_akses);
                        $('#status_user').val(data.STATUS_USER);
                        $('#check_mengikuti_pengaturan_toko').prop('checked', data.check_mengikuti_pengaturan_toko == 1 ? true : false);
                        //triggre check_mengikuti_pengaturan_toko
                        if (data.check_mengikuti_pengaturan_toko == 1) {
                            $('#potongan_terlambat').prop('disabled', true);
                        } else {
                            $('#potongan_terlambat').prop('disabled', false);
                        }

                        $('#editUser').modal('show');
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }


            //gaji_harian_new on change
            function kalkulasiPotonganTidakMasuk() {
                var gaji_harian = $('#gaji_harian_new').val();
                var uang_makan = $('#uang_makan_new').val();
                var potongan_tidak_masuk = (parseFloat(gaji_harian) + parseFloat(uang_makan)) * 0.8;
                $('#potongan_tidak_masuk_new').val(potongan_tidak_masuk);
            }

            $('#gaji_harian_new').on('change', kalkulasiPotonganTidakMasuk);
            $('#uang_makan_new').on('change', kalkulasiPotonganTidakMasuk);













        });
    </script>
@endsection
