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
                <h2>Utilizator</h2>
                <a class="btn btn-primary" href="{{ url('/user/create') }}">
                    <i class="fa fa-btn fa-user"></i> Creare utilizator nou
                </a>
            </div>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nume</th>
                    <th>Email</th>
                    <th colspan="2">Actiuni</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @foreach($users as $user)
                  <tr>
                    <td>{{$user['id']}}</td>
                    <td>{{$user['name']}}</td>
                    <td>{{$user['email']}}</td>
                    
                    <td>
                        <a href="{{action('UserController@edit', $user['id'])}}" class="btn btn-warning">Modificare</a>
                        <form action="{{action('UserController@destroy', $user['id'])}}" method="post" style="display:inline;margin-left:10px;">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger" type="submit">Stergere</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
