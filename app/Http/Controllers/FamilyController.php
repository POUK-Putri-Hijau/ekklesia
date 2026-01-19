<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\FamilyTotalMember;
use App\Rules\Validators;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

const FAMILY_DATA_INPUTS = [
    'name',
    'wedding-date-day',
    'wedding-date-month',
    'wedding-date-year',
];

class FamilyController extends Controller
{
    public function index(): Factory|View
    {
        $families = FamilyTotalMember::all();
        return view('families.index', ['families' => $families]);
    }

    public function create(): Factory|View
    {
        return view('families.create');
    }

    public function store(Request $request)
    {
        $input = $request->only(FAMILY_DATA_INPUTS);
        $validator = Validator::make($input, Validators::family());

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json([
                'errors' => $errors
            ], 422);
        }

        $data = parseFamilyData($input);

        $family = new Family();
        saveFamilyData($family, $data);

        return '';
    }

    public function edit($family_id)
    {
        $error_found = validateId($family_id);
        if ($error_found) return $error_found;

        $family = Family::find($family_id);
        if (!$family) {
            return dataNotFoundResponse('keluarga');
        }

        $wedding_date = $family->wedding_date;
        if ($wedding_date) {
            $wedding_date_explode = explode('-', $wedding_date);
            $family->year = $wedding_date_explode[0];
            $family->month = (int) $wedding_date_explode[1];
            $family->day = $wedding_date_explode[2];
        }

        return view('families.edit', ['family' => $family]);
    }

    public function update(Request $request, $family_id) {
        $error_found = validateId($family_id);
        if ($error_found) return response()->json([], 404);

        $family = Family::find($family_id);
        if (!$family) return dataNotFoundResponse('keluarga');

        $input = $request->only(FAMILY_DATA_INPUTS);
        $validator = Validator::make($input, Validators::family());

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json([
                'errors' => $errors
            ], 422);
        }

        $data = parseFamilyData($input);
        saveFamilyData($family, $data);

        return '';
    }

    public function destroy($family_id) {
        $error_found = validateId($family_id);
        if ($error_found) return response()->json([], 404);

        $family = Family::find($family_id);
        if (!$family) {
            return response()->json([], 404);
        }

        $family->delete();

        return '';
    }
}

function parseFamilyData($input) {
    $data = [];

    $data['name'] = $input['name'];

    $wedding_day = $input['wedding-date-day'];
    $wedding_month = $input['wedding-date-month'];
    $wedding_year = $input['wedding-date-year'];

    $data['wedding_date'] = $wedding_year . '-' . $wedding_month . '-' . $wedding_day;

    return $data;
}

function saveFamilyData($family, array $data) {
    $family['name'] = $data['name'];
    $family['wedding_date'] = $data['wedding_date'];

    $family->save();
}
