@props([
    'family' => []
])

<fieldset class="fieldset rounded-box text-black w-full md:w-2xl p-4">
    <label class="text-lg">Nama Akun</label>
    <input
        type="text" name="name"
        class="input w-full" maxlength="60"
        minlength="3" value="{{ Auth::user()->name }}"
    />

    <label class="text-lg mt-4">Alamat Email</label>
    <input
        type="email" name="email"
        class="input w-full" maxlength="64"
        minlength="8" value="{{ Auth::user()->email }}"
    />

    <label class="text-lg mt-4">Kata Sandi</label>
    <input type="password" name="password" class="input w-full" maxlength="64" minlength="8" />

    <button class="btn btn-info mt-4" id="send">Ubah Data</button>
    <a href="{{ @route('logout') }}" class="btn btn-error mt-8">Keluar Akun</a>
</fieldset>
