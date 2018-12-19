
<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.cities.megye'))
        ->class('col-md-2 form-control-label')
        ->for('megye') }}

    <div class="col-md-10">
        {{ html()->text('megye')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.cities.megye'))
            ->attribute('maxlength', 191)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.cities.irsz'))
        ->class('col-md-2 form-control-label')
        ->for('irsz') }}

    <div class="col-md-10">
        {{ html()->text('irsz')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.cities.irsz'))
            ->attribute('maxlength', 10)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.cities.name'))
        ->class('col-md-2 form-control-label')
        ->for('name') }}

    <div class="col-md-10">
        {{ html()->text('name')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.cities.name'))
            ->attribute('maxlength', 191)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.cities.kshkod'))
        ->class('col-md-2 form-control-label')
        ->for('kshkod') }}

    <div class="col-md-10">
        {{ html()->text('kshkod')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.cities.kshkod'))
            ->attribute('maxlength', 10)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.cities.x'))
        ->class('col-md-2 form-control-label')
        ->for('x') }}

    <div class="col-md-10">
        {{ html()->text('x')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.cities.x'))
            ->attribute('maxlength', 15)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.cities.y'))
        ->class('col-md-2 form-control-label')
        ->for('y') }}

    <div class="col-md-10">
        {{ html()->text('y')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.cities.y'))
            ->attribute('maxlength', 15)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->
