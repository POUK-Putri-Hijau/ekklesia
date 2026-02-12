<div class="dock dock-md md:hidden bg-[#1E2939] text-neutral-content">
    <a class="{{ isActiveRoute('dashboard') }}" href="/dashboard">
        <x-icons.dashboard class="size-[1.2em]"></x-icons.dashboard>
        <span class="dock-label">Dasbor</span>
    </a>

    <a class="{{ isActiveRoute('families') }}" href="/families">
        <x-icons.families class="size-[1.2em]"></x-icons.families>
        <span class="dock-label">Keluarga</span>
    </a>

    <a class="{{ isActiveRoute('members') }}" href="/members">
        <x-icons.members class="size-[1.2em]"></x-icons.members>
        <span class="dock-label">Jemaat</span>
    </a>

    <a class="{{ isActiveRoute('birthdays') }}" href="{{ @route('birthdays') }}">
        <x-icons.birthday class="size-[1.2em]"></x-icons.birthday>
        <span class="dock-label">Ultah</span>
    </a>

    <a class="{{ isActiveRoute('profile') }}" href="/profile">
        <x-icons.profile class="size-[1.2em]"></x-icons.profile>
        <span class="dock-label">Profil</span>
    </a>
</div>
