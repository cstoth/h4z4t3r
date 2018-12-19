<div class="">
    {{ Session::get('message') }}
</div>

<div class="container">

    {!! Form::open(['route' => 'teszts.store']) !!}

    @form_maker_table("teszts")

    {!! Form::submit('Save') !!}

    {!! Form::close() !!}

</div>