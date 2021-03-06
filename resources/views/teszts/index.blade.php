<div class="container">

    <div class="">
        {{ Session::get('message') }}
    </div>

    <div class="row">
        <div class="pull-right">
            {!! Form::open(['route' => 'teszts.search']) !!}
            <input class="form-control form-inline pull-right" name="search" placeholder="Search">
            {!! Form::close() !!}
        </div>
        <h1 class="pull-left">Teszts</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('teszts.create') !!}">Add New</a>
    </div>

    <div class="row">
        @if($teszts->isEmpty())
            <div class="well text-center">No teszts found.</div>
        @else
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th width="50px">Action</th>
                </thead>
                <tbody>
                @foreach($teszts as $teszt)
                    <tr>
                        <td>
                            <a href="{!! route('teszts.edit', [$teszt->id]) !!}">{{ $teszt->name }}</a>
                        </td>
                        <td>
                            <a href="{!! route('teszts.edit', [$teszt->id]) !!}"><i class="fa fa-pencil"></i> Edit</a>
                            <form method="post" action="{!! route('teszts.destroy', [$teszt->id]) !!}">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this teszt?')"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row">
                {!! $teszts; !!}
            </div>
        @endif
    </div>
</div>