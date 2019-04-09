@push('after-styles')
    <style>
        .input-group-text {
            cursor: pointer;
        }
    </style>
@endpush

{{ html()->hidden('user_id', Auth::user()->id ) }}

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.license'))
        ->class('col-md-2 form-control-label required')
        ->for('license') }}

    <div class="col-md-2">
        {{ html()->text('license')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.car.license'))
            ->attribute('maxlength', 10)
            ->required() }}
    </div><!--col-->

    <div class="col-md-4">
        <label for="">Pl: ABC-123</label>
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.brand'))
        ->class('col-md-2 form-control-label required')
        ->for('brand') }}

    <div class="col-md-6">
        {{ html()->text('brand')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.car.brand'))
            ->attribute('maxlength', 191)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.type'))
        ->class('col-md-2 form-control-label required')
        ->for('type') }}

    <div class="col-md-6">
        {{ html()->text('type')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.car.type'))
            ->attribute('maxlength', 100)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.color'))
        ->class('col-md-2 form-control-label required')
        ->for('color') }}

    <div class="col-md-4">
        {{ html()->text('color')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.car.color'))
            ->attribute('maxlength', 100)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.year'))
        ->class('col-md-2 form-control-label required')
        ->for('year') }}

    <div class="col-md-2">
        {{ html()->text('year')
            ->type('number')
            ->attribute('min', 1950) // Benz Patent No. 1., az első autó 1886-ból
            ->attribute('max', 2999)
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.datasets.car.year'))
            ->attribute('maxlength', 4)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.seats'))
        ->class('col-md-2 form-control-label required')
        ->for('seats') }}

    <div class="col-md-2">
        {{ html()->text('seats')
            ->type('number')
            ->attribute('min', 1)
            ->attribute('max', 20)
            ->class('form-control cl-1')
            ->placeholder(__('validation.attributes.backend.datasets.car.seats'))
            ->attribute('maxlength', 2)
            ->required() }}
    </div><!--col-->
    <div class="col-md-4">
        <label for="">Kérjük adja meg a gépjármű utasai számára fenntartott összes szabad ülés számát.</label>
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.image'))
        ->class('col-md-2 form-control-label')
        ->for('image') }}

    <div class="input-group col-md-6">
        <label class="custom-file border">
            {{ html()->file('image')->class('form-control custom-file-input') }}
            <span class="custom-file-control pr-3" id="imageName" style="white-space: nowrap;">Nincs file kiválasztva</span>
            <div class="input-group-append">
                <span class="input-group-text" id="inputGroupFile">File kiválasztása</span>
            </div>
        </label>
    </div><!--col-->
    @if($car->image)
        <span>
            <a class="text-danger" href="#" onclick="deleteImage(1);return false;" title="Kép törlése"><i class="fas fa-times"></i></a>
        </span>
    @endif
</div><!--form-group-->

<div class="form-group row">
    <label for="image" class="col-md-2 form-control-label"></label>
    <div class="col-md-6">
        @if (isset($car))
            @if($car->image)
                <img id="carImage" src="{{ $car->picture }}" class="car-image" />
            @else
                Nincs kép feltöltve!
            @endif
        @endif
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.image2'))
        ->class('col-md-2 form-control-label')
        ->for('image2') }}

    <div class="col-md-6">
        {{ html()->file('image2')->class('form-control') }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    <label for="image" class="col-md-2 form-control-label"></label>
    <div class="col-md-6">
        @if (isset($car))
            @if($car->image2)
                <img id="carImage2" src="{{ $car->picture2 }}" class="car-image" />
            @else
                Nincs kép feltöltve!
            @endif
        @endif
    </div><!--col-->
</div><!--form-group-->

{{-- <div class="form-group row">
    {{ html()->label("Egyéb:")->class('col-md-2 form-control-label') }}
</div><!--form-group--> --}}

<hr>

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.smoke'))->class('col-md-2 form-control-label')->for('smoke') }}

    <div class="col-md-1">
        <label class="switch switch-label switch-pill switch-primary">
            <input name="smoke" type="hidden" value="0" />
            {{ html()->checkbox('smoke', (isset($car->smoke) ? $car->smoke : false), '1')->class('switch-input') }}
            <span class="switch-slider" data-checked="igen" data-unchecked="nem"></span>
        </label>
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.cooler'))->class('col-md-2 form-control-label')->for('cooler') }}

    <div class="col-md-1">
        <label class="switch switch-label switch-pill switch-primary">
            <input name="cooler" type="hidden" value="0" />
            {{ html()->checkbox('cooler', (isset($car->cooler) ? $car->cooler : false), '1')->class('switch-input') }}
            <span class="switch-slider" data-checked="igen" data-unchecked="nem"></span>
        </label>
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.pet'))->class('col-md-2 form-control-label')->for('pet') }}

    <div class="col-md-1">
        <label class="switch switch-label switch-pill switch-primary">
            <input name="pet" type="hidden" value="0" />
            {{ html()->checkbox('pet', (isset($car->pet) ? $car->pet : false), '1')->class('switch-input') }}
            <span class="switch-slider" data-checked="igen" data-unchecked="nem"></span>
        </label>
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.datasets.car.bag'))->class('col-md-2 form-control-label')->for('bag') }}

    <div class="col-md-1">
        <label class="switch switch-label switch-pill switch-primary">
            <input name="bag" type="hidden" value="0" />
            {{ html()->checkbox('bag', (isset($car->bag) ? $car->bag : false), '1')->class('switch-input') }}
            <span class="switch-slider" data-checked="igen" data-unchecked="nem"></span>
        </label>
    </div><!--col-->
</div><!--form-group-->

@push('after-scripts')
<script type="text/javascript">

console.log("car-form-1");

function deleteImage(id) {
    if (id == 1) {
        $("#image").val("");
        $("#carImage").attr("src", "");
        $('#imageName').html("Nincs file kiválasztva");
    } else {
        $("#image2").val("");
        $("#carImage2").attr("src", "");
        $('#imageName2').html("Nincs file kiválasztva");
    }
    return false;
}

$('#image').change(function(){
  if (this.files && this.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        selectedImage = e.target.result;
        $('#carImage').attr('src', selectedImage);
    };
    $('#imageName').html(this.files[0].name);
    reader.readAsDataURL(this.files[0]);
  }
});

console.log("car-form-2");

</script>
@endpush
