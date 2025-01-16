
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Mencegah pengiriman form secara langsung

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak dapat mengembalikan arsip yang telah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#3085d6',  // Warna biru untuk tombol 'Ya, hapus!'
                cancelButtonColor: '#d33',   // Warna merah untuk tombol 'Batal'
                reverseButtons: false  // Mengatur tombol Batal di sebelah kanan
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Jika diklik 'Ya', kirim form untuk menghapus
                }
            });
        });
    });

