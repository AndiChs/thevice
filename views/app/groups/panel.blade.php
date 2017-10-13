@extends('layouts.app')

@section('content')
    <h2>{{$group->group_Name}}'s Panel</h2>

    <div class="row">
        <div class="col-sm-6">
            <h4>Questions</h4>
            {!! Form::open(['method'=>'PATCH', 'action'=>['GroupsController@updateQuestions', $group->group_ID]]) !!}

                @for($x = 0; $x < 10; $x++)
                    <div class="form-group">
                        {!! Form::text('question_'.$x, isset($question[$x]) ? $question[$x] : '', ['class'=>'form-control', 'maxlength'=>'200', 'placeholder'=>'Pentru a sterge o intrebare, sterge tot continutul din casuta.']) !!}
                    </div>
                @endfor
                <div class="form-group">
                    {!! Form::submit('Update Questions', ['class'=>'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>

        <div class="col-sm-6">
            <h4>Application Status: {!! $group->group_Applications == 1 ? '<span style="color:#01ba1a">Opened</span>' : '<span style="color:#ad0401">Closed</span>' !!}</h4>

            {!! Form::open(['method'=>'PATCH', 'action'=>['GroupsController@updateApplications', $group->group_id]]) !!}
                {!! Form::hidden('group_Applications', $group->group_Applications == 1 ? 0 : 1) !!}
                <div class="form-group">
                    {!! Form::submit($group->group_Applications == 1 ? 'Close Applications' : 'Open Applications', ['class'=>$group->group_Applications == 1 ? 'btn btn-danger' : 'btn btn-success'] ) !!}
                </div>

             {!! Form::close() !!}

            <h4>Reset Faction Activity</h4>
        </div>
    </div>
@endsection