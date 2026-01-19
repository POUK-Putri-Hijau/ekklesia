@props([
    'family' => []
])

<fieldset class="fieldset rounded-box text-black w-full md:w-2xl p-4">
    <label class="text-lg">Nama Keluarga</label>
    <input type="text" name="name" class="input w-full" maxlength="70" minlength="9" value="{{ $family->name }}" />

    <label class="text-lg mt-4">Tanggal Pernikahan</label>
    <div class="flex gap-4">
        <div class="flex-1/12 md:flex-1">
            <label class="text-sm">Tanggal (1-31)</label>
            <input type="text" name="wedding-date-day" class="input w-full" minlength="1" maxlength="2" value="{{ $family->day }}" />
        </div>
        <div class="flex-1">
            <label class="text-sm">Bulan</label>
            <x-inputs.month selected_month="{{ $family->month }}"></x-inputs.month>
        </div>
        <div class="flex-1">
            <label class="text-sm">Tahun</label>
            <input type="text" name="wedding-date-year" class="input w-full" minlength="4" maxlength="4" value="{{ $family->year }}" />
        </div>
    </div>

    <button class="btn btn-info mt-4" id="send">Kirim</button>
    <button class="btn btn-error mt-4" id="delete">Hapus Data</button>
</fieldset>
