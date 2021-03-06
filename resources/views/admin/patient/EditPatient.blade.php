@extends('admin.layout.master')
@section('content')
<div class="container my-5">
    <div id="patients">
        <h2> Update Patient </h2>
        @include('admin.error.error')
        <form action="{{route('patients.update', $patient->id)}}" method="post">
            @csrf
            @method('put')
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{$patient->name}}"><br>

            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" value="{{$patient->phone}}"><br>

            <label for="identity_number">Identity number:</label>
            <input type="text" id="identity_number" name="identity_number" value="{{$patient->identity_number}}"><br>

            <label for="treatment_state">Treatment state:</label>
            <select name="treatment_state" class="form-control mb-3">
                <option value = "0" {{$patient->treatment_state == '0' ? 'selected' : ''}}>Not complete</option>
                <option value = "1" {{$patient->treatment_state == '1' ? 'selected' : ''}}>complete</option>
            </select>

            <button class="button">Update</button>
        </form>
    </div>
</div>
@endsection
