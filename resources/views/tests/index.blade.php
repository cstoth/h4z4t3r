<div class="container">

    <div class="">
        {{ Session::get('message') }}
    </div>

    <div class="row">
        <div class="pull-right">
            {!! Form::open(['route' => 'tests.search']) !!}
            <input class="form-control form-inline pull-right" name="search" placeholder="Search">
            {!! Form::close() !!}
        </div>
        <h1 class="pull-left">Tests</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('tests.create') !!}">Add New</a>
    </div>

    <div class="row">
        @if($tests->isEmpty())
            <div class="well text-center">No tests found.</div>
        @else
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th width="50px">Action</th>
                </thead>
                <tbody>
                @foreach($tests as $test)
                    <tr>
                        <td>
                            <a href="{!! route('tests.edit', [$test->id]) !!}">{{ $test->name }}</a>
                        </td>
                        <td>
                            <a href="{!! route('tests.edit', [$test->id]) !!}"><i class="fa fa-pencil"></i> Edit</a>
                            <form method="post" action="{!! route('tests.destroy', [$test->id]) !!}">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this test?')"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row">
                {!! $tests; !!}
            </div>
        @endif
    </div>
</div>