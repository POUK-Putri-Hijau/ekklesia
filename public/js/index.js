const el = (id) => document.getElementById(id);
const elName = (name) => document.getElementsByName(name)[0];

let hidden = true;
let tryingToLogin = false;

const toggleHide = (element, hide) => {
    if (hide) {
        element.classList.add('hidden');
    } else {
        element.classList.remove('hidden');
    }
}


const toast = el('toast');
const alert = el('alert');

const email = elName('email');
email.keyup = () => {
    if (!hidden) toggleHide(toast, true);
}

const password = elName('password');
password.keyup = () => {
    if (!hidden) toggleHide(toast, true);
}


el('login').onclick = async() => {
    if (!tryingToLogin) {
        tryingToLogin = true;
        return await login();
    }
}

password.onkeyup = async(e) => {
    if (e.key === 'Enter' && !tryingToLogin) {
        tryingToLogin = true;
        return await login();
    }
}

async function login() {
    const emailValue = email.value;
    if (!emailValue || email.validity.typeMismatch) {
        email.setCustomValidity('Mohon mengetik alamat email Anda dengan benar');
        email.reportValidity();
        tryingToLogin = false;
        return;
    }

    const passwdValue = password.value;
    if (!passwdValue || passwdValue.length < 8) {
        password.setCustomValidity('Mohon mengetik kata sandi Anda dengan benar');
        password.reportValidity();
        tryingToLogin = false;
        return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    if (!csrfToken) return;

    const res = await fetch('/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            email: emailValue,
            password: passwdValue,
        })
    });

    const body = await res.json();

    const alertMsg = el('alert-msg');

    if (!res.ok) {
        alert.className = 'alert alert-error';
        alertMsg.innerText = body.error;
        toggleHide(toast);
        tryingToLogin = false;
        return;
    }

    alert.className = 'alert alert-success';
    alertMsg.innerText = 'Berhasil masuk akun, tunggu 3 detik';
    toggleHide(toast);

    setTimeout(function() {
        window.location.href = '/dashboard';
    }, 3000);
}
