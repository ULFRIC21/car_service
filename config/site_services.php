<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Услуги сайта
    |--------------------------------------------------------------------------
    | Карточки на главной → slug категории (category slug).
    | Строки в сайдбаре → slug страницы в pages.
    | Текст страницы: resources/views/pages/service/content/{slug}.blade.php
    */
    'categories' => [
        [
            'slug' => 'tehnicheskoe-obsluzhivanie',
            'title' => 'Техническое обслуживание',
            'card_image' => 'images/dvigat/1-3.png',
            'card_items' => [
                'Комплексная диагностика',
                'ТО с сохранением гарантии',
                'Замена масла и фильтров',
            ],
            'image' => 'images/remont/Бесплатная диагностика автомобиля по 35 параметрам.jpg',
            'pages' => [
                [
                    'slug' => 'kompleksnaya-diagnostika',
                    'title' => 'Комплексная диагностика автомобиля',
                    'image' => 'images/remont/Бесплатная диагностика автомобиля по 35 параметрам.jpg',
                ],
                [
                    'slug' => 'to-s-garantiej',
                    'title' => 'ТО с сохранением гарантии',
                    'image' => 'images/remont/Техническое обслуживание (ТО) автомобиля.jpg',
                ],
                [
                    'slug' => 'zamena-masla',
                    'title' => 'Замена масла, тормозной и охлаждающей жидкостей',
                    'image' => 'images/remont/Замена масла, тормозной и охлаждающей жидкостей.jpg',
                ],
                [
                    'slug' => 'zamena-filtrov',
                    'title' => 'Замена фильтров и свечей',
                    'image' => 'images/remont/Замена фильтров и свечей зажигания.jpg',
                ],
                [
                    'slug' => 'zamena-kolodok',
                    'title' => 'Замена тормозных колодок',
                    'image' => 'images/remont/Замена тормозных колодок и дисков.jpg',
                ],
            ],
        ],
        [
            'slug' => 'dvigatel',
            'title' => 'Двигатель',
            'card_image' => 'images/dvigat/2-3.png',
            'card_items' => [
                'Диагностика двигателя',
                'Ремонт двигателей',
                'Замена ремня или цепи ГРМ',
            ],
            'image' => 'images/remont/Диагностика работы бензиновых и дизельных двигателей в Ижевске.jpg',
            'pages' => [
                [
                    'slug' => 'diagnostika-dvigatelya',
                    'title' => 'Диагностика работы двигателя',
                    'image' => 'images/remont/Диагностика работы бензиновых и дизельных двигателей в Ижевске.jpg',
                ],
                [
                    'slug' => 'remont-dvigatelya',
                    'title' => 'Ремонт двигателей',
                    'image' => 'images/remont/Ремонт двигателя в Ижевске любой сложности.jpg',
                ],
                [
                    'slug' => 'remen-grm',
                    'title' => 'Замена ремня или цепи ГРМ',
                    'image' => 'images/remont/Замена ремня или цепи ГРМ в Ижевске.jpg',
                ],
            ],
        ],
        [
            'slug' => 'korobka-peredach',
            'title' => 'Коробка переключения передач',
            'card_image' => 'images/dvigat/3-3.png',
            'card_items' => [
                'Ремонт АКПП и МКПП',
                'Замена и ремонт сцепления',
                'Замена масла в АКПП или МКПП',
            ],
            'image' => 'images/remont/Ремонт коробки передач МКПП (Механика).jpg',
            'pages' => [
                [
                    'slug' => 'remont-reduktorov',
                    'title' => 'Ремонт редукторов и раздаточных коробок',
                    'image' => 'images/remont/Ремонт редукторов и раздаточных коробок.jpg',
                ],
                [
                    'slug' => 'remont-scepleniya',
                    'title' => 'Замена и ремонт сцепления',
                    'image' => 'images/remont/Замена и ремонт сцепления.jpg',
                ],
                [
                    'slug' => 'zamena-masla-akpp',
                    'title' => 'Замена масла в АКПП или МКПП',
                    'image' => 'images/remont/Замена масла в АКПП или МКПП.jpg',
                ],
                [
                    'slug' => 'remont-kpp',
                    'title' => 'Ремонт коробки передач',
                    'image' => 'images/remont/Ремонт коробки передач МКПП (Механика).jpg',
                ],
            ],
        ],
        [
            'slug' => 'toplivnaya-sistema',
            'title' => 'Топливная система',
            'card_image' => 'images/dvigat/4-2.png',
            'card_items' => [
                'Диагностика инжектора',
                'Чистка форсунок',
                'Аппаратная промывка',
            ],
            'image' => 'images/remont/Компьютерная диагностика инжектора в Ижевске.jpg',
            'pages' => [
                [
                    'slug' => 'diagnostika-inzhektora',
                    'title' => 'Диагностика инжектора',
                    'image' => 'images/remont/Компьютерная диагностика инжектора в Ижевске.jpg',
                ],
                [
                    'slug' => 'promyvka-toplivnoy',
                    'title' => 'Аппаратная промывка топливной системы',
                    'image' => 'images/remont/Аппаратная промывка топливной системы специальной жидкостью.png',
                ],
                [
                    'slug' => 'chistka-forsunok',
                    'title' => 'Чистка форсунок ультразвуком',
                    'image' => 'images/remont/Ультразвуковая чистка форсунок.png',
                ],
                [
                    'slug' => 'test-forsunok',
                    'title' => 'Тестирование форсунок (стенд)',
                    'image' => 'images/remont/Тестирование форсунок на профессиональном стенде.jpg',
                ],
                [
                    'slug' => 'remont-benzonasosa',
                    'title' => 'Замена и ремонт бензонасоса',
                    'image' => 'images/remont/Замена и ремонт бензонasosa.jpg',
                ],
            ],
        ],
        [
            'slug' => 'podveska',
            'title' => 'Подвеска (ходовая часть)',
            'card_image' => 'images/dvigat/6-2.png',
            'card_items' => [
                'Развал-схождение',
                'Диагностика подвески',
                'Ремонт подвески',
            ],
            'image' => 'images/remont/Ремонт подвески и ходовой части.jpg',
            'pages' => [
                [
                    'slug' => 'razval-skhozhdenie',
                    'title' => 'Развал-схождение',
                    'image' => 'images/remont/Проверка и регулировка развал-схождения.jpg',
                ],
                [
                    'slug' => 'diagnostika-podveski',
                    'title' => 'Диагностика подвески',
                    'image' => 'images/remont/Диагностика подвески в Ижевске БЕСПЛАТНО.jpg',
                ],
                [
                    'slug' => 'remont-podveski',
                    'title' => 'Ремонт подвески (ходовой)',
                    'image' => 'images/remont/Ремонт подвески и ходовой части.jpg',
                ],
                [
                    'slug' => 'remont-rulevogo',
                    'title' => 'Ремонт рулевого управления',
                    'image' => 'images/remont/Ремонт рулевого управления в Ижевске.jpg',
                ],
                [
                    'slug' => 'vosstanovlenie-reek',
                    'title' => 'Восстановление рулевых реек',
                    'image' => 'images/remont/Восстановление рулевых реек в Ижевске.jpg',
                ],
            ],
        ],
        [
            'slug' => 'elektrika',
            'title' => 'Электрика',
            'card_image' => 'images/dvigat/6-2 (1).png',
            'card_items' => [
                'Ремонт стартеров и генераторов',
                'Установка автозвука',
                'Ремонт автоэлектрики',
            ],
            'image' => 'images/remont/Ремонт автоэлектрики в Ижевске.jpg',
            'pages' => [
                [
                    'slug' => 'remont-starterov',
                    'title' => 'Ремонт стартеров, замена автостартеров',
                    'image' => 'images/remont/Ремонт стартеров, замена автостартеров в Ижевске.jpg',
                ],
                [
                    'slug' => 'remont-generatorov',
                    'title' => 'Ремонт генераторов, замена автогенераторов',
                    'image' => 'images/remont/Ремонт генераторов, замена автогенераторов в Ижевске.jpg',
                ],
                [
                    'slug' => 'ustanovka-avtozvuka',
                    'title' => 'Установка автозвука',
                    'image' => 'images/remont/Установка автозвука в Ижевске.jpg',
                ],
                [
                    'slug' => 'remont-avtoelektriki',
                    'title' => 'Ремонт автоэлектрики',
                    'image' => 'images/remont/Ремонт автоэлектрики в Ижевске.jpg',
                ],
            ],
        ],
    ],
];
