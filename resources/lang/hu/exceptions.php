<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Exception Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in Exceptions thrown throughout the system.
    | Regardless where it is placed, a button can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'roles' => [
                'already_exists'    => 'Ez a jogosultság már létezik. Kérjük válasszon másik nevet.',
                'cant_delete_admin' => 'Az Adminisztrátori jogosultságt nem törölheti.',
                'create_error'      => 'Probléma adódott a jogosultság létrehozásával. Kérjük próbálja újra.',
                'delete_error'      => 'Probléma adódott a jogosultság törlésével. Kérjük próbálja újra.',
                'has_users'         => 'Azokat a jogosultságokat nem törölheti amikhez felhasználók tartoznak.',
                'needs_permission'  => 'Legalább egy engedélyt kell választania ehhez a jogosultsághoz.',
                'not_found'         => 'Ez a jogosultság nem létezik.',
                'update_error'      => 'Hiba történt a jogosultság frissítése közben. Kérjük próbálja újra.',
            ],

            'users' => [
                'already_confirmed'    => 'Ezt a felhasználót már aktiválták.',
                'cant_confirm' => 'Hiba történt a felhasználó aktiválása közben.',
                'cant_deactivate_self'  => 'Ezt önmaga nem teheti meg.',
                'cant_delete_admin'  => 'A Szuper Adminisztrátort nem törölheti.',
                'cant_delete_self'      => 'Önmagát nem törölheti',
                'cant_delete_own_session' => 'A saját munkamenetét nem törölheti.',
                'cant_restore'          => 'Ez a felhasználó nincs törölve, így a visszaállítása nem lehetséges.',
                'cant_unconfirm_admin' => 'A Szuper Adminisztrátort nem teheti megerősítetlenné.',
                'cant_unconfirm_self' => 'Önmagátnem teheti megerősítetlenné.',
                'create_error'          => 'Hiba történt a felhasználó létrehozása közben. Kérjük próbálja újra.',
                'delete_error'          => 'Hiba történt a felhasználó törlése közben. Kérjük próbálja újra.',
                'delete_first'          => 'Ezt a felhasználót törölni kell a teljes megsemmisítéshez.',
                'email_error'           => 'Ez az e-mail cím egy másik felhasználóhoz tartozik.',
                'mark_error'            => 'Hiba történt a felhasználó frissítése közben. Kérjük próbálja újra.',
                'not_confirmed'            => 'Ez a felhasználó nincs megerősítve.',
                'not_found'             => 'Ez a felhasználó nem létezik.',
                'restore_error'         => 'Hiba történt a felhasználóvisszaállítása közben. Please try again.',
                'role_needed_create'    => 'Legalább egy jogosultság kell választania.',
                'role_needed'           => 'Legalább egy jogosultság kell választania.',
                'session_wrong_driver'  => 'Your session driver must be set to database to use this feature.',
                'social_delete_error' => 'Hiba történt a közösségi oldal eltávolítása közben, ennél a felhasználónál.',
                'update_error'          => 'Hiba történt a felhasználó frissítése közben. Kérjük próbálja újra.',
                'update_password_error' => 'Hiba történt a felhasználó jelszavának megváltoztatása közben. Kérjük próbálja újra.',
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => 'Felhasználói fiókod már aktiválva van.',
                'confirm'           => 'Aktiváld a felhasználói fiókodat!',
                'created_confirm'   => 'A felhasználói fiókod elkészült. Aktivációs email-t küldtünk a megadott címre.',
                'created_pending'   => 'A felhasználód sikeresen létre lett hozva és jóváhagyásra vár. Egy e-mailt küldünk amint jóvá lesz hagyva.',
                'mismatch'          => 'Az aktiváló kód nem egyezik.',
                'not_found'         => 'Az aktiváló kód nem létezik.',
                'pending'           => 'A felhasználói fiókod jóváhagyásra vár.',
                'resend'            => 'Felhasználói fiókod nég nem aktiváltad. Kattints a kiküldött levélben az aktiválásra vagy <a href=":url">ide</a> az email újraküldéséhez.',
                'success'           => 'A felhasználói fiókod aktiválása sikeresen megtörtént.',
                'resent'            => 'Egy új aktiváló email-t küldtünk ki a címedre.',
            ],

            'deactivated' => 'A felhasználói fiókod deaktiválásra került.',
            'email_taken' => 'Ez az e-mail cím már felhasználásra került.',

            'password' => [
                'change_mismatch' => 'Ez nem a régi jelszavad.',
                'reset_problem' => 'Probléma adódott a jelszavad visszaállítása közben. Kérjük küldje el ismét a jelszó visszaállító e-mailt.',
            ],

            'registration_disabled' => 'A regisztráció jelenleg szünetel.',
        ],
    ],
];
