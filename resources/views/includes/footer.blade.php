<div class="footer-bg container-fluid">
    <a href="https://www.facebook.com/alsomocsolad/" target="_blank"><div class="fb-logo"></div></a>

    <div class="row align-items-center">

        <div class="col-lg-4 col-md-12 col-12 justify-content-center">
            <div class="row">
                <div class="col col-2 col-md-3"></div>
                <div class="col col-8 col-md-6">
                    <div class="row"><a class="footer-menu-link" href="{{route('frontend.howitworks')}}">@lang('navs.frontend.how-it-works')</a></div>
                    <div class="row"><a class="footer-menu-link" href="{{route('frontend.contact')}}">@lang('navs.frontend.contact')</a></div>
                    <div class="row"><a class="footer-menu-link" href="{{route('frontend.terms')}}">@lang('navs.frontend.terms')</a></div>
                    <div class="row"><a class="footer-menu-link" href="{{route('frontend.dataprotection')}}">@lang('navs.frontend.data-protection')</a></div>
                </div>
                <div class="col col-2 col-md-3"></div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12 col-12 justify-content-center">
            <div class="row justify-content-center align-items-center ml-1 mr-1 mt-1 mb-1">
                <a class="middle-center" href="http://alsomocsolad.hu/?p=8999" target="_blank">
                    <img src="{{ asset('img/frontend/lepes_valtas_logo.png') }}" alt="{{ __('labels.frontend.footer.LepesValtas') }}" style="width:100%">
                </a>
            </div>
            <div class="row justify-content-center align-items-center ml-1 mr-1 mt-1 mb-1">
                <img class="mt-1" src="{{ asset('img/frontend/EU_zaszlo_CMYK.png') }}" >
            </div>
        </div>

        <div class="col-lg-2 col-md-12 col-12 justify-content-center">
            <div class="row justify-content-center align-items-center">
                <a href="http://alsomocsolad.hu/" target="_blank"><img src="{{ asset('img/frontend/alsomocsolad_logo.png') }}" alt="{{ __('labels.frontend.footer.Alsomocsolad') }}"></a>
            </div>
            <div class="row justify-content-center align-items-center text-center">
                <a class="footer-link" href="http://alsomocsolad.hu/">Alsómocsolád község önkormányzata</a>
            </div>
        </div>

        {{-- <div class="col-lg-2 col-md-12 col-12 justify-content-center">
            <div class="infoblokk">
                <img class="infoblokk-image" src="{{ asset('img/frontend/infoblokk_kedv_final_CMYK_ESZA.png') }}">
            </div>
        </div> --}}

    </div>

    <div class="innoteq mr-1"><a href="http://innoteq.hu" target="_blank">Website by Innoteq</a></div>
    <div class="copyright"><a>&copy; {{ date('Y') }} Minden jog fenntartva</a></div>
</div>
