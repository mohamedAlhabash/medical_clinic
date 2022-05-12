@extends('admin.layout.master')
@section('content')
@if ($reservations_selected=='')
<br><br>
<h1> Put New DATE </h1><br><br>
<a class="btn btn-success btn-sm btn-lg " href="{{route('reservations.create')}}">Put New DATE</a>
@else
<div class="container my-5">
    <div id="payments">
        <h2> Update Reservation </h2><br><br>
        @include('admin.error.error')
    <form action="{{route('reservations.update',$patient_select->id)}}" method="post">
        @csrf
        @method('put')
        <label class="bold" for="Name">Name:</label>
        <input disabled type="text" name="name" id="name" value="{{$patient_select->name}}"><br><br>

        <label class="bold" for="Date">Date:</label>
        <input type="text" id="Date" name="date">
        <button class="button">Update Reservation</button>
    </form>
    </div>
    </div>
@endif
@stop
