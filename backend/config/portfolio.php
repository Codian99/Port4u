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
        'name' => env('PORTFOLIO_NAME', 'John Doe'),
        'title' => env('PORTFOLIO_TITLE', 'Full Stack Web Developer'),
        'tagline' => 'I craft fast, elegant and maintainable web experiences end to end.',
        'summary' => 'Full Stack Web Developer with a passion for building modern, scalable applications using Nuxt, Vue, Laravel and PHP. Experienced with WordPress, custom plugins, Docker-based deployments and REST APIs.',
        'email' => env('PORTFOLIO_EMAIL', 'francisian172@gmail.com'),
        'location' => env('PORTFOLIO_LOCATION', 'Remote · Worldwide'),
        'avatar' => '/images/avatar.jpg',
        'resume_url' => '/files/resume.pdf',
        'availability' => true,
        'social' => [
            'github' => env('PORTFOLIO_GITHUB', 'https://github.com/yourusername'),
            'linkedin' => env('PORTFOLIO_LINKEDIN', 'https://linkedin.com/in/yourusername'),
            'facebook' => env('PORTFOLIO_FACEBOOK', 'https://facebook.com/yourusername'),
        ],
        'highlights' => [
            '5+ years building production web applications',
            'Laravel API development and REST design',
            'WordPress theme & plugin development',
            'Docker, Linux and Nginx deployments',
        ],
        'education' => [
            [
                'degree' => 'BSc Computer Science',
                'school' => 'University of Technology',
                'period' => '2014 - 2018',
                'description' => 'Focused on software engineering, databases and web technologies.',
            ],
            [
                'degree' => 'Full Stack Web Development Certification',
                'school' => 'Online Bootcamp',
                'period' => '2017 - 2018',
                'description' => 'Intensive programme covering PHP, JavaScript, MySQL and modern frontend frameworks.',
            ],
        ],
    ],

];
