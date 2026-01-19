<?php

use Illuminate\Http\Response;

function isActiveRoute($routeName): string
{
    return request()->routeIs($routeName) ? 'dock-active' : '';
}

function dataNotFoundResponse($data_name): Response
{
    return response()->view(
        'error',
        ["error' => 'Mohon maaf, data $data_name tersebut tidak ditemukan."],
        403
    );
}

function validateId($id): ?Response
{
$int_id = intval($id);
    if ($int_id < 1) {
        return dataNotFoundResponse('jemaat');
    }

    return null;
}
