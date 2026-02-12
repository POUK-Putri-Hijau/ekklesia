<div
    class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2 fixed inset-y-0 left-0
    transform -translate-x-full md:translate-x-0 z-20"
>
    <nav class="flex flex-col space-y-2">
        <p class="mb-8 text-xl md:text-3xl text-center font-bold">EKKLESIA</p>

        <x-sidebar-item
            route="dashboard"
            title="Dasbor"
        ></x-sidebar-item>

        <x-sidebar-item
            route="families"
            title="Daftar Keluarga"
        ></x-sidebar-item>

        <x-sidebar-item
            route="members"
            title="Anggota Jemaat"
        ></x-sidebar-item>

        <x-sidebar-item
            route="birthdays"
            title="Ulang Tahun"
        ></x-sidebar-item>
    </nav>
</div>
