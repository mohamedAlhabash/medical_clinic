@extends('admin.layout.master')
@section('content')
<div id="patients">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="title">Patients</h2><hr><br><br>
    <div class="search-container">
        <form>
          <label class="bold" for="name">Name:</label>
          <input id="name" type="text" placeholder="Name.." name="name">
          <label class="bold" for="phone">Phone:</label>
          <input id="phone" type="text" placeholder="Phone.." name="phone">
          <label class="bold" for="state">State:</label>
          <input id="state" type="text" placeholder="State.." name="state">
          <button style="width: 40px; height: 30px;" type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div class="sort_container">
        <form>
            <label class="bold" for="sort">Sort By:</label>
            <select id="sort" name="sort">
              <option value="volvo">Name</option>
              <option value="saab">Phone</option>
            </select>
          </form>
    </div>
    <table>
        <tr>
            <th>Name</th>
            <th>Identify Num</th>
            <th>Phone Num</th>
            <th>Treatment State</th>
            <th>Next Reservation</th>
            <th>Total payments</th>
            <th>Change</th>
            <th>Change R</th>
        </tr>
        @foreach ($patients as $patient)
        <tr>
            <td>{{$patient->name}}</td>
            <td>{{$patient->identity_number}}</td>
            <td>{{$patient->phone}}</td>
            <td>{{$patient->treatment_state == '0' ? 'Not complete' : 'complete'}}</td>
            <td>{{$patient->reservations->max('date') == '' ? "No Reservation Found" : $patient->reservations->max('date')->format('Y-m-d H:i')}}</td>
            <td>{{$patient->payments->sum('amount')}}</td>
            <td><a href="{{route('patients.edit', $patient->id)}}"><i class="pointer fa fa-edit fa fa-2x"></i></a></td>
            <td><a href="{{route('reservations.edit', $patient->id)}}"><i class="pointer fa fa-edit fa fa-2x"></i></a></td>
        </tr>
            @endforeach
    </table>
    <br><br><br><br><hr>
</div>
@stop
