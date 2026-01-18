el('delete').onclick = async() => {
    const name = inputs.name.value;

    const confirmSwal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-outline mr-4",
            denyButton: "btn btn-error"
        },
        buttonsStyling: false
    });

    const confirm = await confirmSwal.fire({
        title: 'Konfirmasi',
        text: `Apakah Anda benar-benar yakin ingin menghapus data jemaat ${name}?`,
        icon: 'warning',
        showCloseButton: true,
        showDenyButton: true,
        focusConfirm: false,
        confirmButtonText: 'Iya, hapus data',
        denyButtonText: 'Tidak, batalkan!',
    });

    if (confirm.isConfirmed) {
        const result = await fetch(`/members/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        if (!result.ok) {
            sendAlert({
                title: 'Gagal', icon: 'error',
                text: `Maaf, sistem gagal menghapus data jemaat ${name} karena terdapat masalah teknis`
            });
            return;
        }

        await Swal.fire({
            title: 'Berhasil',
            text: `Data jemaat ${name} telah dihapus`,
            icon: 'success',
            confirmButtonText: 'OK'
        });

        window.location.href = '/members';
    }
}
