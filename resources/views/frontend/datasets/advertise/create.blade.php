<form method="POST" action="{{route('frontend.advertise')}}" class="form-horizontal" autocomplete="off" onsubmit="return validateAdvertiseForm()">
{{ csrf_field() }}

@include('frontend.datasets.advertise.includes.form-controls')

<hr />

<div class="form-row">
    <div class="col text-center mt-1">
        <button id="advertise-create" type="submit" class="btn btn-success col-md-4">{{ __('dashboard.driver.submit-ad.Submit Button') }}</button>
    </div>
</div>

{{ html()->form()->close() }}

@push('after-scripts')
<script type="text/javascript">
console.log("advertise-create-1");

console.log("advertise-create-2");
</script>
@endpush
