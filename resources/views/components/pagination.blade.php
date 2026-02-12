@props([
    'page_num' => null
])

@if($page_num)
    <div class="join pl-4 pt-4">
        @if ($page_num > 1)
            <a class="join-item btn" href="/members?page={{ $page_num - 1 }}">«</a>
        @endif
        <button class="join-item btn">Halaman {{ $page_num }}</button>
        @if($page_num + 1 <= $max_page)
            <a class="join-item btn" href="/members?page={{ $page_num + 1 }}">»</a>
        @endif
    </div>
@endif
