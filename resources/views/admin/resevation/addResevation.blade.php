@extends('admin.layout.master')
@section('content')
<div class="container my-5">
<div id="payments">
    <h2> Add New Reservation </h2><br><br>
    @include('admin.error.error')
<form action="{{route('reservations.store')}}" method="post">
    @csrf
    <select name="patient_id" class="form-control mb-3">
        <option value="" disabled selected>Select Name</option>
        @foreach($patients as $patient)
            <option value="{{$patient->id}}">{{$patient->name}}</option>
        @endforeach
    </select>
    <label class="bold" for="Date">Date:</label>
    <input type="datetime-local" id="Date" name="date">
    <button class="button">Add Reservation</button>
</form>
</div>
</div>
@stop
