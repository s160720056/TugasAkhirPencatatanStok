@extends('admin.app', ['menu' => 'pengajuanToko'])
@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <h4 class="mb-5">Daftar Pengajuan Toko</h4>
        <div class="widget-content widget-content-area br-6">

            <div class="table-responsive mb-4 mt-4">
                <table id="default-ordering" class="table table-hover" style="width:100%">
                    <thead>

                    <tr>
                        <th>Logo Toko</th>
                        <th>Nama Toko</th>
                        <th>Nama Pemilik</th>
                        <th>Alamat Toko</th>
                        <th>No. Telp Toko</th>
                        <th>Email Toko</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($daftarPengajuanToko as $item)
                        <tr>
                            <td><img src="{{ asset('storage/' . $item->logo_toko) }}" alt="logo toko" style="width: 100px; height: 50px; cursor: pointer;" onclick="zoomImage(this)"></td>
                            <td>{{ $item->nama_toko }}</td>
                            <td>{{ $item->nama_pemilik }}</td>
                            <td>{{ $item->alamat_toko }}</td>
                            <td>{{ $item->tlp }}</td>
                            <td>{{ $item->email_toko }}</td>
                            <td>
                                @if ($item->status_pengajuan_toko == 'proses')
                                    <span class="badge badge-warning">Proses</span>
                                @elseif ($item->status_pengajuan_toko == 'diterima')
                                    <span class="badge badge-success">Diterima</span>
                                @else
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif




                            </td>
                            <td>
                                <span class="material-symbols-outlined" onclick="detailPengajuanToko({{ $item->id_toko }})" style="cursor: pointer;">
                                    search_insights
                                </span>
                                {{-- <span class="material-symbols-outlined" onclick="detailAnggotaToko({{ $item->id_toko }})" style="cursor: pointer;">
                                    conditions
                                </span> --}}

                            </td>
                        </tr>


                      @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Logo Toko</th>
                            <th>Nama Toko</th>
                            <th>Nama Pemilik</th>
                            <th>Alamat Toko</th>
                            <th>No. Telp Toko</th>
                            <th>Email Toko</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    {{-- modal detail pengajuan toko --}}
    <div class="modal fade" id="detailPengajuanToko" tabindex="-1" role="dialog" aria-labelledby="detailPengajuanTokoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document"> <!-- Changed modal-lg to modal-xl -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pengajuan Toko </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tablee" class="table tabelBawah table-hover" style="width:100%">
                       <thead>
                        <tr>
                            <th>Nama Toko</th>
                            <th>Nama Pemilik</th>
                            <th>Alamat Toko</th>
                            <th>No. Telp Toko</th>
                            <th>Email Toko</th>
                            <th>Status Pengajuan</th>
                            <th>Alasan Ditolak</th>
                        </tr>
                    </thead>
                    <tbody id="toko-details">
                        <!-- Details will be dynamically inserted here -->
                    </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <label for="status_pengajuan">Ubah Status Pengajuan</label>
                    <select class="form-control select2" id="status_pengajuan">
                        <option value="proses">Proses</option>
                        <option value="diterima">Diterima</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                    <span id="id_toko" style="display: none;"></span>
                    <button type="button" class="btn btn-primary" onclick="submitStatusChange()">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal detail anggota --}}
    <div class="modal fade" id="detailAnggota" tabindex="-1" role="dialog" aria-labelledby="detailAnggotaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document"> <!-- Changed modal-lg to modal-xl -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Anggota </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        
                    </button>
                </button>
                </div>
                <div class="modal-body">
                    <table id="tableee" class="table tabelBawah2 table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama Anggota</th>
                                <th>Username Anggota</th>
                                <th>Alamat Anggota</th>
                                <th>No. Telp Anggota</th>
                                <th>Email Anggota</th>
                                <th>Role Anggota</th>
                                <th>Status Anggota</th>
                            </tr>
                        </thead>
                        <tbody id="anggota-details">
                            <!-- Details will be dynamically inserted here -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $.fn.modal.Constructor.prototype._enforceFocus = function() {};
            // $('#default-ordering').DataTable();
            var tablee = $('.tabelBawah').DataTable();
            var tableee = $('.tabelBawah2').DataTable();
            zoomImage = function(image) {
                Swal.fire({
                    imageUrl: image.src,
                    imageWidth: 600,
                    imageHeight: 400,

                });
            }
            window.detailPengajuanToko = function(id) {
                tablee.destroy();
               axiosGet('detailPengajuanToko/' + id)
                    .then(function(response) {
                        let data = response.data.data;
                        let html = '';
                        $('#id_toko').html(data.id_toko);

                        html += '<tr>';
                        html += '<td>' + data.nama_toko + '</td>';
                        html += '<td>' + data.nama_pemilik + '</td>';
                        html += '<td>' + data.alamat_toko + '</td>';
                        html += '<td>' + data.tlp + '</td>';
                        html += '<td>' + data.email_toko + '</td>';
                        html += '<td>' + data.status_pengajuan_toko + '</td>';
                        html += '<td>' + data.alasan_ditolak + '</td>';
                        html += '</tr>';
                        $('#toko-details').html(html);
                        $('#detailPengajuanToko').modal('show');
                        tablee = $('.tabelBawah').DataTable();

                        $('#status_pengajuan').val(data.status_pengajuan_toko);



                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }

            window.detailAnggotaToko = function(id) {
                tableee.destroy();
                axiosGet('detailAnggotaToko/' + id)
                    .then(function(response) {
                        if (response.data.status == 'success') {
                            let data = response.data.data ?? "";
                            let html = '';

                            data.forEach(function(item) {
                                html += '<tr>';
                                html += '<td>' + item.nama_user + '</td>';
                                html += '<td>' + item.username + '</td>';
                                html += '<td>' + item.alamat_user + '</td>';
                                html += '<td>' + item.telepon + '</td>';
                                html += '<td>' + item.email + '</td>';
                                html += '<td>' + item.nama_hak_akses + '</td>';
                                if (item.STATUS_USER == 0) {
                                    html += '<td>Baru</td>';
                                } else if (item.STATUS_USER == 1) {
                                    html += '<td>Aktif</td>';
                                } else {
                                    html += '<td>Non Aktif</td>';
                                }
                                html += '</tr>';
                            });
                            $('#anggota-details').html(html);
                            $('#detailAnggota').modal('show');
                            tableee = $('.tabelBawah2').DataTable();
                        } else {
                            console.log('Failed to fetch data');
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }

            window.submitStatusChange = function() {
                let id_toko = $('#id_toko').html();
                let status_pengajuan = $('#status_pengajuan').val();

                if (status_pengajuan == 'ditolak') {
    Swal.fire({
        title: 'Mohon Sertakan Alasan Ditolak',
        input: 'textarea', // Use textarea for multi-line input
        inputAttributes: {
            'aria-label': 'Type your message here',
        },
        inputAutoFocus: true, // Ensure the input is focused
        showCancelButton: true,
        confirmButtonText: 'Submit',
        showLoaderOnConfirm: true,
        preConfirm: (alasan) => {
            if (!alasan) {
                Swal.showValidationMessage('Alasan tidak boleh kosong');
                return false;
            }
            return axiosPost('submitStatusChange', {
                id_toko: id_toko,
                status_pengajuan: status_pengajuan,
                alasan: alasan
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: "success",
                title: 'Berhasil',
                text: 'Status pengajuan berhasil diubah'
            });
            $('#detailPengajuanToko').modal('hide');
            location.reload();
        }
    }).catch((error) => {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Status pengajuan gagal diubah'
        });
        console.log(error);
    });
}
 else {
                    axiosPost('submitStatusChange', {
                        id_toko: id_toko,
                        status_pengajuan: status_pengajuan
                    }).then(function(response) {
                        if (response.data.status == 'success') {
                            Swal.fire({
                                icon: "success",
                                title: 'Berhasil',
                                text: 'Status pengajuan berhasil diubah'
                            });
                            $('#detailPengajuanToko').modal('hide');
                            location.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Status pengajuan gagal diubah'
                            });
                        }
                    }).catch(function(error) {
                        console.log(error);
                    });
                }
            }



        });
    </script>
@endsection
