const el = (id) => document.getElementById(id);
const elName = (name) => document.getElementsByName(name)[0];

let csrfToken;
setTimeout(() => {
    csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    if (!csrfToken) {
        sendAlert({
            title: 'Gagal', icon: 'error',
            text: 'Maaf, terjadi kesalahan pada halaman ini, mohon reload halaman'
        });
    }
}, 500);


const inputs = {
    name: elName('name'),
    email: elName('email'),
    password: elName('password')
}

el('send').onclick = async() => {
    const body = {};

    const name = inputs.name.value.trim();
    if (!name) {
        showError('Maaf, kolom nama akun tidak boleh kosong');
        return;
    }
    body.name = name;

    const email = inputs.email.value.trim();
    if (!email) {
        showError('Maaf, kolom alamat email tidak boleh kosong');
        return;
    }
    body.email = email;

    const password = inputs.password.value.trim();
    if (password) {
        if ((password.length < 8 || password.length > 64)) {
            showError(`Maaf, kata sandi Anda terlalu ${password.length < 8 ? 'pendek' : 'panjang'}`);
            return;
        } else {
            body.password = password;
        }
    }

    const result = await fetch('/profile', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(body),
    });

    if (!result.ok) {
        showError('Maaf, terjadi kesalahan saat mengirim data, mohon cek ulang data dan pastikan sudah benar.');
        return;
    }

    await Swal.fire({
        title: 'Berhasil',
        html: 'Data akun berhasil diubah.',
        icon: 'success',
        confirmButtonText: 'OK',
        timer: 3000,
        timerProgressBar: true
    });

    window.location.href = '/profile';
}

function showError(message) {
    Swal.fire({
        title: 'Gagal', icon: 'error',
        text: message
    });
}
