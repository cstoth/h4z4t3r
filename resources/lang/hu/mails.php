<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Email texts
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in the mails.
    |
    */
    'null' => [
        'subject'   => '',
        'upper'     => '',
        'button'    => '',
        'lower'     => '',
    ],

    'hunter' => [
        'subject'   => 'Egy új :app_name hirdetésfigyelő értesítése érkezett.',
        'upper'     => 'Ezt a levelet azért kapta, mert a HazaTér rendszerében feladtak egy Önnek megfelelő hirdetést.',
        'button'    => 'Ugrás a hirdetésre',
        'image'     => 'ugras_a_hirdetesre.png',
        'lower'     => '',
    ],

    'new-password' => [
        'subject'   => 'Új jelszó generálás',
        'upper'     => 'Ezt a levelet azért kapta, mert a felhasználói fiókjához új jelszó generálási kérelem érkezett.',
        'button'    => 'Új jelszó generálás',
        'image'     => 'uj_jelszo_generalas.png',
        'lower'     => 'Ha nem Ön kezdeményezte az új jelszó generálását, akkor nincsen más teendője.',
    ],

    'reserve' => [
        'subject'   => 'Helyfoglalást adtak fel az egyik hirdetésére.',
        'upper'     => 'Ezt a levelet azért kapta, mert helyfoglalást adtak fel az egyik hirdetésére:',
        'button'    => 'Ugrás a hirdetésre',
        'image'     => 'ugras_a_hirdetesre.png',
        'lower'     => '<p style="font-size:1em">Ha nem az Ön meghirdetett útjára történt a helyfoglalás, akkor nincsen más teendője.</p>',
    ],

    'mereserve' => [
        'subject'   => 'Helyfoglalást adott fel egy hirdetésre.',
        'upper'     => 'Ezt a levelet azért kapta, mert Ön helyet foglalt az egyik útra a HazaTér rendszerében:',
        'button'    => 'Ugrás a hirdetésre',
        'image'     => 'ugras_a_hirdetesre.png',
        'lower'     => 'Ha nem az Ön meghirdetett útjára történt a helyfoglalás, akkor nincsen más teendője.',
    ],

    'revoke' => [
        'subject'   => 'Visszavonták az egyik hirdetést, amire helyet foglalt.',
        'upper'     => 'Ezt a levelet azért kapta, mert a HazaTér rendszerében visszavonásra került egy hirdetés, melyre helyet foglalt. Kérjük egyeztessen a sofőrrel a visszavonásról és iratkozzon le az útról az alábbi linken:',
        'button'    => 'Ugrás a hirdetésre',
        'image'     => 'ugras_a_hirdetesre.png',
        'lower'     => 'Ha nem az Ön meghirdetett útjára történt a helyfoglalás, akkor nincsen más teendője.',
    ],

    'update' => [
        'subject'   => 'Módosították az egyik hirdetést, amire helyet foglalt.',
        'upper'     => 'Ezt a levelet azért kapta, mert a HazaTér rendszerében módosításra került egy hirdetés, melyre helyet foglalt. Megnézheti a változásokat a lenti linkre kattintva. Amennyiben szükséges, kérjük egyeztessen az utat meghirdető sofőrrel a részletekről.',
        'button'    => 'Ugrás a hirdetésre',
        'image'     => 'ugras_a_hirdetesre.png',
        'lower'     => 'Ha nem az Ön meghirdetett útjára történt a helyfoglalás, akkor nincsen más teendője.',
    ],

    'meupdate' => [
        'subject'   => 'Módosította az egyik hirdetését.',
        'upper'     => 'Ezt a levelet azért kapta, mert a HazaTér rendszerében módosításra került egy hirdetése. Megnézheti a változásokat a lenti linkre kattintva. Amennyiben szükséges, kérjük egyeztessen az utat meghirdető sofőrrel a részletekről.',
        'button'    => 'Ugrás a hirdetésre',
        'image'     => 'ugras_a_hirdetesre.png',
        'lower'     => 'Ha nem az Ön meghirdetett útjára történt a helyfoglalás, akkor nincsen más teendője.',
    ],

    'cancel' => [
        'subject'   => 'Visszavonta az egyik hirdetéséhez tartozó helyfoglalását.',
        'upper'     => 'Ezt a levelet azért kapta, mert a HazaTér rendszerében visszavonásra került az egyik hirdetéshez tartozó, korábban leadott helyfoglalása.',
        'button'    => 'Ugrás a hirdetésre',
        'image'     => 'ugras_a_hirdetesre.png',
        'lower'     => 'Ha nem az Ön meghirdetett útjára történt a helyfoglalás, akkor nincsen más teendője.',
    ],

    'mecancel' => [
        'subject'   => 'Visszavonták az egyik hirdetéséhez tartozó helyfoglalást.',
        'upper'     => 'Ezt a levelet azért kapta, mert a HazaTér rendszerében az Ön hirdetésére leadott helyfoglalás visszavonásra került.',
        'button'    => 'Ugrás a hirdetésre',
        'image'     => 'ugras_a_hirdetesre.png',
        'lower'     => 'Ha nem az Ön meghirdetett útjára történt a helyfoglalás, akkor nincsen más teendője.',
    ],

    'delete' => [
        'subject'   => 'Törölték az egyik hirdetést, amire helyet foglalt.',
        'upper'     => 'Ezt a levelet azért kapta, mert a HazaTér rendszerében törlésre került egy hirdetés, melyre helyet foglalt.',
        'button'    => 'Új hirdetés keresése',
        'image'     => 'uj_hirdetes_keresese.png',
        'lower'     => 'Ha nem az Ön meghirdetett útjára történt a helyfoglalás, akkor nincsen más teendője.',
    ],

    'medelete' => [
        'subject'   => 'Törölte az egyik hirdetését.',
        'upper'     => 'Ezt a levelet azért kapta, mert a HazaTér rendszerében törlésre került az Ön hirdetése.',
        'button'    => 'Új hirdetés feladása',
        'image'     => 'uj_hirdetes_feladasa.png',
        'lower'     => 'Ha nem az Ön meghirdetett útjára történt a helyfoglalás, akkor nincsen más teendője.',
    ],

    'rate' => [
        'subject'   => '"HazaTér" utazás értékelés.',
        'upper'     => 'Örülünk, hogy a HazaTér rendszerrel utazott, reméljünk minden rendben volt.<br>Kérjük segítse munkánkat és értékelje utazását néhány kattintással.',
        'button'    => 'Értékelek',
        'image'     => 'ertekelek.png',
        'lower'     => '',
    ],
];
