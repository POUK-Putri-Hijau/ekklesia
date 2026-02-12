<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Member;
use App\Rules\Validators;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

const MEMBER_DATA_INPUTS = [
    'name',
    'birth-date-day',
    'birth-date-month',
    'birth-date-year',
    'address',
    'phone-number',
    'family-name',
    'photo'
];

class MemberController extends Controller
{

    public function index(Request $request): Factory|View
    {
        $page = $request->query('page');
        $page_int = intval($page);
        if ($page_int === 0) $page_int = 1;

        $perPage = 7;
        $min = ($page_int - 1) * $perPage;
        $max = $perPage;

        $members = Member::all()->skip($min)->take($max);
        $max_page = round(Member::all()->count() / $perPage);
        return view('members.index', ['members' => $members, 'page_num' => $page_int, 'max_page' => $max_page]);
    }

    public function search(Request $request): Factory|View|RedirectResponse
    {
        $name = $request->query('name');
        if (empty(trim($name))) return redirect('/members');

        $lowercase_name = strtolower($name);
        $members = Member::whereRaw('LOWER(name) LIKE ?', ["%$lowercase_name%"])->get();
        return view('members.index', ['members' => $members]);
    }

    public function create(): Factory|View
    {
        $families = Family::all(['id', 'name'])->toarray();
        return view('members.create', ['families' => $families]);
    }

    public function store(Request $request)
    {
        $input = $request->only(MEMBER_DATA_INPUTS);
        $validator = Validator::make($input, Validators::member());

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json([
                'errors' => $errors
            ], 422);
        }

        $data = parseMemberData($input);

        $member = new Member();
        saveMemberData($member, $data);

        return '';
    }

    public function edit($member_id)
    {
        $error_found = validateId($member_id);
        if ($error_found) return $error_found;

        $families = Family::all(['id', 'name'])->toarray();
        $member = Member::where('id', $member_id)->first();
        if (!$member) {
            return view('error', ['error' => 'Mohon maaf, data jemaat tersebut tidak ditemukan']);
        }

        $birth_date = explode('-', $member->birth_date);
        $member->year = $birth_date[0];
        $member->month = (int) $birth_date[1];
        $member->day = $birth_date[2];

        if ($member->family_id) {
            $family = Family::find($member->family_id);
            $member->family_name = $family->name;
        }

        return view('members.edit', ['member' => $member, 'families' => $families]);
    }

    public function update(Request $request, $member_id) {
        $error_found = validateId($member_id);
        if ($error_found) return response()->json([], 404);

        $member = Member::find($member_id);
        if (!$member) {
            return response()->view(
                'error',
                ['error' => 'Mohon maaf, data jemaat tersebut tidak ditemukan'],
                403
            );
        }

        $input = $request->only(MEMBER_DATA_INPUTS);
        $validator = Validator::make($input, Validators::member());

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json([
                'errors' => $errors
            ], 422);
        }

        $data = parseMemberData($input);
        saveMemberData($member, $data, true);

        return '';
    }

    public function destroy($member_id) {
        $error_found = validateId($member_id);
        if ($error_found) return response()->json([], 404);

        $member = Member::find($member_id);
        if (!$member) {
            return response()->json([], 404);
        }

        $member->delete();

        return '';
    }
}

function parseMemberData($input) {
    $data = [];

    $data['name'] = $input['name'];
    $data['birth_date'] = $input['birth-date-year'] . '-' . $input['birth-date-month'] . '-' . $input['birth-date-day'];
    $data['address'] = $input['address'];

    if (isset($input['phone-number'])) {
        $data['phone_number'] = $input['phone-number'];
    } else {
        $data['phone_number'] = null;
    }

    if (isset($input['family-name'])) {
        $data['family_name'] = $input['family-name'];
    } else {
        $data['family_name'] = null;
    }

    if (isset($input['photo'])) {
        $data['photo'] = $input['photo'];
    } else {
        $data['photo'] = null;
    }

    return $data;
}

function saveMemberData($member, array $data, bool $is_update = false) {
    $member['name'] = $data['name'];
    $member['birth_date'] = $data['birth_date'];
    $member['address'] = $data['address'];

    $phone_number = $data['phone_number'];
    if ($phone_number) {
        $member['phone_number'] = $phone_number;
    }

    $family_name = $data['family_name'];
    if ($family_name) {
        $family = Family::where('name', $family_name)->first();
        if ($family) $member['family_id'] = $family->id;
    } else if ($is_update) {
        $member['family_id'] = null;
    }

    $photo = $data['photo'];
    if ($photo) {
        $extension = $photo->getClientOriginalExtension();
        $file_name = Str::random() . '.' . $extension;

        if ($is_update && $member['photo_file_name']) {
            $file_name = $member['photo_file_name'];
        }

        $photo->storeAs('member_photos/', $file_name);
        $member['photo_file_name'] = $file_name;
    }

    $member->save();
}
