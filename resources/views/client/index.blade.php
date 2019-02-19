@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if (\Session::has('success'))
              <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
              </div><br />
            @endif
            <div style="margin-bottom:20px;">
                <h2>Clienti</h2>
                <a class="btn btn-primary" href="{{ url('/client/create') }}">
                    <i class="fa fa-btn fa-users"></i> Creare client nou
                </a>
            </div>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Client</th>
                    <th>Cod Fiscal</th>
                    <th>Adresa</th>
                    <th>Telefon</th>
                    <th colspan="2">Actiuni</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @foreach($clients as $client)
                  <tr>
                    <td>{{$client['name']}}</td>
                    <td>{{$client['cod_fiscal']}}</td>
                    <td style="max-width:200px;">{{$client['adresa']}}</td>
                    <td>{{$client['telefon']}}</td>
                    
                    <td>
                        <a href="{{action('ClientController@edit', $client['id'])}}" class="btn btn-warning">Modificare</a>
                        <form action="{{action('ClientController@destroy', $client['id'])}}" method="post" style="display:inline;margin-left:10px;">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger" type="submit">Stergere</button>
                      </form>
                      <a href="{{action('OrderController@clientOrders', $client['id'])}}" class="btn btn-primary" style="margin-left:10px;">Bolle</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
