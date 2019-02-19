@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div style="margin-bottom:20px;">
                <a class="btn btn-default" href="{{ url('/') }}">
                    <i class="fa fa-chevron-left"></i> Inapoi
                </a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Modificare client</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ action('ClientController@update', $id) }}">
                        {{ csrf_field() }}
                        
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nume</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $client->name }}">
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('adresa') ? ' has-error' : '' }}">
                            <label for="adresa" class="col-md-4 control-label">Adresa</label>

                            <div class="col-md-6">
                                <input id="adresa" type="text" class="form-control" name="adresa" value="{{ $client->adresa }}">
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('telefon') ? ' has-error' : '' }}">
                            <label for="telefon" class="col-md-4 control-label">Telefon</label>

                            <div class="col-md-6">
                                <input id="telefon" type="text" class="form-control" name="telefon" value="{{ $client->telefon }}">
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('cod_fiscal') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Cod Fiscal</label>

                            <div class="col-md-6">
                                <input id="cod_fiscal" type="text" class="form-control" name="cod_fiscal" value="{{ $client->cod_fiscal }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Modificare client
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
