<?php use \App\Http\Controllers\OrderController; ?>
@extends('layouts.app')

@section('content')
<div class="container">
    @if (Auth::guest())
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="jumbotron">
              <h2>Orders application</h1>
              <p>Simple online solution for handling orders, offering flows for creating/updating clients and orders, different access based on order ranking and quick invoice PDF generator. </p>
              <p>Please login in order to use the application</p>
              <p><a class="btn btn-primary btn-lg" href="{{ url('/login') }}" role="button">Login</a></p>
            </div>
        </div>
    </div>
    @else
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
    @endif
    
    <div class="perclient-actions" style="margin-bottom:20px;">
        <h2>Comenzi pentru: <b>{{$client}}</b></h2>
        <a class="btn btn-primary" href="{{ url('/order/create') }}">
            <i class="fa fa-btn fa-th-list"></i> Creare comanda noua
        </a>
        <a class="btn btn-primary" href="javascript:;" id="generate-invoice">
            <i class="fa fa-btn fa-file-text-o"></i> Generare factura
        </a>
    </div>
    <div class="perclient-search" class="row">
      <div class="col-lg-5 form-container" style="margin-bottom:10px;padding-left:0">
          <form class="form-horizontal" role="form" method="POST" action="{{ action('OrderController@searchPerClient', $id) }}">
            {{ csrf_field() }}
            <div class="row" style="margin-left:0">
              <input type="hidden" name="id" value="{{$id}}" />
              <input class="col-md-5" type="text" placeholder="Nume comanda sau articol" name='search' value='{{ isset($searchTerm) ? $searchTerm : '' }}' style='padding:5px;'>
              <input class="btn btn-default col-md-2" type="submit" value="Cautare!" style='margin-left:5px'>
              <a href="{{ Request::url() }}" style="margin-left:5px;position: relative;top:7px;">Resetare</a>
            </div>
            <div class="row" style="margin-left:0;margin-top:10px;">
              <select class="col-md-4" style="height:35px;padding-left:5px" name="state">
                <option value="empty"  {{ ( isset($selectedState) && $selectedState  == 'empty' ) ? 'selected' : '' }}>Selectare stare</option>
                <option value="0" {{ ( isset($selectedState) && $selectedState  == 0 && $selectedState != 'empty' ) ? 'selected' : '' }}>In curs de livrare</option>
                <option value="2" {{ ( isset($selectedState) && $selectedState  == 2 ) ? 'selected' : '' }}>Livrata</option>
                <option value="1" {{ ( isset($selectedState) && $selectedState  == 1 ) ? 'selected' : '' }}>Facturata</option>
                <option value="3" {{ ( isset($selectedState) && $selectedState  == 3 ) ? 'selected' : '' }}>Suspendata</option>
              </select>
            </div>
            <div class="row" style="margin-left:0">
              <span class="col-md-3" style="margin-top:12px;padding-left:0">Data livrare: </span>
              <input id="from_date" type="text" class="col-md-3 datepicker" name="from_date" style="margin-top:10px;padding-left:5px;position:relative;left:-16px;" value='{{ isset($from_date) ? OrderController::formatDate($from_date) : '' }}' placeholder="De la">
              <input id="to_date" type="text" class="col-md-3 datepicker" name="to_date" style="margin-top:10px;padding-left:5px" value='{{ isset($to_date) ? OrderController::formatDate($to_date) : '' }}' placeholder="Pana la">
            </div>
          </form>
      </div><!-- /.col-lg-6 -->
      <div lass="col-lg-4">
        <div class="order-data" style="font-size:16px">
          <span>
            <b>Total: </b>
            <span id="order-data-total">0</span>
          </span>
          <span style="margin-left:20px">
            <b>Livrate: </b>
            <span id="order-data-delivered">0</span>
          </span>
          <span style="margin-left:20px">
            <b>Facturate: </b>
            <span id="order-data-invoiced">0</span>
          </span>
        </div>
        <p style="margin-bottom:50px;">*din comenzile afisate</p>
      </div>
    </div><!-- /.row -->
    <table class="table table-striped perclient-table">
        <thead>
          <tr>
<!--             <th><input type="checkbox" id="check-all" /></th> -->
            <th>Comanda</th>
            <th>Articol</th>
            <th>Cantitate</th>
            <th>Livrate</th>
            <th>Facturate</th>
            <th>Data intrare</th>
            <th>Data livrare</th>
            <th>Data scadenta</th>
            <th style="text-align: center;">Stare</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
      
          @foreach($orders as $order)
          <tr class="order {{'order-' . $order->id}}">
