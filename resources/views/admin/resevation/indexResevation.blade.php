@extends('admin.layout.master')
@section('content')
<div id="payments">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="title">Resevrations</h2>
    <br>
    <br><br>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Resevration date</th>
        </tr>
        @foreach ($resevrations as $resevration)
            <tr>
                <td>{{$resevration->patient->name}}</td>
                <td>{{$resevration->date->format('Y-m-d H:i')}}</td>
            </tr>
        @endforeach
    </table>
</div>
@stop
