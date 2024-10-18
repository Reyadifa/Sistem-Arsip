

// Pop Hapus User


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

            Swal.fire({
                title: "Deleted!",
                text: "User has been deleted.",
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => {
            
                document.getElementById('delete-form-' + id).submit();
            });
        }
    });
}

