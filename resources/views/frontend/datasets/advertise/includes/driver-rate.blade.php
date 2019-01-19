@php $uid = $reserve->user_id @endphp

<div class="star-rating">
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

<span>{{ $reserve->user->full_name }}</span>
<br>
