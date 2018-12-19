<div class="">
    {{ Session::get('message') }}
</div>

<div class="container">

    {!! Form::open(['route' => 'tests.store']) !!}

    @form_maker_table("tests")

    {!! Form::submit('Save') !!}

    {!! Form::close() !!}

</div>