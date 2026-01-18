@props([
    'families' => [],
    'member_family_name' => ''
])

<div id="family-dropdown" class="rounded-md shadow-lg bg-white p-1 space-y-1 right-0">
    <input
        id="search-family"
        name="family-name"
        class="input w-full"
        type="text"
        placeholder="Ketik nama keluarga"
        autocomplete="off"
        minlength="9"
        maxlength="70"
        value="{{ $member_family_name }}"
    >

    <div id="items" class="hidden max-h-36 overflow-auto">
        @foreach($families as $family)
            <a
                class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md"
            >{{ $family['name'] }}</a>
        @endforeach
    </div>
</div>
