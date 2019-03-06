@extends('frontend.layouts.app')

@push('after-styles')
    <style>
        .phone-template {
            display: inline;
            font-style: italic;
        }
    </style>
@endpush

@section('content')

@if($user)
<div class="table-responsive">
    <table class="table" id="ratesTable">
        <thead>
            <tr>
                <th class="col-hidden">id</th>
                <th>Út</th>
                <th>Értékelés</th>
                <th>Megjegyzés</th>
                {{-- <th>Dátum</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($rates as $data)
                <tr class="table-row">
                    <td class="col-hidden">{{ $data->id }}</td>
                    <td>{!! $data->route_label !!}</td>
                    <td>
                        <div class="form-row justify-content-center align-items-center text-center">
                            @php $rating = $data->rate; @endphp
                            @foreach(range(1,5) as $i)
                                <span class="fa-stack" style="width:1em;color:#f2b600">
                                    <i class="far fa-star fa-stack-1x"></i>
                                    @if($rating > 0)
                                        @if($rating > 0.5)
                                            <i class="fas fa-star fa-stack-1x"></i>
                                        @else
                                            <i class="fas fa-star-half fa-stack-1x"></i>
                                        @endif
                                    @endif
                                    @php $rating--; @endphp
                                </span>
                            @endforeach
                            <span>&nbsp;({{$data->rate}})</span>
                        </div>
                    </td>
                    {{-- <td>{!! $data->comment !!}</td> --}}
                    <td>{{\App\Helpers\Hazater::formatDate($data->created_at)}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col">
        <div class="form-group mb-0 clearfix">
            <a href="{{ URL::previous() }}" class="btn btn-info">{{__('buttons.general.return')}}</a>
        </div><!--form-group-->
    </div><!--col-->
    <div class="col text-right">
    </div><!--col-->
</div>
@else
<p>Felhasználó nem található!</p>
@endif

@endsection
