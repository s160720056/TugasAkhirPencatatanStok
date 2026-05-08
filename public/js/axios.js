// global.js - Custom Swal Loading Functions

// Fungsi untuk menampilkan loading
window.showSwalLoading = function(message = 'Memuat...') {
    Swal.fire({
        title: message,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
};

// Fungsi untuk menutup loading
window.closeSwalLoading = function() {
    Swal.close();
};

// Fungsi wrapper untuk axios dengan loading otomatis
window.axiosWithLoading = async function(config, loadingMessage = 'Memuat...') {
    try {
        showSwalLoading(loadingMessage);
        const response = await axios(config);
        closeSwalLoading();
        return response;
    } catch (error) {
        closeSwalLoading();
        throw error;
    }
};

// Fungsi wrapper untuk axiosGet dengan loading otomatis
window.axiosGet = function(url, loadingMessage = 'Memuat...') {
    return axiosWithLoading({
        method: 'GET',
        url: url
    }, loadingMessage);
};

// Fungsi wrapper untuk axiosPost dengan loading otomatis
window.axiosPost = function(url, data, loadingMessage = 'Menyimpan...') {
    return axiosWithLoading({
        method: 'POST',
        url: url,
        data: data
    }, loadingMessage);
};

// Fungsi wrapper untuk axiosPut dengan loading otomatis
window.axiosPut = function(url, data, loadingMessage = 'Mengupdate...') {
    return axiosWithLoading({
        method: 'PUT',
        url: url,
        data: data
    }, loadingMessage);
};

// Fungsi wrapper untuk axiosDelete dengan loading otomatis
window.axiosDelete = function(url, loadingMessage = 'Menghapus...') {
    return axiosWithLoading({
        method: 'DELETE',
        url: url
    }, loadingMessage);
};

// Alternatif: Interceptor Axios untuk loading otomatis (lebih advance)
let loadingCount = 0;

// Setup axios interceptors sekali saja
if (typeof window.axiosInterceptorsSetup === 'undefined') {
    window.axiosInterceptorsSetup = true;
    
    // Request interceptor
    axios.interceptors.request.use(function(config) {
        // Jangan tampilkan loading untuk request tertentu (opsional)
        const skipLoading = config.skipLoading || config.url.includes('/skip-loading');
        
        if (!skipLoading && loadingCount === 0) {
            // Tampilkan loading
            Swal.fire({
                title: 'Memuat...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }
        loadingCount++;
        return config;
    }, function(error) {
        loadingCount--;
        if (loadingCount === 0) {
            Swal.close();
        }
        return Promise.reject(error);
    });

    // Response interceptor
    axios.interceptors.response.use(function(response) {
        loadingCount--;
        if (loadingCount === 0) {
            Swal.close();
        }
        return response;
    }, function(error) {
        loadingCount--;
        if (loadingCount === 0) {
            Swal.close();
        }
        return Promise.reject(error);
    });
}