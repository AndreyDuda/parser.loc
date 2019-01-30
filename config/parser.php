<?php

return [
    'overall' => [
        'count_content'  => env('CONTENTS_QUANTITY_PER_CHECK'),
        'count_page'     => env('PAGE_QUANTITY_PER_CHECK'),
        'update_content' => env('CONTENTS_QUANTITY_PER_UPDATE'),
    ],
    'resource' => [
        'rozetka' => [
            'link' => 'rozetka.com',
            'page' => 'page',
            'config' => [
                'count_content'  => 10,
                'count_page'     => 2,
                'update_content' => 0,
                'categories'     => [
                    'rozetka.com/telephone',
                    'rozetka.com/notebook'
                ],
            ],
        ],
        'hi-news' => [
            'link' => 'https://hi-news.ru',
            'page' => 'page',
            'config' => [
                'count_content'  => 10,
                'count_page'     => 2,
                'update_content' => 0,
                'categories'     => [
                    'https://hi-news.ru'
                ],
            ],
        ],
    ],
];
