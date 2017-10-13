@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo-briefcase"></i>Businesses</div>

                </div>
                <div class="panel-body with-table">
                    <table class="table table-bordered table-hover responsive">

                        <thead>
                            <td>#</td>
                            <td>Owner</td>
                            <td>Name</td>
                            <td>Level</td>
                            <td>Business Fee</td>
                            <td>Price</td>
                        </thead>

                        <tbody>
                        @foreach($businesses as $business)
                            <tr>
                                <td>{{$business->ID}}</td>
                                <td>{!! $business->Owner === 'The State' ? 'The State' : $business->owner->linkToProfile() !!} </td>
                                <td>{{$business->Description}}</td>
                                <td>{{$business->Level}}</td>
                                <td>{{'$'.number_format($business->Fee)}}</td>
                                <td>{{$business->Price == 0 ? 'Not For Sale' : '$'.number_format($business->Price)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

@endsection