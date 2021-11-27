<?php

return [
    [
        'name' => 'Advertise',
        'flag' => 'advs.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'advs.create',
        'parent_flag' => 'advs.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'advs.edit',
        'parent_flag' => 'advs.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'advs.destroy',
        'parent_flag' => 'advs.index',
    ],
];