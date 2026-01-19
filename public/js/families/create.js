const el = (id) => document.getElementById(id);
const elName = (name) => document.getElementsByName(name)[0];
let csrfToken;

function sendAlert({ title, text, icon }) {
    Swal.fire({
        title, text, icon, confirmButtonText: 'OK',
    });
}

setTimeout(() => {
    csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    if (!csrfToken) {
        sendAlert({
            title: 'Gagal', icon: 'error',
            text: 'Maaf, terjadi kesalahan pada halaman ini, mohon reload halaman'
        });
    }
}, 3000);

const inputs = {
    name: elName('name'),
    weddingDate: {
        day: elName('wedding-date-day'),
        month: elName('month'),
        year: elName('wedding-date-year'),
    }
}

el('send').onclick = async() => {
    const name = (inputs.name.value).trim();
    if (!nameIsValid(name)) return;

    const weddingDate = {
        day: inputs.weddingDate.day.value,
        month: inputs.weddingDate.month.value,
        year: inputs.weddingDate.year.value,
    }
    if (!dateIsValid(weddingDate.day)) return;
    if (!monthIsValid(weddingDate.month)) return;
    if (!yearIsValid(weddingDate.year)) return;

    const body = {
        name,
        'wedding-date-day': weddingDate.day,
        'wedding-date-month': weddingDate.month,
        'wedding-date-year': weddingDate.year,
    }

    const result = await fetch('/families', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(body),
    });

    if (!result.ok) {
        sendAlert({
            title: 'Gagal', icon: 'error',
            text: 'Maaf, terjadi kesalahan saat mengirim data, mohon cek ulang data dan pastikan sudah benar.'
        });
        return;
    }

    await Swal.fire({
        title: 'Berhasil',
        html: 'Data keluarga telah dicatat.',
        icon: 'success',
        confirmButtonText: 'OK',
        timer: 3000,
        timerProgressBar: true
    });

    window.location.href = '/families';
}

function nameIsValid(name) {
    if (!name) return true;

    if (name.length < 9) {
        sendAlert({
            title: 'Gagal', icon: 'error',
            text: 'Maaf, nama keluarga terlalu pendek.'
        });
        return false;
    }

    if (name.length > 70) {
        sendAlert({
            title: 'Gagal', icon: 'error',
            text: 'Maaf, nama keluarga terlalu panjang.'
        });
        return false;
    }

    if (/\d/.test(name)) {
        sendAlert({
            title: 'Gagal', text: 'Nama keluarga tidak boleh mengandung angka', icon: 'error'
        });
        return false;
    }

    return true;
}

function dateIsValid(day) {
    if (!day || day < 1 || day > 31) {
        sendAlert({
            title: 'Gagal', text: 'Tanggal pernikahan tidak valid', icon: 'error', btnText: 'Oke'
        });
        return false;
    }

    return true;
}

function monthIsValid(month) {
    if (month === 'Pilih bulan') {
        // hehe
        sendAlert({
            title: 'Gagal', text: 'Maaf, bulan pernikahan belum dipilih', icon: 'error'
        });
        return false;
    }

    if (!month || isNaN(parseInt(month)) || parseInt(month) < 1 || parseInt(month) > 12) {
        sendAlert({
            title: 'Gagal', text: 'Bulan pernikahan tidak valid', icon: 'error'
        });
        return false;
    }

    return true;
}

function yearIsValid(year) {
    if (!year || year < 1900 || year > new Date().getFullYear()) {
        sendAlert({
            title: 'Gagal', text: 'Tahun pernikahan tidak valid', icon: 'error', btnText: 'Oke'
        });
        return false;
    }

    return true;
}
