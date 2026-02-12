const el = (id) => document.getElementById(id);
const elName = (name) => document.getElementsByName(name)[0];

let csrfToken;
const PHOTO_EXTENTIONS = ['jpg','jpeg','png'];
const MAX_BYTES = 5 * 1024 * 1024;

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
    birthDate: {
        day: elName('birth-date-day'),
        month: elName('month'),
        year: elName('birth-date-year'),
    },
    address: elName('address'),
    phone: elName('phone-number'),
    familyName: elName('family-name'),
    photo: elName('photo'),
}

elName('phone-number').onpaste = async(e) => {
    e.preventDefault();
    const text = e.clipboardData.getData('text');
    e.target.value = text.replace(/ /g, '');
}

el('send').onclick = async() => {
    const name = (inputs.name.value).trim();
    if (!nameIsValid(name)) return;

    const birthDate = {
        day: inputs.birthDate.day.value,
        month: inputs.birthDate.month.value,
        year: inputs.birthDate.year.value,
    }
    if (!dateIsValid(birthDate.day)) return;
    if (!monthIsValid(birthDate.month)) return;
    if (!yearIsValid(birthDate.year)) return;

    const address = inputs.address.value;
    if (!addressIsValid(address)) return;

    const phoneNumber = inputs.phone.value;
    if (!phoneNumberIsValid(phoneNumber)) return;

    const familyName = inputs.familyName.value;
    if (!familyIsValid(familyName)) return;

    const photo = inputs.photo.files[0];
    if (!photoIsValid(photo)) {
        Swal.fire({
            title: 'Gagal',
            html: 'Maaf, foto jemaat tidak valid.',
            icon: 'error',
            confirmButtonText: 'OK',
        });
        return;
    }

    const form = new FormData();
    form.append('name', name);
    form.append('birth-date-day', birthDate.day);
    form.append('birth-date-month', birthDate.month);
    form.append('birth-date-year', birthDate.year);
    form.append('address', address);

    if (phoneNumber) {
        form.append('phone-number', phoneNumber);
    }

    if (familyName) {
        form.append('family-name', familyName);
    }

    if (photo) {
        form.append('photo', inputs.photo.files[0]);
    }

    const result = await fetch('/members', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        body: form,
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
        html: 'Data jemaat telah dicatat.',
        icon: 'success',
        confirmButtonText: 'OK',
        timer: 3000,
        timerProgressBar: true
    });

    window.location.href = '/members';
}

function nameIsValid(name) {
    if (!name) {
        sendAlert({
            title: 'Gagal', text: 'Kolom nama jemaat tidak boleh kosong', icon: 'error'
        });
        return false;
    }

    if (name.length < 3) {
        sendAlert({
            title: 'Gagal', text: 'Nama jemaat terlalu pendek', icon: 'error'
        });
        return false;
    }

    if (/\d/.test(name)) {
        sendAlert({
            title: 'Gagal', text: 'Nama jemaat tidak boleh mengandung angka', icon: 'error'
        });
        return false;
    }

    return true;
}

function dateIsValid(day) {
    if (!day || day < 1 || day > 31) {
        sendAlert({
            title: 'Gagal', text: 'Tanggal lahir jemaat tidak valid', icon: 'error', btnText: 'Oke'
        });
        return false;
    }

    return true;
}

function monthIsValid(month) {
    if (month === 'Pilih bulan') {
        // hehe
        sendAlert({
            title: 'Gagal', text: 'Maaf, bulan lahir belum dipilih', icon: 'error'
        });
        return false;
    }

    if (!month || isNaN(parseInt(month)) || parseInt(month) < 1 || parseInt(month) > 12) {
        sendAlert({
            title: 'Gagal', text: 'Bulan lahir jemaat tidak valid', icon: 'error'
        });
        return false;
    }

    return true;
}

function yearIsValid(year) {
    if (!year || year < 1900 || year > new Date().getFullYear()) {
        sendAlert({
            title: 'Gagal', text: 'Tahun lahir jemaat tidak valid', icon: 'error', btnText: 'Oke'
        });
        return false;
    }

    return true;
}

function addressIsValid(address) {
    if (!address) {
        sendAlert({
            title: 'Gagal', text: 'Alamat jemaat tidak boleh kosong', icon: 'error'
        });
        return false;
    }

    if (address.length < 9) {
        sendAlert({
            title: 'Gagal', text: 'Alamat jemaat terlalu pendek', icon: 'error'
        });
        return false;
    }

    if (address.length > 256) {
        sendAlert({
            title: 'Gagal', text: 'Alamat jemaat terlalu panjang', icon: 'error'
        });
        return false;
    }

    return true;
}

function phoneNumberIsValid(phoneNumber) {
    if (!phoneNumber) return true;

    if (!phoneNumber.startsWith('+') && !phoneNumber.startsWith('0')) {
        sendAlert({
            title: 'Gagal', text: 'Maaf, nomor telepon tidak valid', icon: 'error'
        });
        return false;
    }

    if (phoneNumber.length < 9) {
        sendAlert({
            title: 'Gagal', text: 'Nomor telepon terlalu pendek', icon: 'error'
        });
        return false;
    }

    if (phoneNumber.length > 15) {
        sendAlert({
            title: 'Gagal', text: 'Nomor telepon terlalu panjang', icon: 'error'
        });
        return false;
    }

    return true;
}

function familyIsValid(familyName) {
    if (!familyName) return true;

    if (familyName.length < 9) {
        sendAlert({
            title: 'Gagal', icon: 'error',
            text: 'Maaf, nama keluarga terlalu pendek.'
        });
        return false;
    }

    if (familyName.length > 70) {
        sendAlert({
            title: 'Gagal', icon: 'error',
            text: 'Maaf, nama keluarga terlalu panjang.'
        });
        return false;
    }

    if (/\d/.test(familyName)) {
        sendAlert({
            title: 'Gagal', text: 'Nama keluarga tidak boleh mengandung angka', icon: 'error'
        });
        return false;
    }

    return true;
}

function photoIsValid(photo) {
    if (!photo) return true;

    const m = photo.name?.split('.').pop();
    const ext = m ? m.toLowerCase() : '';

    if (!PHOTO_EXTENTIONS.includes(ext)) return false;

    return photo.size <= MAX_BYTES;
}
