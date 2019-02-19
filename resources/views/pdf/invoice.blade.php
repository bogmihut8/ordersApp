<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Factura</title>
    <style>
      .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 18cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}

#firma {
  font-size:17px;
}

#firma .font-s {
  font-size:14px;
}

#firma .left {
  float: left;
  width:50%;
}

#firma .right {
  float: right;
  width:50%;
}

#client {
  float: right;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
    </style>
  </head>
  <body>
    <header class="clearfix">
      <h1>Factura</h1>
      <div id="firma">
        <div class="left">
          <div style="font-weight: bold">SC RADIASIMA PROD. SRL</div>
          <div class="font-s"><span style="font-weight: bold">ADRESA:</span> Str. Garii, Nr. 48; 420058 Bistrita, Romania</div>
          <div class="font-s"><span style="font-weight: bold">TELEFON:</span> 0040 263 230243</div>
          <div class="font-s"><span style="font-weight: bold">C.F. :</span> R9967804</div>
          <div class="font-s"><span style="font-weight: bold">BANCA:</span> ING BANK Bistrita</div>
          <div class="font-s"><span style="font-weight: bold">COD SWIFT:</span> RO32 INGB 0000 9999 0642 6779</div>
        </div>
        <div class="right">
          <div style="font-weight: bold">{{$orders[0]->client['name']}}</div>
          <div class="font-s"><span style="font-weight: bold">ADRESA:</span> {{$orders[0]->client['adresa']}}</div>
          <div class="font-s"><span style="font-weight: bold">TELEFON:</span> {{$orders[0]->client['telefon']}}</div>
          <div class="font-s"><span style="font-weight: bold">C.F. :</span> {{$orders[0]->client['cod_fiscal']}}</div>
        </div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="desc">ARTICOL</th>
            <th class="desc">NR. ART.</th>
            <th class="desc">COLETE</th>
            <th class="desc">KG</th>
          </tr>
        </thead>
        <tbody>
          <?php $quantity_total = 0;
                $parcels_total = 0; 
                $weight_total = 0; ?>
          @foreach($orders as $order)
          <tr>
            <td class="desc">{{$order['article']}}</td>
            <td class="desc">{{$order['quantity']}}</td>
            <td class="desc">{{$order['parcels']}}</td>
            <td class="desc">{{$order['weight']}} KG</td>
          </tr>
          <?php 
            $quantity_total = $quantity_total + $order['quantity'];
            $parcels_total = $parcels_total + $order['parcels'];
            $weight_total = $weight_total + $order['weight'];
          ?>
          @endforeach
          <tr>
            <td style="border-top: 1px solid #ccc!important;" class="desc"><b>Total:</b></td>
            <td style="border-top: 1px solid #ccc!important;" class="desc"><b>{{$quantity_total}}</b></td>
            <td style="border-top: 1px solid #ccc!important;" class="desc"><b>{{$parcels_total}}</b></td>
            <td style="border-top: 1px solid #ccc!important;" class="desc"><b>{{$weight_total}} KG</b></td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
      </div>
    </main>
    <footer>
      Aceasta factura a fost creata digital si este valida fara semnatura.
    </footer>
  </body>
</html>