<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Strings Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in strings throughout the system.
    | Regardless where it is placed, a string can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'users' => [
                'delete_user_confirm'  => 'Biztos hogy végleg törli ezt a felhasználót? Az applikáció erre hivatkozó részei nagy valószínűséggel hibásak lesznek. Csak Saját felelősségre haladjon tovább. Ez nem visszavonható.',
                'if_confirmed_off'     => '(If confirmed is off)',
                'no_deactivated' => 'Nincsenek deaktivált felhasználók.',
                'no_deleted' => 'Nincsenek Törölt felhasználók.',
                'restore_user_confirm' => 'Visszaállítja ezt a felhasználót az eredeti állapotába?',
            ],
        ],

        'dashboard' => [
            'title'   => 'Irányítópult',
            'welcome' => 'Üdvözöljük',
        ],

        'general' => [
            'all_rights_reserved' => 'Minden jog fenntartva.',
            'are_you_sure'        => 'Biztos benne, hogy törli ezt az elemet?',
            'not_deletable'       => 'A hirdetés nem törölhető!',
            'boilerplate_link'    => 'Laravel 5 Boilerplate',
            'continue'            => 'Folytatás',
            'member_since'        => 'Tagság ettől',
            'minutes'             => ' percek',
            'search_placeholder'  => 'Keresés...',
            'timeout'             => 'Automatikusan kijelentkeztél inaktivitás miatt.',

            'see_all' => [
                'messages'      => 'Összes üzenet megtekintése',
                'notifications' => 'Összes megtekintése',
                'tasks'         => 'Összes feladat megtekintése',
            ],

            'status' => [
                'online'  => 'Online',
                'offline' => 'Offline',
            ],

            'you_have' => [
                'messages'      => '{0} You don\'t have messages|{1} You have 1 message|[2,Inf] You have :number messages',
                'notifications' => '{0} You don\'t have notifications|{1} You have 1 notification|[2,Inf] You have :number notifications',
                'tasks'         => '{0} You don\'t have tasks|{1} You have 1 task|[2,Inf] You have :number tasks',
            ],
        ],

        'search' => [
            'empty'      => 'Kérem írjon be egy keresendő kifejezést.',
            'incomplete' => 'Ehhez a rendszerhez saját keresőlogikát kell írnia.',
            'title'      => 'Keresés eredménye',
            'results'    => 'Keresési eredmények ehhez :query',
        ],

        'welcome' => 'Welcome to the Dashboard',
    ],

    'emails' => [
        'auth' => [
            'account_confirmed'       => 'A profilja jóváhagyásra került.',
            'error'                   => 'Hoppá!',
            'greeting'                => 'Üdvözöljük!',
            'regards'                 => 'Üdvözlettel,',
            'Regards'                 => 'Üdvözlettel,',
            'trouble_clicking_button' => 'Ha gondod adódik a(z) ":action_text" gomb használatával, másold az alábbi linket a böngésződbe:',
            'thank_you_for_using_app' => 'Köszönjük, hogy a HazaTér rendszert használod!',

            'password_reset_subject'    => 'Új jelszó generálás',
            'password_cause_of_email'   => 'Ezt a levelet azért kapta mert a felhasználói fiókjához új jelszó generálási kérelem érkezett.',
            'password_if_not_requested' => 'Ha nem Ön kezdeményezte az új jelszó generálását, akkor nincsen más teendője.',
            'reset_password'            => 'Kattintson ide az új jelszó generálásához',

            'click_to_confirm' => 'Kattints ide a felhasználói fiókod aktiválásához:',
            "If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
            'into your web browser: [:actionURL](:actionURL)' => 'Amennyiben az ":actionText" gombra kattinva nem sikerül az új jelszavát beállítani, kérjük másolja be az alábbi URL-t a böngészőjébe: [:actionURL](:actionURL)',
        ],

        'contact' => [
            'email_body_title' => 'Új üzenete érkezett a HazaTér rendszer kapcsolat űrlapján keresztül:',
            'subject' => 'Egy új :app_name kapcsolat űrlapja érkezett!',
            'email_body' => '',
            'email_button' => '',
        ],

        'hunter' => [
            'email_body_title' => 'Új üzenete érkezett a HazaTér rendszer hirdetésfigyelőjén keresztül:',
            'subject' => 'Egy új :app_name hirdetésfigyelő értesítése érkezett!',
            'email_body' => '',
            'email_button' => '',
        ],

        'advertise' => [
            'email_body_title' => 'A HazaTér rendszerben megnézheti az aktuális hirdetést.',
            'subject' => 'Módosították az egyik hirdetést, amire helyet foglalt.',
            'email_body' => '',
            'email_button' => '',
        ],

        'meadvertise' => [
            'email_body_title' => 'A HazaTér rendszerben megnézheti az aktuális hirdetést.',
            'subject' => 'Módosította az egyik hirdetését.',
            'email_body' => '',
            'email_button' => '',
        ],

        'delete' => [
            'email_body_title' => 'A HazaTér rendszerben megnézheti a törlésre került hirdetést.\nItt vonja vissza a helyfoglalását!',
            'subject' => 'Törölték az egyik hirdetést, amire helyet foglalt.',
            'email_body' => '',
            'email_button' => '',
        ],

        'medelete' => [
            'email_body_title' => 'A HazaTér rendszerben Törölte az egyik hirdetését.\nItt feladthat új utat!',
            'subject' => 'Törölte az egyik hirdetését.',
            'email_body' => '',
            'email_button' => '',
        ],

        'cancel' => [
            'email_body_title' => 'A HazaTér rendszerben megnézheti a hirdetést.',
            'subject' => 'Visszavonták az egyik hirdetéséhez tartozó helyfoglalást.',
            'email_body' => '',
            'email_button' => '',
        ],

        'mecancel' => [
            'email_body_title' => 'A HazaTér rendszerben megnézheti a hirdetést.',
            'subject' => 'Visszavonta az egyik helyfoglalását.',
            'email_body' => '',
            'email_button' => '',
        ],

        'reserve' => [
            'email_body_title' => 'A HazaTér rendszerben megnézheti az utasai listáját.',
            'subject' => 'Helyfoglalást adtak fel az egyik hirdetésére.',
            'email_body' => '',
            'email_button' => '',
        ],

        'mereserve' => [
            'email_body_title' => 'A HazaTér rendszerben megnézheti a helyfoglalását.',
            'subject' => 'Helyfoglalást adott fel egy hirdetésre.',
            'email_body' => '',
            'email_button' => '',
        ],

        'driver' => [
            'email_body_title' => 'A HazaTér rendszerben lezárhatja az hirdetését.',
            'subject' => 'Hirdetés lezárása.',
            'email_body' => 'Ezt a levelet azért kapta mert, az egyik utazása befejeződött.',
            'email_button' => 'Hirdetés lezárása',
        ],

        'passanger' => [
            'email_body_title' => 'A HazaTér rendszerben lezárhatja az utazását.',
            'subject' => 'Utazás befejezése.',
            'email_body' => 'Ezt a levelet azért kapta mert, az egyik utazása befejeződött.',
            'email_button' => 'Utazás lezárása',
        ],
    ],

    'frontend' => [
        'test' => 'Teszt',

        'tests' => [
            'based_on' => [
                'permission' => 'Permission Based - ',
                'role'       => 'Role Based - ',
            ],

            'js_injected_from_controller' => 'Javascript Injected from a Controller',

            'using_blade_extensions' => 'Using Blade Extensions',

            'using_access_helper' => [
                'array_permissions'     => 'Using Access Helper with Array of Permission Names or ID\'s where the user does have to possess all.',
                'array_permissions_not' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does not have to possess all.',
                'array_roles'           => 'Using Access Helper with Array of Role Names or ID\'s where the user does have to possess all.',
                'array_roles_not'       => 'Using Access Helper with Array of Role Names or ID\'s where the user does not have to possess all.',
                'permission_id'         => 'Using Access Helper with Permission ID',
                'permission_name'       => 'Using Access Helper with Permission Name',
                'role_id'               => 'Using Access Helper with Role ID',
                'role_name'             => 'Using Access Helper with Role Name',
            ],

            'view_console_it_works'          => 'View console, you should see \'it works!\' which is coming from FrontendController@index',
            'you_can_see_because'            => 'You can see this because you have the role of \':role\'!',
            'you_can_see_because_permission' => 'You can see this because you have the permission of \':permission\'!',
        ],

        'general' => [
            'joined'        => 'Regisztrált',
        ],

        'user' => [
            'change_email_notice'   => 'Az email cím megváltoztatása után ki lesz léptetve a rendszerből, amíg nem igazolja vissza az új címét.',
            'email_changed_notice'  => 'Meg kell erősítenie az új e-mail mielőtt bejelentkezne.',
            'profile_updated'       => 'A profil módosítása sikeres.',
            'password_updated'      => 'A jelszó megváltoztatása sikeres.',
        ],

        'welcome_to' => 'Üdvözli a(z) :place',
        'no_results_found' => 'Nincs a keresésnek megfelelő találat!',
    ],

    'rating' => [
        '1' => 'Ájjáj',
        '2' => 'Szódával elmegy',
        '3' => 'Alap',
        '4' => 'Jó',
        '5' => 'Kiváló',
    ],
];
