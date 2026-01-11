<?php

return [
    'driver' => env('HASH_DRIVER', 'argon2id'),

    'argon2id' => [
        'memory' => 65536,
        'threads' => 3,
        'time' => 1,
    ],
];
