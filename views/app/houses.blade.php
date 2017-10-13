@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo-home"></i>Houses</div>

                </div>
                <div class="panel-body with-table">
                    <table class="table table-bordered table-hover responsive">

                        <thead>
                        <td>#</td>
                        <td>Owner</td>
                        <td>Rent</td>
                        <td>Level</td>
                        </thead>

                        <tbody>
                        @foreach($houses as $house)
                            <tr>
                                <td>{{$house->id}}</td>
                                <td>{!! $house->Owner === 'The State' ? 'The State' : $house->owner->linkToProfile() !!}</td>
                                <td>{{$house->Rent != 0 ? '$'.number_format($house->Rent) : 'Not for rental'}}</td>
                                <td>{{$house->Level}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$houses->render()}}
        </div>
    </div>
@endsection