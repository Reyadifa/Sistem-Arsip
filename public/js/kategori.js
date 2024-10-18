// pop up hapus

function confirmDelete(id) {
    Swal.fire({
        title: "Apakah anda yakin",
        text: "Ini tidak akan bisa kembali",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Hapus ini!"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Hapus!",
                text: "Kategori berhasil dihapus dan arsip terkait tetap ada.",
                icon: "success",
                confirmButtonText: "OK" 
            }).then(() => {
                document.getElementById('delete-form-' + id).submit();
            });
        }
    });
}


