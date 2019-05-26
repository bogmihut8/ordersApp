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
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div><br />
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Vizualizare comanda</div>
                <div class="panel-body" id="order">
                    <form class="form-horizontal" role="form" method="POST" action="{{ action('OrderController@update', $id) }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 input-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <span class="input-group-addon" id="name-addon"><b>Comanda</b></span>
                                <input type="text" class="form-control" aria-describedby="name-addon" value="{{ $order['name'] }}" name="name" style="background-color:white">
                            </div>
                            @if ($errors->has('name'))
                                    <span class="col-md-8 col-md-offset-2 input-group help-block" style="color: #a94442">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 input-group{{ $errors->has('article') ? ' has-error' : '' }}">
                                <span class="input-group-addon" id="article-addon"><b>Articol</b></span>
                                <input type="text" class="form-control" aria-describedby="article-addon" value="{{ $order['article'] }}" name="article" style="background-color:white">
                            </div>
                            @if ($errors->has('article'))
                                    <span class="col-md-8 col-md-offset-2 input-group help-block" style="color: #a94442">
                                        <strong>{{ $errors->first('article') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 input-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <span class="input-group-addon" id="description-addon"><b>Descriere</b></span>
                                <textarea class="form-control" aria-describedby="description-addon" name="description" style="background-color:white">{{ $order['description'] }}</textarea>
                            </div>
                            @if ($errors->has('description'))
                                    <span class="col-md-8 col-md-offset-2 input-group help-block" style="color: #a94442">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 input-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                <span class="input-group-addon" id="quantity-addon"><b>Cant. totala</b></span>
                                <input type="text" class="form-control" aria-describedby="quantity-addon" value="{{ $order['quantity'] }}" name="quantity" style="background-color:white">
                            </div>
                            @if ($errors->has('quantity'))
                                    <span class="col-md-8 col-md-offset-2 input-group help-block" style="color: #a94442">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 input-group{{ $errors->has('delivered') ? ' has-error' : '' }}">
                                <span class="input-group-addon" id="delivered-addon"><b>Livrate</b></span>
                                <input type="text" class="form-control" aria-describedby="delivered-addon" value="{{ $order['delivered'] }}" name="delivered" style="background-color:white">
                                @if ($errors->has('delivered'))
                                    <span class="col-md-8 col-md-offset-2 input-group help-block" style="color: #a94442">
                                        <strong>{{ $errors->first('delivered') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 input-group{{ $errors->has('invoiced_products') ? ' has-error' : '' }}">
                                <span class="input-group-addon" id="invoiced_products-addon"><b>Facturate</b></span>
                                <input type="text" class="form-control" aria-describedby="invoiced_products-addon" value="{{ $order['invoiced_products'] }}" name="invoiced_products" style="background-color:white">
                            </div>
                            @if ($errors->has('invoiced_products'))
                                    <span class="col-md-8 col-md-offset-2 input-group help-block" style="color: #a94442">
                                        <strong>{{ $errors->first('invoiced_products') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 input-group{{ $errors->has('price_total') ? ' has-error' : '' }}">
                                <span class="input-group-addon" id="weight-addon"><b>Pret facturare</b></span>
                                <input type="text" class="form-control" aria-describedby="price_total-addon" value="{{ $order['price_total'] }}" name="price_total" style="background-color:white">
                            </div>
                            @if ($errors->has('price_total'))
                                    <span class="col-md-8 col-md-offset-2 input-group help-block" style="color: #a94442">
                                        <strong>{{ $errors->first('price_total') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 input-group">
                                <span class="input-group-addon" id="client-addon"><b>Client</b></span>
                                <select name="client_id" class="form-control" value="{{ $order->client['id'] }}" style="padding-left: 10px;">
                                    @foreach($clients as $client)
                                        <option value="{{ $client['id'] }}" {{ ( $order->client['id'] == $client['id'] ) ? 'selected' : '' }}>{{ $client['name'] }}</option>
                                    @endforeach  
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 input-group">
                                <span class="input-group-addon" id="subcontractor-addon"><b>Subcontractor</b></span>
                                <select name="subcontractor_id" class="form-control" value="{{ $order->subcontractor['id'] }}" style="padding-left: 10px;">
                                    <option value="" {{ ( $order->subcontractor['id'] == null ) ? 'selected' : '' }}>Fara subcontractor</option>
                                    @foreach($subcontractors as $subcontractor)
                                        <option value="{{ $subcontractor['id'] }}" {{ ( $order->subcontractor['id'] == $subcontractor['id'] ) ? 'selected' : '' }}>{{ $subcontractor['name'] }}</option>
                                    @endforeach  
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 input-group{{ $errors->has('entry_date') ? ' has-error' : '' }}">
                                <span class="input-group-addon" id="entry-date-addon"><b>Data intrare</b></span>
                                <input id="entry_date" type="text" class="form-control col-md-4 datepicker" name="entry_date" style="padding-left:10px" value="{{ date('d-m-Y', strtotime($order['entry_date'])) }}">
                            </div>
                            @if ($errors->has('entry_date'))
                                    <span class="col-md-8 col-md-offset-2 input-group help-block" style="color: #a94442">
                                        <strong>{{ $errors->first('entry_date') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 input-group{{ $errors->has('partial_date') ? ' has-error' : '' }}">
                                <span class="input-group-addon" id="partial-date-addon"><b>Data livrare</b></span>
                                <input id="partial_date" type="text" class="form-control col-md-4 datepicker" name="partial_date" style="padding-left:10px" value="{{ $order['partial_date'] != '0000-00-00 00:00:00' ? date('d-m-Y', strtotime($order['partial_date'])) : '-' }}">
                            </div>
                            @if ($errors->has('partial_date'))
                                    <span class="col-md-8 col-md-offset-2 input-group help-block" style="color: #a94442">
                                        <strong>{{ $errors->first('partial_date') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 input-group{{ $errors->has('due_date') ? ' has-error' : '' }}">
                                <span class="input-group-addon" id="due-date-addon"><b>Data scadenta</b></span>
                                <input id="due_date" type="text" class="form-control col-md-4 datepicker" name="due_date" style="padding-left:10px" value="{{ date('d-m-Y', strtotime($order['due_date'])) }}">
                            </div>
                            @if ($errors->has('due_date'))
                                    <span class="col-md-8 col-md-offset-2 input-group help-block" style="color: #a94442">
                                        <strong>{{ $errors->first('due_date') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 input-group{{ $errors->has('invoice_date') ? ' has-error' : '' }}">
                                <span class="input-group-addon" id="invoice_date-addon"><b>Data facturare</b></span>
                                <input id="invoice_date" type="text" class="form-control col-md-4 datepicker" name="invoice_date" style="padding-left:10px" value="{{ $order['invoice_date'] != '0000-00-00 00:00:00' ? date('d-m-Y', strtotime($order['invoice_date'])) : '-' }}">
                            </div>
                            @if ($errors->has('invoice_date'))
                                    <span class="col-md-8 col-md-offset-2 input-group help-block" style="color: #a94442">
                                        <strong>{{ $errors->first('invoice_date') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 input-group">
                                <span class="input-group-addon" id="state-addon"><b>Stare</b></span>
                                @php
                                    if ($order['state'] == 0) $state = 'In curs de livrare';
                                    else if ($order['state'] == 1) $state = 'Facturata';
                                    else if ($order['state'] == 2) $state = 'Livrata';
                                    else if ($order['state'] == 3) $state = 'Suspendata';
                                @endphp
                                <input type="hidden" value="{{ $order['state'] }}" name="state" />
                                <input type="text" class="form-control" style="cursor: default" aria-describedby="quantity-addon" readonly value="{{ $state }}" style="background-color:white">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 input-group">
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: inline">
                                    <i class="fa fa-btn fa-refresh"></i> Modificare stare <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{action('OrderController@updateState', array($order['id'], 0))}}">In curs de livrare</a></li>
                                    <li><a href="{{action('OrderController@updateState', array($order['id'], 2))}}">Livrata</a></li>
                                    <li><a href="{{action('OrderController@updateState', array($order['id'], 1))}}">Facturata</a></li>
                                    <li><a href="{{action('OrderController@updateState', array($order['id'], 3))}}">Suspendata</a></li>
                                </ul>
                                <a href="/duplicate/{{$order['id']}}" id="duplicate" class="btn btn-info" style="margin-left:15px;">Comanda noua cu aceste date</a>
                                <button type="submit" class="btn btn-primary" style="margin-left:15px;">Actualizare</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    <!--      <div class="modal fade" id="modal-order-data" role="dialog">-->
    <!--        <div class="modal-dialog">-->
            
              <!-- Modal content-->
    <!--          <form class="modal-content" role="form" method="POST" action="{{action('OrderController@updateOrderData', array($order['id']))}}">-->
    <!--            {{ csrf_field() }}-->
    <!--            <div class="modal-header">-->
    <!--              <button type="button" class="close" data-dismiss="modal">&times;</button>-->
    <!--              <h4 class="modal-title">Cantitate livrata</h4>-->
    <!--            </div>-->
    <!--            <div class="modal-body">-->
                  <!--<p>Au fost livrate &nbsp;&nbsp;&nbsp; <input type="number" name="delivered"  placeholder="2" min="0" style="width:50px; padding-left:10px;"/> &nbsp;&nbsp;&nbsp; din &nbsp;&nbsp;&nbsp; <input type="number" value="{{ $order['quantity'] - $order['delivered'] }}" style="width:50px; padding-left:10px;" readonly/> </p>-->
                  <!--<p>Au fost livrate &nbsp;&nbsp;&nbsp; <input type="number" name="parcels" placeholder="2" min="0" style="width:50px; padding-left:10px;"/> &nbsp;&nbsp;&nbsp; colete cu greutatea de &nbsp;&nbsp;&nbsp; <input type="number" name="weight" step="0.01" placeholder="12.3" style="width:67px; padding-left:10px;"/> &nbsp;&nbsp;&nbsp; kilograme. </p>-->
                  
    <!--              <div class="row form-group">-->
    <!--                  <label for="delivered" class="col-md-2 control-label" style="padding-top: 5px;">Livrate</label>-->

    <!--                  <div class="col-md-6">-->
    <!--                      <input id="delivered" type="text" class="form-control" name="delivered" value="{{ $order['delivered'] }}">-->
    <!--                  </div>-->
    <!--              </div>-->
                  
    <!--              <div class="row form-group">-->
    <!--                  <label for="invoiced" class="col-md-2 control-label" style="padding-top: 5px;">Facturate</label>-->

    <!--                  <div class="col-md-6">-->
    <!--                      <input id="invoiced" type="text" class="form-control" name="invoiced_products" value="{{ $order['invoiced_products'] }}">-->
    <!--                  </div>-->
    <!--              </div>-->
                  
    <!--              <div class="row form-group">-->
    <!--                  <label for="parcels" class="col-md-2 control-label" style="padding-top: 5px;">Colete</label>-->

    <!--                  <div class="col-md-6">-->
    <!--                      <input id="parcels" type="text" class="form-control" name="parcels" value="{{ $order['parcels'] }}">-->
    <!--                  </div>-->
    <!--              </div>-->
                  
    <!--              <div class="row form-group">-->
    <!--                  <label for="delivered" class="col-md-2 control-label" style="padding-top: 5px;">Greutate</label>-->

    <!--                  <div class="col-md-6">-->
    <!--                      <input id="weight" type="text" class="form-control" name="weight" value="{{ $order['weight'] }}">-->
    <!--                  </div>-->
    <!--              </div>-->
    <!--              <div style="clear:both;"></div>-->
    <!--            </div>-->
    <!--            <div class="modal-footer">-->
    <!--                <button type="submit" href="" class="btn btn-primary">Modificare</a>-->
    <!--            </div>-->
    <!--          </form>-->
              
    <!--        </div>-->
    <!--      </div>-->
          
    <!--      <div class="modal fade" id="modal-delivered" role="dialog">-->
    <!--        <div class="modal-dialog">-->
            
              <!-- Modal content-->
    <!--          <form class="modal-content" role="form" method="POST" action="{{action('OrderController@updateState', array($order['id'], 2))}}">-->
    <!--            {{ csrf_field() }}-->
    <!--            <div class="modal-header">-->
    <!--              <button type="button" class="close" data-dismiss="modal">&times;</button>-->
    <!--              <h4 class="modal-title">Cantitate livrata</h4>-->
    <!--            </div>-->
    <!--            <div class="modal-body">-->
    <!--              <p>Au fost livrate &nbsp;&nbsp;&nbsp; <input type="number" name="parcels" placeholder="2" min="0" style="width:50px; padding-left:10px;"/> &nbsp;&nbsp;&nbsp; colete cu greutatea de &nbsp;&nbsp;&nbsp; <input type="number" name="weight" step="0.01" placeholder="12.3" style="width:67px; padding-left:10px;"/> &nbsp;&nbsp;&nbsp; kilograme. </p>-->
    <!--            </div>-->
    <!--            <div class="modal-footer">-->
    <!--                <button type="submit" href="" class="btn btn-primary">Modificare</a>-->
    <!--            </div>-->
    <!--          </form>-->
              
    <!--        </div>-->
    <!--      </div>-->
    <!--</div>-->
</div>

 <script>
//     function ready(fn) {
//         if (document.attachEvent ? document.readyState === "complete" : document.readyState !== "loading"){
//           fn();
//         } else {
//           document.addEventListener('DOMContentLoaded', fn);
//         }
//     }
  
//       ready(function(){
//           var duplicateButton = document.getElementById("duplicate"); 
          
//           duplicateButton.addEventListener('click', function(e){
//               e.preventDefault();
//               var duplicateUrl = window.location.origin + "/facturi/public/duplicate/{{$order['id']}}";
//               location.href = duplicateUrl; 
//           });
//       });
 </script>
@endsection
