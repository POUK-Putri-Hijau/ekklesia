<?php
namespace App\Rules;

class Validators
{
    public static function member(): array
    {
        return [
            'name' => [
                'required','string','min:3','max:60','regex:/^[^\d]*$/',
            ],
            'birth-date-day'   => 'required|integer|min:1|max:31',
            'birth-date-month' => 'required|integer|min:1|max:12',
            'birth-date-year'  => 'required|integer|min:1900|max:3000',
            'address' => 'required|string|min:9|max:256',
            'phone-number' => [
                'nullable','string','min:9','max:15','regex:/^(08|\+628)[0-9]+$/',
            ],
            'family-name' => 'nullable|string|min:9|max:70',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:51200'
        ];
    }

    public static function family(): array
    {
        return [
            'name' => [
                'required','string','min:9','max:70','regex:/^[^\d]*$/',
            ],
            'wedding-date-day'   => 'nullable|integer|min:1|max:31',
            'wedding-date-month' => 'nullable|integer|min:1|max:12',
            'wedding-date-year'  => 'nullable|integer|min:1900|max:3000',
        ];
    }
}
