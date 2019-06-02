@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div style="margin-bottom:20px;">
                <a class="btn btn-default" href="{{ \Session::get('returnURL') }}">
                    <i class="fa fa-chevron-left"></i> Inapoi
                </a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Creare comanda noua</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/order') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Comanda</label>

                            <div class="col-md-6{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="article" class="col-md-4 control-label">Articol</label>

                            <div class="col-md-6{{ $errors->has('article') ? ' has-error' : '' }}">
                                <input id="article" type="text" class="form-control" name="article" value="{{ old('article') }}">
                                @if ($errors->has('article'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('article') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Descriere</label>

                            <div class="col-md-6{{ $errors->has('description') ? ' has-error' : '' }}">
                                <textarea id="description" type="text" class="form-control" name="description">{{old('description')}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="quantity" class="col-md-4 control-label">Cantitate</label>

                            <div class="col-md-6{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                <input id="quantity" type="number" class="form-control" name="quantity" value="{{ old('quantity') }}">
                                @if ($errors->has('quantity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="client_id" class="col-md-4 control-label">Client</label>

                            <div class="col-md-6">
                                <select name="client_id" class="form-control">
                                    @foreach($clients as $client)
                                        <option value="{{ $client['id'] }}">{{ $client['name'] }}</option>
                                    @endforeach  
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="subcontractor_id" class="col-md-4 control-label">Subcontractor</label>

                            <div class="col-md-6">
                                <select name="subcontractor_id" class="form-control">
                                    <option value="">Fara subcontractor</option>
                                    @foreach($subcontractors as $subcontractor)
                                        <option value="{{ $subcontractor['id'] }}">{{ $subcontractor['name'] }}</option>
                                    @endforeach  
                                </select>
                            </div>
                        </div>
                      
                      <div class="form-group">
                            <label for="subcontractor_role" class="col-md-4 control-label">Rol subcontractor</label>

                            <div class="col-md-6{{ $errors->has('subcontractor_role') ? ' has-error' : '' }}">
                                <input id="subcontractor_role" type="text" class="form-control" name="subcontractor_role" value="{{ old('subcontractor_role') }}">
                                @if ($errors->has('subcontractor_role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subcontractor_role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      
                      <div class="form-group">
                            <label for="faza" class="col-md-4 control-label">Faza</label>

                            <div class="col-md-6{{ $errors->has('faza') ? ' has-error' : '' }}">
                                <input id="faza" type="text" class="form-control" name="faza" value="{{ old('faza') }}">
                                @if ($errors->has('faza'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('faza') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      
                      <div class="form-group">
                            <label for="batai" class="col-md-4 control-label">Batai</label>

                            <div class="col-md-6{{ $errors->has('batai') ? ' has-error' : '' }}">
                                <input id="batai" type="text" class="form-control" name="batai" value="{{ old('batai') }}">
                                @if ($errors->has('batai'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('batai') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      
                      <div class="form-group">
                            <label for="cutite" class="col-md-4 control-label">Cutite</label>

                            <div class="col-md-6{{ $errors->has('cutite') ? ' has-error' : '' }}">
                                <input id="cutite" type="text" class="form-control" name="cutite" value="{{ old('cutite') }}">
                                @if ($errors->has('cutite'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cutite') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <!--<div class="form-group">-->
                        <!--    <label for="parcels" class="col-md-4 control-label">Colete</label>-->

                        <!--    <div class="col-md-6">-->
                        <!--        <input id="parcels" type="number" class="form-control" name="parcels">-->
                        <!--    </div>-->
                        <!--</div>-->
                        
                        <!--<div class="form-group">-->
                        <!--    <label for="weight" class="col-md-4 control-label">Greutate</label>-->

                        <!--    <div class="col-md-6">-->
                        <!--        <input id="weight" type="number" class="form-control" name="weight">-->
                        <!--    </div>-->
                        <!--</div>-->
                        
                        <div class="form-group">
                            <label for="entry_date" class="col-md-4 control-label">Data intrare</label>

                            <div class="col-md-6{{ $errors->has('entry_date') ? ' has-error' : '' }}">
                                <input id="entry_date" type="text" class="form-control datepicker" name="entry_date" value="{{ old('entry_date') }}">
                                @if ($errors->has('entry_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('entry_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="due_date" class="col-md-4 control-label">Data scadenta</label>

                            <div class="col-md-6{{ $errors->has('due_date') ? ' has-error' : '' }}">
                                <input id="due_date" type="text" class="form-control datepicker" name="due_date" value="{{ old('due_date') }}">
                                @if ($errors->has('due_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('due_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" style="margin-top:20px;">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-th-list"></i> Creare
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
