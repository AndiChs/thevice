@extends('layouts.app')

@section('content')
    <div class="row">
    @foreach($vehicles as $vehicle)
        <div class="col-md-2" style=" width:16%; color:white;">
            <img src="https://panel.thevice.ro/assets/images/vehicles/Vehicle_{{$vehicle->Model}}.jpg" style="width:100%;">
            <div style="background-color: #222222;width:auto; padding-left: 10px;">
                <br>
                <p><i class="entypo-right"></i>Vehicle Name: {{ucfirst($vehicleName[$vehicle->Model])}}</p>
                <p><i class="entypo-chart-pie"></i>Stock: {{$vehicle->Stock}}</p>
                <p><i class="entypo-tag"></i>Price: {{ number_format($vehicle->Price)}} {{$vehicle->Type == 5 ? 'PP' : '$'}}  </p>
                <p><i class="entypo-gauge"></i>Top Speed: {{$vehicle->MaxSpeed}} km/h</p>
                <br>
            </div>
        </div>
    @endforeach
    </div>
@endsection