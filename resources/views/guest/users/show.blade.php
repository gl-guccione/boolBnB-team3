@extends('layouts.app')

@section('content')
<div class="display_flex">
    {{-- user info --}}
    <div class="">
        <img src={{$user->avatar}} alt=" ">
    </div>
    <div class="">
        <h3 class="inline_bl">{{$user->firstname}} {{$user->lastname}}</h3>
        <h4>{{$user->description}}</h4>
    </div>
</div>  
<div class="flat_list">
@php
    $arrFlats = $user->flats()->get();
@endphp

{{-- flats details --}}
@foreach($arrFlats as $flat)
    <div class="display_flex">
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

@endsection