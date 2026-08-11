<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Portfolio profile
    |--------------------------------------------------------------------------
    |
    | Public profile data exposed through the GET /about endpoint.
    | Keep this in sync with the content served by the Nuxt frontend.
    |
    */

    'about' => [
        'name' => env('PORTFOLIO_NAME', 'Port4u'),
        'title' => env('PORTFOLIO_TITLE', 'WordPress Developer'),
        'tagline' => 'I design, build and maintain fast, secure WordPress websites that grow with your business.',
        'summary' => 'WordPress Developer with hands-on experience building custom themes and plugins, WooCommerce stores, and performance optimizations for production websites. Experienced with migrations, hosting environments and troubleshooting across Linux servers.',
        'email' => env('PORTFOLIO_EMAIL', 'francisian172@gmail.com'),
        'location' => env('PORTFOLIO_LOCATION', 'Remote · Worldwide'),
        'avatar' => '/images/avatar.jpg',
        'resume_url' => '/files/Francis%20ian.pdf',
        'availability' => true,
        'social' => [
            'github' => env('PORTFOLIO_GITHUB', 'https://github.com/yourusername'),
            'linkedin' => env('PORTFOLIO_LINKEDIN', 'https://linkedin.com/in/yourusername'),
            'facebook' => env('PORTFOLIO_FACEBOOK', 'https://facebook.com/yourusername'),
        ],
        'highlights' => [
            'WordPress theme & plugin development',
            'Custom WooCommerce store development',
            'Site migrations and performance optimization',
            'Hosting and server management experience',
        ],
        'education' => [
            [
                'degree' => 'BSc Computer Science',
                'school' => 'University of Technology',
                'period' => '2014 - 2018',
                'description' => 'Focused on software engineering, databases and web technologies.',
            ],
            [
                'degree' => 'WordPress Development Certification',
                'school' => 'Online Bootcamp',
                'period' => '2017 - 2018',
                'description' => 'Intensive programme covering PHP, WordPress APIs, custom theming and plugin architecture.',
            ],
        ],
    ],

];
