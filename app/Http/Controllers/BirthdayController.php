<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BirthdayController extends Controller
{
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $dates = ['start' => $startOfWeek->format('d M'), 'end' => $endOfWeek->format('d M')];

        $startMonth = $startOfWeek->month;
        $startDay = $startOfWeek->day;
        $endMonth = $endOfWeek->month;
        $endDay = $endOfWeek->day;

        $members = DB::table('members')
            ->select(
                'name',
                'birth_date',
                DB::raw('DAY(birth_date) AS day'),
                DB::raw('MONTH(birth_date) AS month')
            )
            ->whereRaw('(MONTH(birth_date) * 100 + DAY(birth_date)) >= ?', [
                $startMonth * 100 + $startDay
            ])
            ->whereRaw('(MONTH(birth_date) * 100 + DAY(birth_date)) <= ?', [
                $endMonth * 100 + $endDay
            ])
            ->orderByRaw('MONTH(birth_date) ASC, DAY(birth_date) ASC')
            ->get();

        $families = DB::table('families')
            ->select(
                'name',
                'wedding_date',
                DB::raw('DAY(wedding_date) AS day'),
                DB::raw('MONTH(wedding_date) AS month')
            )
            ->whereRaw('(MONTH(wedding_date) * 100 + DAY(wedding_date)) >= ?', [
                $startMonth * 100 + $startDay
            ])
            ->whereRaw('(MONTH(wedding_date) * 100 + DAY(wedding_date)) <= ?', [
                $endMonth * 100 + $endDay
            ])
            ->orderByRaw('MONTH(wedding_date) ASC, DAY(wedding_date) ASC')
            ->get();

        return view('birthdays', [ 'members' => $members, 'families' => $families, 'dates' => $dates ]);
    }
}
