<?php

return [
    'role_default' => 'employee',
    'roles' => [
        'admin' => [
            'label' => 'ΔΙΑΧΕΙΡΙΣΤΗΣ',
            'access' => [],
        ],
        'employee' => [
            'label' => 'ΥΠΑΛΛΗΛΟΣ',
            'access' => ['labor', 'client', 'catalog', 'expense', 'vat', 'appointments'],
        ],
    ],
];
