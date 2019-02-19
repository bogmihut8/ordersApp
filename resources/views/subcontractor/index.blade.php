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
                <h2>Subcontractori</h2>
                <a class="btn btn-primary" href="{{ url('/subcontractor/create') }}">
                    Creare subcontractor nou
                </a>
            </div>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Subcontractor</th>
                    <th>Adresa</th>
                    <th>Telefon</th>
                    <th colspan="2">Actiuni</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @foreach($subcontractors as $subcontractor)
                  <tr>
                    <td>{{$subcontractor['name']}}</td>
                    <td style="max-width:200px;">{{$subcontractor['adresa']}}</td>
                    <td>{{$subcontractor['telefon']}}</td>
                    
                    <td>
                        <a href="{{action('SubcontractorController@edit', $subcontractor['id'])}}" class="btn btn-warning">Modificare</a>
                        <form action="{{action('SubcontractorController@destroy', $subcontractor['id'])}}" method="post" style="display:inline;margin-left:10px;">
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
