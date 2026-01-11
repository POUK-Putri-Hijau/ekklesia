@props([
    'url' => ''
])

<div class="fixed bottom-20 md:bottom-4 right-3">
    <a href="{{ $url }}">
        <button class="p-4 bg-[#7DD3FC] text-black rounded-2xl hover:bg-[#38BDF8] focus:outline-none active:bg-[#0EA5E9] cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </button>
    </a>
</div>
