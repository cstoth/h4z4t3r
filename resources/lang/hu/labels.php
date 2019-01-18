<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all'       => 'Mind',
        'yes'       => 'Igen',
        'no'        => 'Nem',
        'copyright' => 'Szerzői jog',
        'custom'    => 'Saját készítésű',
        'actions'   => '', // Műveletek
        'active'    => 'Aktív',
        'buttons'   => [
            'save'   => 'Mentés',
            'update' => 'Módosítás',
            'search' => 'Keresés',
        ],
        'hide'              => 'Elrejt',
        'inactive'          => 'Inaktív',
        'none'              => 'Nincsen',
        'show'              => 'Mutat',
        'toggle_navigation' => 'Navigáció átkapcsolása',
        'create_new'        => 'Új létrehozás',
        'toolbar_btn_groups'=> 'Ezköztár gombcsoportokkal',
        'more'              => 'Több',
        'none'              => 'Nincsen',
        'back'              => 'Vissza',
        'table' => [
            'created_at'    => 'Létrehozva',
            'updated_at'    => 'Módosítva',
        ],
    ],

    'backend' => [
        'datasets' => [
            'total' => 'Összesen: ',

            'city' => [
                'management' => 'Települések',
            ],
            'cities' => [
                'create'     => 'Új település',
                'edit'       => 'Település szerkesztés',
                'management' => 'Település karbantartás',

                'table' => [
                    'name'   => 'Településnév',
                    'kshkod' => 'KSH kód',
                    'irsz'   => 'Irányítószám',
                    'megye'  => 'Megyenév',
                    'x'      => 'Hosszúság',
                    'y'      => 'Szélesség',
                    'total'  => 'Összesen: ',
                ],
            ],

            'car' => [
                'management' => 'Gépjárművek',
                'create'     => 'Új gépjármű felvitele',
                'edit'       => 'Gépjármű szerkesztés',
                'show'       => 'Gépjármű megtekintés',

                'table' => [
                    'user_id' => 'Tulajdonos',
                    'license' => 'Rendszám',
                    'type' => 'Típus',
                    'seats' => 'Szabad ülések száma',
                    'brand' => 'Gyártmány',
                    'color' => 'Szín',
                    'year' => 'Évjárat',
                    'image' => 'Fotó',
                    'image2' => 'Fotó 2',
                    'smoke' => 'Dohányzó',
                    'cooler' => 'Légkondi',
                    'pet' => 'Háziállat',
                    'bag' => 'Csomag',
                ],
            ],

            'message' => [
                'management' => 'Üzenetek',
                'create'     => 'Új üzenet',
                'edit'       => 'Szerkesztés',
                'show'       => 'Megtekintés',

                'table' => [
                    'from_user_id' => 'Feladó',
                    'to_user_id' => 'Címzett',
                    'advertise_id' => 'Kapcsolódó út',
                    'readed' => 'Olvasva',
                    'subject' => 'Tárgy',
                    'message' => 'Üzenet',
                    'created_at' => 'Időpont',
                ],
            ],

            'advertise' => [
                'management' => 'Hirdetés',
                'create'     => 'Feladás',
                'edit'       => 'Szerkesztés',
                'show'       => 'Megtekintés',
                'close'      => 'Lezárás',

                'table' => [
                    'from_user_id' => 'Feladó',
                    'to_user_id' => 'Címzett',
                    'advertise_id' => 'Kapcsolódó út',
                    'readed' => 'Olvasva',
                    'subject' => 'Tárgy',
                    'message' => 'Üzenet',
                    'created_at' => 'Időpont',
                ],
            ],

            'hunter' => [
                'management' => 'Hirdetésfigyelő',
                'create'     => 'Létrehozás',
                'edit'       => 'Szerkesztés',
                'show'       => 'Megtekintés',

                'table' => [
                    'user_id' => 'Feladó',
                    'start_city_id' => 'Honnan?',
                    'end_city_id' => 'Hova?',
                    'days' => 'Melyik napokon utazol?',
                ],

                'form' => [
                    'user_id' => 'Feladó',
                    'start_city_id' => 'Honnan?',
                    'end_city_id' => 'Hova?',
                    'days' => 'Melyik napokon utazol?',
                ],
            ],
        ],

        'access' => [
            'roles' => [
                'create'     => 'Szerepkör létrehozása',
                'edit'       => 'Szerepkör módosítása',
                'management' => 'Szerepkör kezelés',

                'table' => [
                    'number_of_users' => 'Felhasználók száma',
                    'permissions'     => 'Jogosultságok',
                    'role'            => 'Szerepkör',
                    'sort'            => 'Rendez',
                    'total'           => 'role total|roles total',
                ],
            ],

            'users' => [
                'active'              => 'Aktív felhasználók',
                'all_permissions'     => 'Minden jogosultság',
                'change_password'     => 'Jelszó megváltoztatása',
                'change_password_for' => 'Jelszó megváltoztatása ennek :user',
                'create'              => 'Felhasználó létrehozása',
                'deactivated'         => 'Deaktivált felhasználók',
                'deleted'             => 'Törölt felhasználók',
                'edit'                => 'Felhasználó módosítása',
                'management'          => 'Felhasználó kezelés',
                'no_permissions'      => 'Nincsenek Jogosultságok',
                'no_roles'            => 'Nincsenek beállítható szerepkörök.',
                'permissions'         => 'Jogosultságok',
                'user_actions'        => 'Felhasználói cselekvések',

                'table' => [
                    'confirmed'      => 'Jóváhagyott',
                    'created'        => 'Létrehozott',
                    'email'          => 'E-mail',
                    'id'             => 'ID',
                    'last_updated'   => 'Legkésőbbi frissítés',
                    'name'           => 'Név',
                    'first_name'     => 'Vezetéknév',
                    'last_name'      => 'Keresztnév',
                    'no_deactivated' => 'Nincs deaktivált felhasználó',
                    'no_deleted'     => 'Nincs törölt felhasználó',
                    'other_permissions' => 'Más jogosultságok',
                    'permissions'    => 'Jogosultságok',
                    'abilities'      => 'Képességek',
                    'roles'          => 'Szerepkörök',
                    'social'         => 'Közösség',
                    'total'          => 'user total|users total',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Áttekintés',
                        'history'  => 'Történelem',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatár',
                            'confirmed'    => 'Megerősített',
                            'created_at'   => 'Készítve ekkor',
                            'deleted_at'   => 'Törölve ekkor',
                            'email'        => 'E-mail',
                            'last_login_at' => 'Utolsó bejelentkezés',
                            'last_login_ip' => 'Utolsó bejelentkezés IP-je',
                            'last_updated' => 'Utoljára frissítve ekkor',
                            'name'         => 'Név',
                            'first_name'   => 'Vezetéknév',
                            'last_name'    => 'Keresztnév',
                            'status'       => 'Státusz',
                            'timezone'     => 'Időzóna',
                        ],
                    ],
                ],

                'view' => 'Felhasználó megtekintése',
            ],
        ],
    ],

    'frontend' => [

        'footer' => [
            'LepesValtas' => 'Lépés-Váltás',
            'Alsomocsolad' => 'Alsómocsolád Község<br>Önkormányzata',
        ],

        'auth' => [
            'login_box_title'    => 'Bejelentkezés',
            'login_button'       => 'Bejelentkezés',
            'login_with'         => ':social_media bejelentkezés',
            'register_with'      => 'Regisztráció :social_media fiókkal',
            'register_box_title' => 'Regisztráció',
            'register_button'    => 'Regisztráció',
            'remember_me'        => 'Emlékezzen rám',
            'question_register'  => 'Nem regisztrált még a HazaTér rendszerbe?',
            'registration_description' => 'Regisztráljon rendszerünkbe néhány perc alatt pár adat megadásával, és töltsön fel autós utat vagy foglaljon helyet valamelyik útra.',
            'or_with_email'      => 'vagy e-mail címmel',
        ],

        'contact' => [
            'box_title' => 'Lépjen kapcsolatba velünk',
            'button'    => 'Elküld',
        ],

        'terms' => [
            'box_title' => 'Általános felhasználási feltételek',
            'text'      => 'Ide jöhet az ÁFF leírása.',
            'button'    => 'Vissza',
        ],

        'howitworks' => [
            'box_title' => 'Hogyan működik?',
            'text'      => 'Ide jöhet a leírása.',
            'button'    => 'Vissza',
        ],

        'dataprotection' => [
            'box_title' => 'Adatkezelés',
            'text'      => 'Ide jöhet a leírása.',
            'button'    => 'Vissza',
        ],

        'passwords' => [
            'expired_password_box_title'      => 'A jelszava lejárt.',
            'forgot_password'                 => 'Jelszóemlékeztető',
            'reset_password_box_title'        => 'Új jelszó generálás',
            'reset_password_button'           => 'Új jelszó',
            'update_password_button'          => 'Jelszó megváltoztatása',
            'send_password_reset_link_button' => 'Jelszó visszaállító link küldése',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Jelszó megváltoztatása',
            ],

            'profile' => [
                'avatar'             => 'Avatár',
                'created_at'         => 'Létrehozva',
                'edit_information'   => 'Szerkesztés',
                'email'              => 'E-mail',
                'last_updated'       => 'Módosítva',
                'name'               => 'Név',
                'first_name'         => 'Vezetéknév',
                'last_name'          => 'Keresztnév',
                'update_information' => 'Szerkesztés',
            ],
        ],

        'message' => [
            'readed' => 'Olvasva',
            'unread' => 'Olvasatlan',
        ],

    ],
];
