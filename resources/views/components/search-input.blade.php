@props([
    "placeholder" => "Cari nama keluarga...",
    'category' => null
])

<div class="join w-full px-4">
    <div class="w-full">
        <label class="input w-full join-item">
            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g
                    stroke-linejoin="round"
                    stroke-linecap="round"
                    stroke-width="2.5"
                    fill="none"
                    stroke="currentColor"
                >
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </g>
            </svg>
            <input type="text" id="query" placeholder="Nama jemaat..." required />
        </label>
    </div>
    <button class="btn btn-info join-item" id="search" data-category="{{ $category }}">Cari</button>
</div>
