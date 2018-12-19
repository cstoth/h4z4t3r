<div class="">
    {{ Session::get('message') }}
</div>

<div class="container">

    {!! Form::model($teszt, ['route' => ['teszts.update', $teszt->id], 'method' => 'patch']) !!}

    @form_maker_object($teszt, FormMaker::getTableColumns('teszts'))

    {!! Form::submit('Update') !!}

    {!! Form::close() !!}
</div>
