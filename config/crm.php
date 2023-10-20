<?php

return [
    'date_format' => '%A %d %b %Y',
    'date_format_short' => '%a %d/%m/%y',
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
    'appointment_hours' => [
        '09:00',
        '09:30',
        '10:00',
        '10:30',
        '11:00',
        '11:30',
        '12:00',
        '12:30',
        '13:00',
        '13:30',
        '14:00',
        '14:30',
        '15:00',
        '15:30',
        '16:00',
        '16:30',
        '17:00',
        '17:30',
        '18:00',
        '18:30',
        '19:00',
        '19:30',
        '20:00',
        '20:30',
    ]
];
