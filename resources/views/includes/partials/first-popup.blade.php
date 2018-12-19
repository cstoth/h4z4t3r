@if(1==1)
    <style>
        .swal2-popup .swal2-close {
            float: right;
            margin-top:-18px;
            margin-right:-18px;
            cursor:pointer;
            color: #fff;
            border: 1px solid #AEAEAE;
            border-radius: 30px;
            background: #FF0000;
            font-size: 32px;
            font-weight: bold;
            display: inline-block;
            line-height: 0px;
            padding: 14px 3px;
        }
    </style>
    <script>
        function getCookie(name) {
            var nameEQ = name + "=";
            //alert(document.cookie);
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1);
                if (c.indexOf(nameEQ) != -1) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }
        if (!getCookie("hazater_popup_seen")) {
            swal({
                //title: 'TESZT ÜZEMMÓD',
                //type: 'info',
                html: 
                '<strong>TESZT ÜZEMMÓD</strong><br><br>' +
                '<p align="left"><b>Kedves Felhasználó!</b><br><br>' +
                'A HazaTér interaktív közösségi közlekedés-támogató rendszer jelenleg tesztüzem alatt működik.<br><br>' +
                'Ezt azt jelenti, hogy előfordulhatnak még hibák, amik javításra szorulnak.<br><br>' +
                'Kérjük segítsd a munkánkat azzal, hogy regisztrálsz honlapunkon és velünk együtt teszteled a rendszert.<br><br>' +
                'Amennyiben bármilyen építő jellegű észrevételed van, kérjük jelezd azt felénk a <a href="mailto:teszteljvelunk@hazater.hu">teszteljvelunk@hazater.hu</a> e-mail címre küldött üzenettel.<br><br>' +
                'Segítségedet előre is köszönjük!<br><br>' +
                'Üdvözlettel,<br><b>HazaTér csapata</b>',
                showCloseButton: true,
                focusConfirm: true,
                allowOutsideClick: false,
                confirmButtonText: 'Rendben',
                confirmButtonAriaLabel: 'Thumbs up, great!',
            }).then((result) => {
                if (result.value) {
                    console.log("OK");
                    document.cookie="hazater_popup_seen=true;expires=Wed, 18 Dec 2020 12:00:00 GMT";
                }
            });
        }
    </script>
@endif
