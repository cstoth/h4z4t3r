@if(\App\Helpers\Hazater::isUserNotRated($advertise->id, $uid))
    <div class="star-rating form-row justify-content-center align-items-center text-center">
        <input id="{{$uid}}-5" type="radio" name="rating-{{$uid}}" value="5">
        <label for="{{$uid}}-5" title="{{__('strings.rating.5')}}">
            <i class="active fa fa-star" aria-hidden="true"></i>
        </label>

        <input id="{{$uid}}-4" type="radio" name="rating-{{$uid}}" value="4">
        <label for="{{$uid}}-4" title="{{__('strings.rating.4')}}">
            <i class="active fa fa-star" aria-hidden="true"></i>
        </label>

        <input id="{{$uid}}-3" type="radio" name="rating-{{$uid}}" value="3">
        <label for="{{$uid}}-3" title="{{__('strings.rating.3')}}">
            <i class="active fa fa-star" aria-hidden="true"></i>
        </label>

        <input id="{{$uid}}-2" type="radio" name="rating-{{$uid}}" value="2">
        <label for="{{$uid}}-2" title="{{__('strings.rating.2')}}">
            <i class="active fa fa-star" aria-hidden="true"></i>
        </label>
        
        <input id="{{$uid}}-1" type="radio" name="rating-{{$uid}}" value="1">
        <label for="{{$uid}}-1" title="{{__('strings.rating.1')}}">
            <i class="active fa fa-star" aria-hidden="true"></i>
        </label>
    </div>
    <span>{{ $name }}</span>
    <textarea name="comment-{{$uid}}" class="ml-3 align-middle" rows="1" placeholder="Szöveges értékelés">
    </textarea>
@else
    <div class="form-row justify-content-left align-items-center text-left">
    @php $rate = \App\Helpers\Hazater::getUserRate($advertise->id, $uid); @endphp
    <!-- \App\Helpers\Hazater::showRateStars($rate) -->
    @php $rating = $rate->rate; @endphp
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
    &nbsp;<span>{{ "(" . $rate->rate . ") " . $name}}</span>
    <i class="ml-3 align-middle">{{ $rate->comment }}</i>
    </div>
@endif
<br>
