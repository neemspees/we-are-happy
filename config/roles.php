<?php

use App\Constants\Permissions;
use App\Constants\Roles;

return [
    Roles::EMPLOYEE => [
        Permissions::CREATE_VOTE
    ],
    Roles::MANAGER => [
        Permissions::READ_STATISTICS
    ]
];
