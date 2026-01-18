@props([
    'selected_month' => ''
])

@php
    $months = [
      1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
      7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
    ];
@endphp

<select class="select" name="month">
    <option disabled {{ $selected_month === '' ? 'selected' : '' }}>Pilih bulan lahir</option>
    @foreach($months as $num => $name)
        <option value="{{ $num }}" {{ $selected_month === (string)$num ? 'selected' : '' }}>
            {{ $name }}
        </option>
    @endforeach
</select>
