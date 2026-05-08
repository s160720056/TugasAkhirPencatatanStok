<div class="text-center">
    <h5 class="mb-3">Setup 2FA untuk <strong>{{ $user->username }}</strong></h5>
    
    <p class="text-muted">Scan QR Code ini dengan Google Authenticator / Authy / Microsoft Authenticator</p>

    <div class="d-inline-block bg-white p-3 rounded shadow-sm mb-4">
        {!! $qrCodeInline !!}
    </div>

    <div class="mb-4">
        <small class="text-muted">Atau masukkan manual:</small><br>
        <code class="fs-6">{{ $user->two_factor_secret }}</code>
    </div>

    <hr>

    <form id="confirm2FAForm" data-id="{{ $user->id_user }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Masukkan kode 6 digit dari aplikasi Anda</label>
            <input type="text" 
                   name="code" 
                   id="2fa-code-input"
                   class="form-control form-control-lg text-center" 
                   maxlength="6" 
                   autocomplete="off" 
                   autofocus 
                   required>
        </div>

        <button type="submit" class="btn btn-success btn-lg w-100">
            Konfirmasi & Aktifkan 2FA
        </button>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#confirm2FAForm').on('submit', function(e) {
        e.preventDefault();
        const userId = $(this).data('id');
        const code = $('#2fa-code-input').val();

        axiosPost(`/2fa/setup/confirm/${userId}`, { code: code })
            .then(function(response) {
                if (response.data.status === 'success') {
                    Swal.fire('Berhasil!', response.data.message, 'success')
                        .then(() => {
                            $('#setup2FAModal').modal('hide');
                            $('#user-table').DataTable().ajax.reload(null, false);
                        });
                }
            })
            .catch(function(error) {
                Swal.fire('Gagal!', error.response.data.message || 'Kode tidak valid.', 'error');
            });
    });
});
</script>