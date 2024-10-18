

// pop up hapus


function confirmDelete(id) {
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Data ini akan dihapus dan tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus!"
    }).then((result) => {
        if (result.isConfirmed) {
            // Menampilkan notifikasi sukses
            Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => {
                // Menunggu beberapa detik sebelum submit form
                setTimeout(() => {
                    document.getElementById('delete-form-' + id).submit();
                }, 2000); // 1000 ms = 1 detik
            });
        }
    });
}
