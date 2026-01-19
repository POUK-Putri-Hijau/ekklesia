@props([
    'member' => [],
    'families' => []
])

<fieldset class="fieldset rounded-box text-black w-full md:w-2xl p-4">
    <label class="text-lg">Nama Lengkap</label>
    <input type="text" name="name" class="input w-full" maxlength="60" minlength="3" value="{{ $member->name }}" />

    <label class="text-lg mt-4">Tanggal Lahir</label>
    <div class="flex gap-4">
        <div class="flex-1/12 md:flex-1">
            <label class="text-sm">Tanggal (1-31)</label>
            <input type="text" name="birth-date-day" class="input w-full" minlength="1" maxlength="2" value="{{ $member->day }}" />
        </div>
        <div class="flex-1">
            <label class="text-sm">Bulan</label>
            <x-inputs.month selected_month="{{ $member->month }}"></x-inputs.month>
        </div>
        <div class="flex-1">
            <label class="text-sm">Tahun</label>
            <input type="text" name="birth-date-year" class="input w-full" minlength="4" maxlength="4" value="{{ $member->year }}" />
        </div>
    </div>

    <label class="text-lg mt-4">Alamat Tempat Tinggal</label>
    <textarea
        name="address" class="textarea w-full" rows="4" minlength="9" maxlength="256"
    >{{ $member->address }}</textarea>

    <label class="text-lg mt-4">Nomor Telepon / WA (Opsional)</label>
    <input
        type="text" name="phone-number" class="input w-full"
        minlength="9" maxlength="15"  value="{{ $member->phone_number }}"
    />

    <label class="text-lg mt-4">Keluarga (Opsional)</label>
    <x-inputs.family :families="$families" member_family_name="{{ $member->family_name }}"></x-inputs.family>

    <button class="btn btn-info mt-4" id="send">Kirim</button>
    <button class="btn btn-error mt-4" id="delete">Hapus Data</button>
</fieldset>
