const el = (id) => document.getElementById(id);
const elName = (name) => document.getElementsByName(name)[0];

const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
const parts = window.location.pathname.split('/').filter(Boolean);
const id = parts[1] ?? null;

function sendAlert({ title, text, icon }) {
    Swal.fire({
        title, text, icon, confirmButtonText: 'OK',
    });
}

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
        'wedding-date-day': parseInt(weddingDate.day),
        'wedding-date-month': weddingDate.month,
        'wedding-date-year': weddingDate.year,
    }

    const result = await fetch(`/families/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(body),
    });

    console.log(result);
    if (!result.ok) {
        Swal.fire({
            title: 'Gagal',
            text: 'Maaf, terjadi kesalahan saat mengirim data, mohon cek ulang data dan pastikan sudah benar.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return;
    }

    await Swal.fire({
        title: 'Berhasil',
        text: 'Data keluarga telah diubah',
        icon: 'success',
        confirmButtonText: 'OK'
    });

    window.location.href = window.location.href;
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
