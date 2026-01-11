<div class="dock dock-md md:hidden bg-[#1E2939] text-neutral-content">
    <a class="{{ isActiveRoute('dashboard') }}" href="/dashboard">
        <x-icons.dashboard class="size-[1.2em]"></x-icons.dashboard>
        <span class="dock-label">Dasbor</span>
    </a>

    <a class="{{ isActiveRoute('families') }}" href="/families">
        <x-icons.families class="size-[1.2em]"></x-icons.families>
        <span class="dock-label">Keluarga</span>
    </a>

    <a class="{{ isActiveRoute('congregants') }}" href="/congregants">
        <x-icons.congregants class="size-[1.2em]"></x-icons.congregants>
        <span class="dock-label">Jemaat</span>
    </a>

    <a class="{{ isActiveRoute('profile') }}" href="/profile">
        <x-icons.profile class="size-[1.2em]"></x-icons.profile>
        <span class="dock-label">Profil</span>
    </a>
</div>