<!--             <td><input type="checkbox" class="invoice-checkbox" id="{{'order-' . $order->id}}" /></td> -->
            <td>{{$order->name}}</td>
            <td>{{$order->article}}</td>
            <td class="total" data-ceva="{{'order-' . $order->id}}">{{$order->quantity}}</td>
            <td class="delivered">{{$order->delivered}}</td>
            <td class="invoiced">{{$order->invoiced_products}}</td>
            <td>{{date('d-m-Y', strtotime($order->entry_date))}}</td>
            @if($order->partial_date != '0000-00-00 00:00:00')
              <td>{{date('d-m-Y', strtotime($order->partial_date))}}</td>
            @else
              <td>-</td>
            @endif
            @if($order->due_date != '0000-00-00 00:00:00')
              <td>{{date('d-m-Y', strtotime($order->due_date))}}</td>
            @else
              <td>-</td>
            @endif
            <td style="text-align: center">
                @if($order->state==0) <p class="label label-default">In curs de livrare</p> 
                @elseif ($order->state==2) <p class="label label-success">Livrata</p> 
                @elseif ($order->state==1) <p class="label label-warning">Facturata</p> 
                @elseif ($order->state==3) <p class="label label-danger">Suspendata</p> 
                @endif
            </td>
            <td>
                <a href="{{action('OrderController@destroy', $order->id)}}" class="btn btn-danger" style="margin-left:10px;"><i class="fa fa-trash"></i></a>
              <a href="{{action('OrderController@show', [$order->id, 'searchTerm' => isset($searchTerm) ? $searchTerm: '', 'selectedState' => isset($selectedState) ? $selectedState : '', 'from_date' => isset($from_date) ? $from_date : '', 'to_date' => isset($to_date) ? $to_date : ''])}}" class="btn btn-primary" style="margin-left:10px;"><i class="fa fa-sign-in"></i></a>
              
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>
    @endif
</div>


<script>
  
  function ready(fn) {
    if (document.attachEvent ? document.readyState === "complete" : document.readyState !== "loading"){
      fn();
    } else {
      document.addEventListener('DOMContentLoaded', fn);
    }
  }
  
  ready(function(){
    var chClass = 'invoice-checkbox';
    var checkboxes = document.getElementsByClassName(chClass);
    var invoiceArray = [];
    var generateInvoice = document.getElementById("generate-invoice"); 
    var checkAll = document.getElementById("check-all");
    var orders = document.getElementsByClassName('order');
    
      
    function getPageTotal() {
      var sum = 0;
      for(var i = 0; i < document.querySelectorAll(".total").length; i++){
        sum = sum + Number(document.querySelectorAll(".total")[i].innerHTML);
      }
      
      return sum;
    }
    
    function getPageDelivered() {
      var sum = 0;
      for(var i = 0; i < document.querySelectorAll(".delivered").length; i++){
        sum = sum + Number(document.querySelectorAll(".delivered")[i].innerHTML);
      }
      
      return sum;
    }
    
    function getPageInvoiced() {
      var sum = 0;
      for(var i = 0; i < document.querySelectorAll(".invoiced").length; i++){
        sum = sum + Number(document.querySelectorAll(".invoiced")[i].innerHTML);
      }
      
      return sum;
    }
    
    //add order ids to an array that will be POSTed to generate invoices
    for (var i = 0; i < checkboxes.length; i++) {
      var element = checkboxes[i];
      element.addEventListener('change', function(){
        var total = Number(document.getElementsByClassName(this.id)[0].querySelector(".total").innerHTML); 
        var delivered = Number(document.getElementsByClassName(this.id)[0].querySelector(".delivered").innerHTML);
        var invoiced = Number(document.getElementsByClassName(this.id)[0].querySelector(".invoiced").innerHTML);
        if(this.checked) {
          invoiceArray.push(this.id.split("-")[1]);
          document.getElementById("order-data-total").innerHTML = Number(document.getElementById("order-data-total").innerHTML) + total;
          document.getElementById("order-data-delivered").innerHTML = Number(document.getElementById("order-data-delivered").innerHTML) + delivered;
          document.getElementById("order-data-invoiced").innerHTML = Number(document.getElementById("order-data-invoiced").innerHTML) + invoiced;
        }
        else {
          invoiceArray.splice(invoiceArray.indexOf(this.id.split("-")[1]), 1);
          document.getElementById("order-data-total").innerHTML = Number(document.getElementById("order-data-total").innerHTML) - total;
          document.getElementById("order-data-delivered").innerHTML = Number(document.getElementById("order-data-delivered").innerHTML) - delivered;
          document.getElementById("order-data-invoiced").innerHTML = Number(document.getElementById("order-data-invoiced").innerHTML) - invoiced;
        }
      });
    } 
    
    generateInvoice.addEventListener('click', function(){
      if(!invoiceArray.length){
        alert("Selectati minim o comanda");
      }
      else{
        var pdfUrl = window.location.origin + "/comenzi/public/downloadPDF/" + JSON.stringify(invoiceArray);
        location.href = pdfUrl; 
      }
    });
    
//     checkAll.addEventListener('change', function(){
//       var checked = this.checked;
//       for (var i = 0; i < checkboxes.length; i++) {
//         if(checked) {
//           checkboxes[i].checked = true;
//         }
//         else {
//           checkboxes[i].checked = false;
//         }
//         var event = document.createEvent("HTMLEvents");
//         event.initEvent('change', false, true);
//         checkboxes[i].dispatchEvent(event);
        
//         if(checked) {
//           document.getElementById("order-data-total").innerHTML = getPageTotal();
//           document.getElementById("order-data-delivered").innerHTML = getPageDelivered();
//           document.getElementById("order-data-invoiced").innerHTML = getPageInvoiced();
//         }
//       }  
//     });
    
    var total=0;
    var delivered=0;
    var invoiced=0;
    
    for (var i = 0; i < orders.length; i++) {
      total = total + Number(orders[i].querySelector(".total").innerHTML);
      delivered = delivered + Number(orders[i].querySelector(".delivered").innerHTML);
      invoiced = invoiced + Number(orders[i].querySelector(".invoiced").innerHTML);
    }
    
    document.getElementById("order-data-total").innerHTML = total;
    document.getElementById("order-data-delivered").innerHTML = delivered;
    document.getElementById("order-data-invoiced").innerHTML = invoiced;
    
    
  });
  
</script>
@endsection
