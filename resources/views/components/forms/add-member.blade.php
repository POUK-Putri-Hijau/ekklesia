@props([
    'families' => []
])

<fieldset class="fieldset rounded-box text-black w-full md:w-2xl p-4">
    <label class="text-lg">Nama Lengkap</label>
    <input type="text" name="name" class="input w-full" maxlength="60" minlength="3" />

    <label class="text-lg mt-4">Tanggal Lahir</label>
    <div class="flex gap-4">
        <div class="flex-1">
            <label class="text-sm">Tanggal (1-31)</label>
            <input type="text" name="birth-date-day" class="input w-full" minlength="1" maxlength="2" />
        </div>
        <div class="flex-1">
            <label class="text-sm">Bulan</label>
            <x-inputs.month></x-inputs.month>
        </div>
        <div class="flex-1">
            <label class="text-sm">Tahun</label>
            <input type="text" name="birth-date-year" class="input w-full" minlength="4" maxlength="4" />
        </div>
    </div>

    <label class="text-lg mt-4">Alamat Tempat Tinggal</label>
    <textarea name="address" class="textarea w-full" rows="4" minlength="9" maxlength="256"></textarea>

    <label class="text-lg mt-4">Nomor Telepon / WA (Opsional)</label>
    <input type="text" name="phone-number" class="input w-full" minlength="9" maxlength="15" />

    <label class="text-lg mt-4">Keluarga (Opsional)</label>
    <x-inputs.family :families="$families"></x-inputs.family>

    <button class="btn btn-info mt-4" id="send">Kirim</button>
</fieldset>
