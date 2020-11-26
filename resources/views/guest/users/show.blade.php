@extends('layouts.app')

@section('content')
<div class="page_wrapper">
<div class="user_container">
    {{-- user infos --}}
    <div class="avatar">
        <img src={{$user->avatar}} alt=" ">
    </div>
    <div class="user_infos">
        <h3 class="inline_bl">{{$user->firstname}} {{$user->lastname}}</h3>
        <h4>{{$user->description}}</h4>
    </div>
</div>  

{{-- flats list--}}
<div class="flats_list">
@php
    $arrFlats = $user->flats()->get();
@endphp

{{-- flats details --}}
@foreach($arrFlats as $flat)
    <div class="">
        <div class="flat-img">
            <img src={{$flat->path}} alt=" ">
        </div>
        <div class="flat-info"> 
            <h3>{{$flat->title}}</h3>
            <p>{{$flat->description}}</p>
            <span>Valutazione:  {{$flat->stars}}</span>
        </div>
    </div>
</div>
@endforeach
</div>
@endsection