@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-dark panel-shadow">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><i class="glyphicon glyphicon-edit"></i> Create Ticket</div>
                </div>
                <!-- panel body -->

                <div class="panel-body">


                    <div class="panel panel-dark panel-shadow">

                        <!-- panel body -->

                        <div class="panel-body">
                            {!! Form::open(['method'=>'POST', 'action'=>'TicketController@store']) !!}

                            <div class="form-group">
                                {!! Form::select('type', $ticketTypes, null, ['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('body,', 'Description:') !!}
                                {!! Form::textarea('body', null, ['class'=>'form-control', 'required'=>'true', 'maxlength'=>'499']) !!}
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Create Ticket', ['class'=>'btn btn-primary pull-right']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-dark panel-shadow">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo-info"></i>Ticket Information</div>
                </div>
                <!-- panel body -->

                <div class="panel-body">


                    <div class="panel panel-dark panel-shadow">

                        <!-- panel body -->

                        <div class="panel-body">
                            <strong>Informatii deschidere ticket ajutor</strong><br>
                            <br>
                            Inainte de a deschide un tichet, citeste raspunsurile intrebarilor puse frecvent (FAQ). De obicei un ticket primeste un raspuns in maxim 48 de ore. Incercati sa spuneti clar ce problema aveti in tichet si sa dati detalii despre problema avuta.<br>
                            <br>
                            <strong>General ticket</strong><br>
                            <br>
                            Puteti deschide un ticket general pentru problemele legate de inselatorii, contul de forum sau de alte probleme generale.<br>
                            <br>
                            <strong>Problems with the account</strong><br>
                            <br>
                            Daca parola contului tau nu mai merge sau ati uitat parola, puteti sa folositi functia de recuperare parola. Daca nu ai un email setat pe cont, nu iti poti recupera parola si contul. Daca ai un email setat pe cont pe care nu-l poti accesa, nu iti poti recupera contul.  Nu se pot deschide tichete pentru conturi pierdute/sparte deoarece adminii nu se ocupa de recuperarea conturilor pierdute de playeri.<br>
                            <br>
                            <strong>Problems with a payments</strong><br>
                            <br>
                            Daca ai o problema legata de cumpararea punctelor premium, deschide un tichet aici. Daca ai facut o plata si nu ai primit punctele premium la 48 de ora dupa, verifica daca ti-au fost retrasi banii de pe paysafecard folosind link-ul de mai sus. Daca nu ti-au fost retrasi, mai asteapta.<br>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection