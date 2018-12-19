
<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.user_id'))
        ->class('col-md-2 form-control-label')
        ->for('user_id') }}

    <div class="col-md-10">
        {{ html()->text('user_id')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.car.user_id'))
            ->attribute('maxlength', 191)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.license'))
        ->class('col-md-2 form-control-label')
        ->for('license') }}

    <div class="col-md-10">
        {{ html()->text('license')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.car.license'))
            ->attribute('maxlength', 10)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.brand'))
        ->class('col-md-2 form-control-label')
        ->for('brand') }}

    <div class="col-md-10">
        {{ html()->text('brand')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.car.brand'))
            ->attribute('maxlength', 191)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.type'))
        ->class('col-md-2 form-control-label')
        ->for('type') }}

    <div class="col-md-10">
        {{ html()->text('type')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.car.type'))
            ->attribute('maxlength', 100)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.year'))
        ->class('col-md-2 form-control-label')
        ->for('year') }}

    <div class="col-md-10">
        {{ html()->text('year')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.car.year'))
            ->attribute('maxlength', 4)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.seats'))
        ->class('col-md-2 form-control-label')
        ->for('seats') }}

    <div class="col-md-10">
        {{ html()->text('seats')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.car.seats'))
            ->attribute('maxlength', 2)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.color'))
        ->class('col-md-2 form-control-label')
        ->for('color') }}

    <div class="col-md-10">
        {{ html()->text('color')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.car.color'))
            ->attribute('maxlength', 100)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.image'))
        ->class('col-md-2 form-control-label')
        ->for('image') }}

    <div class="col-md-10">
        {{ html()->text('image')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.car.image'))
            ->attribute('maxlength', 191)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.smoke'))->class('col-md-2 form-control-label')->for('smoke') }}

    <div class="col-md-10">
        <label class="switch switch-label switch-pill switch-primary">
            <input name="smoke" type="hidden" value="0" />
            {{ html()->checkbox('smoke', (isset($car->smoke) ? $car->smoke : false), '1')->class('switch-input') }}
            <span class="switch-slider" data-checked="igen" data-unchecked="nem"></span>
        </label>
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.cooler'))->class('col-md-2 form-control-label')->for('cooler') }}

    <div class="col-md-10">
        <label class="switch switch-label switch-pill switch-primary">
            <input name="cooler" type="hidden" value="0" />
            {{ html()->checkbox('cooler', (isset($car->cooler) ? $car->cooler : false), '1')->class('switch-input') }}
            <span class="switch-slider" data-checked="igen" data-unchecked="nem"></span>
        </label>
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.pet'))->class('col-md-2 form-control-label')->for('pet') }}

    <div class="col-md-10">
        <label class="switch switch-label switch-pill switch-primary">
            <input name="pet" type="hidden" value="0" />
            {{ html()->checkbox('pet', (isset($car->pet) ? $car->pet : false), '1')->class('switch-input') }}
            <span class="switch-slider" data-checked="igen" data-unchecked="nem"></span>
        </label>
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.bag'))->class('col-md-2 form-control-label')->for('bag') }}

    <div class="col-md-10">
        <label class="switch switch-label switch-pill switch-primary">
            <input name="bag" type="hidden" value="0" />
            {{ html()->checkbox('bag', (isset($car->bag) ? $car->bag : false), '1')->class('switch-input') }}
            <span class="switch-slider" data-checked="igen" data-unchecked="nem"></span>
        </label>
    </div><!--col-->
</div><!--form-group-->
