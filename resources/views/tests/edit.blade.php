<div class="">
    {{ Session::get('message') }}
</div>

<div class="container">

    {!! Form::model($test, ['route' => ['tests.update', $test->id], 'method' => 'patch']) !!}

    @form_maker_object($test, FormMaker::getTableColumns('tests'))

    {!! Form::submit('Update') !!}

    {!! Form::close() !!}
</div>
