{{ html()->form('POST', route('frontend.datasets.hunter.store'))->class('form')->attribute('autocomplete', 'off')->open() }}
<div class="row mt-4">
    <div class="col">
        @include('frontend.datasets.hunter.includes.form-controls')
    </div><!--col-->
</div><!--row-->

<div class="col text-center">
    {{ form_submit(__('buttons.general.crud.create')) }}
</div><!--col-->
{{ html()->form()->close() }}
