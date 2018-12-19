<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'datasets' => [
            'title' => 'Adatkörök',
            'car' => [
                'management' => 'Gépjármű kezelés',
                'show' => 'Megtekintés',
            ],
        ],

        'access' => [
            'title' => 'Hozzáférés',

            'roles' => [
                'all'        => 'Minden szerepkör',
                'create'     => 'Szerepkör létrehozás',
                'edit'       => 'Szerepkör szerkesztése',
                'management' => 'Szerepkör kezelés',
                'main'       => 'Szerepkörök',
            ],

            'users' => [
                'all'             => 'Minden Felhasználó',
                'change-password' => 'Jelszó Váltás',
                'create'          => 'Felhasználó létrehozása',
                'deactivated'     => 'Deaktivált felhasználók',
                'deleted'         => 'Törölt Felhasználók',
                'edit'            => 'Felhasználó Módosítása',
                'main'            => 'Felhasználók',
                'view'            => 'Felhasználó megtekintése',
            ],

            'cities' => [
                'all'        => 'Minden település',
                'create'     => 'Új település',
                'edit'       => 'Település szerkesztés',
                'management' => 'Település karbantartás',
                'main'       => 'Települések',
            ],
        ],

        'log-viewer' => [
            'main'      => 'Napló megtekintés',
            'dashboard' => 'Irányítópult',
            'logs'      => 'Naplók',
        ],

        'sidebar' => [
            'dashboard' => 'Irányítópult',
            'general'   => 'Általános',
            'history'   => 'Történet',
            'system'    => 'Rendszer',
        ],
    ],

    'language-picker' => [
        'language' => 'Nyelv',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'en'    => 'Angol',
            'hu'    => 'Magyar',
        ],
    ],
];
