@php $uid = $advertise->user_id @endphp

<div class="star-rating">
    <input id="sztar-5" type="radio" name="rating-{{$uid}}" value="5">
    <label for="sztar-5" title="{{__('strings.rating.5')}}">
        <i class="active fa fa-star" aria-hidden="true"></i>
    </label>

    <input id="sztar-4" type="radio" name="rating-{{$uid}}" value="4">
    <label for="sztar-4" title="{{__('strings.rating.4')}}">
        <i class="active fa fa-star" aria-hidden="true"></i>
    </label>

    <input id="sztar-3" type="radio" name="rating-{{$uid}}" value="3">
    <label for="sztar-3" title="{{__('strings.rating.3')}}">
        <i class="active fa fa-star" aria-hidden="true"></i>
    </label>

    <input id="sztar-2" type="radio" name="rating-{{$uid}}" value="2">
    <label for="sztar-2" title="{{__('strings.rating.2')}}">
        <i class="active fa fa-star" aria-hidden="true"></i>
    </label>
    
    <input id="sztar-1" type="radio" name="rating-{{$uid}}" value="1">
    <label for="sztar-1" title="{{__('strings.rating.1')}}">
        <i class="active fa fa-star" aria-hidden="true"></i>
    </label>
</div>

<span>{{ $advertise->user->full_name }}</span>
