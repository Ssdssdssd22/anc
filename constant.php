<?php

return [
    'app' => [
        'name' => 'Ananda National College',
        'tagline' => 'Empowering Future Leaders',
        'base_url' => 'https://anc.lk',
        'admin_url' => '/site/admin/pages/dashboard.php',
    ],
    'branding' => [
        'logo_primary' => 'https://i.ibb.co/8xZ8B7F/anc.png',
        'logo_mark' => 'https://i.ibb.co/McKPCc6/anclogo.png',
        'colors' => [
            'primary' => '#200769',
            'secondary' => '#f4b328',
            'accent' => '#b71c1c',
            'neutral' => '#f5f6ff',
        ],
    ],
    'contact' => [
        'address' => [
            'line1' => 'Colombo Road, Chilaw',
            'line2' => 'Sri Lanka',
        ],
        'phone_numbers' => [
            '+94 32 222 2345',
            '+94 32 222 2346',
        ],
        'emails' => [
            'info@anandacollege.edu.lk',
            'principal@anandacollege.edu.lk',
        ],
        'office_hours' => [
            'weekdays' => 'Monday - Friday: 7:30 AM - 3:30 PM',
            'saturday' => 'Saturday: 7:30 AM - 1:00 PM',
        ],
        'map' => [
            'embed_src' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6651.546588770832!2d79.79176119336493!3d7.571352378623728!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2c96468fbc719%3A0x5358555a23a785db!2sAnanda%20National%20College!5e0!3m2!1sen!2slk!4v1713470141625!5m2!1sen!2slk',
            'directions_link' => 'https://www.google.com/maps/dir/?api=1&destination=Ananda+National+College,+Chilaw',
            'plain_address' => 'Ananda National College, Colombo Road, Chilaw, Sri Lanka',
        ],
    ],
    'smtp' => [
        'host' => 'mail.inovaniar.com',
        'username' => 'info@anc.inovaniar.com',
        'password' => 'Sampath@123456',
        'port' => 465,
        'encryption' => 'ssl',
        'from_email' => 'info@anc.inovaniar.com',
        'from_name' => 'Ananda National College',
        'bcc' => 'isurusmpth22@gmail.com',
        'subject_prefix' => 'Ananda National College Inquiry',
    ],
];