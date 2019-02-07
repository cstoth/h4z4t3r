@if (1==2)
    {{ html()->form('GET', route('frontend.user.template.load'))->class('form-horizontal')->open() }}

    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">

    @if (count($templates) > 0)
    <div class="form-row" id="template-loader">
        <div class="col-xs-12 col-lg-6">
            <select class="form-control" id="template_id" name="template_id" placeholder="{{ __('dashboard.driver.submit-ad.Template placeholder') }}">
                {{-- <option value="0">Válassz sablont!</option> --}}
                @foreach($templates as $template)
                    <option value="{{ $template->id }}">{{ $template->template }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-lg-1">
            <button id="template-load" name="template-load" type="submit" class="btn btn-info">{{ __('dashboard.driver.submit-ad.Load Template') }}</button>
        </div>
    </div>
    @endif

    {{ html()->form()->close() }}
@endif

<form method="POST" action="{{route('frontend.advertise')}}" class="form-horizontal" autocomplete="off" onsubmit="return validateAdvertiseForm()">
{{ csrf_field() }}

@include('frontend.datasets.advertise.includes.form-controls')

<hr />

{{-- <div class="form-row mt-3">
    <div class="col-xs-12 col-lg-3">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="save-as-template" name="save-as-template">
            <label class="form-check-label" for="inlineCheckbox3">{{ __('dashboard.driver.submit-ad.Save as Template') }}</label>
        </div>
    </div>
    <div class="col-xs-12 col-lg-6">
        <input class="form-control" type="text" id="template" name="template" readonly placeholder="{{ __('dashboard.driver.submit-ad.Template placeholder') }}">
    </div>
</div> --}}

<div class="form-row">
    <div class="col text-center mt-5">
        <button id="advertise-create" type="submit" class="btn btn-success col-md-4">{{ __('dashboard.driver.submit-ad.Submit Button') }}</button>
    </div>
</div>

{{ html()->form()->close() }}

@push('after-scripts')
<script type="text/javascript">
console.log("advertise-create-1");

$('#save-as-template').click(function() {
    var checked = $('#save-as-template').prop("checked");
    $('#template').prop("readonly", !checked);
});

console.log("advertise-create-2");
</script>
@endpush
