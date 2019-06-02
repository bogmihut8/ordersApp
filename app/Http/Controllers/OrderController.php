<?php

namespace App\Http\Controllers;

use Validator;
use Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use PDF;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // HomeController@index
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients=\App\Client::all();
        $subcontractors=\App\Subcontractor::all();
        if(str_contains(url()->previous(), 'facturi') || (str_contains(url()->previous(), 'client') && str_contains(url()->previous(), 'orders'))){
            Session::put('returnURL', url()->previous());
        }
        return view('order.create', compact('clients', 'subcontractors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => '^ Aceasta informatie este obligatorie. ^',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'article' => 'required',
            'quantity' => 'required',
            'client_id' => 'required',
            'entry_date' => 'required',
            'due_date' => 'required'
        ], $messages);
        
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $order = new \App\Order;
        $order->name = $request->get('name');
        $order->article = $request->get('article');
        $order->description = $request->get('description');
        $order->quantity = $request->get('quantity');
        $order->client_id = $request->get('client_id');
        $order->subcontractor_id = ( $request->get('subcontractor_id') == "" ? null : $request->get('subcontractor_id'));
      
        $order->subcontractor_role = $request->get('subcontractor_role');
        $order->faza = $request->get('faza');
        $order->batai = $request->get('batai');
        $order->cutite = $request->get('cutite');
      
        $order->entry_date = $this->formatDate($request->get('entry_date'));
        $order->due_date = $this->formatDate($request->get('due_date'));
        $order->parcels = 0;
        $order->weight = 0;
        $order->price_article = 0;
        $order->price_total = 0;
        $order->save();

        if(str_contains(Session::get('returnURL'), 'facturi')){
            return redirect('facturi')->with('success', 'Comanda a fost creata');
        }
        else if(str_contains(Session::get('returnURL'), 'client') && str_contains(Session::get('returnURL'), 'orders')) {
            return redirect("/client/{$order->client_id}/orders")->with('success', 'Comanda a fost creata');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = \App\Order::find($id);
        $clients=\App\Client::all();
        $subcontractors=\App\Subcontractor::all();
        if(str_contains(url()->previous(), 'facturi') || (str_contains(url()->previous(), 'client') && str_contains(url()->previous(), 'orders'))){
            Session::put('returnURL', url()->previous());
        }
        return view('order.show', compact('order', 'id', 'clients', 'subcontractors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $messages = [
            'required' => '^ Aceasta informatie este obligatorie. ^',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'article' => 'required',
            'quantity' => 'required',
            'client_id' => 'required',
            'entry_date' => 'required',
            'due_date' => 'required'
        ], $messages);
        
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $order = \App\Order::find($id);
        $order->name = $request->get('name');
        $order->article = $request->get('article');
        $order->description = $request->get('description');
        $order->quantity = $request->get('quantity');
        $order->delivered = $request->get('delivered');
        $order->invoiced_products = $request->get('invoiced_products');
        $order->parcels = $request->get('parcels');
        $order->weight = $request->get('weight');
        $order->state = $request->get('state');
        $order->price_total = $request->get('price_total');
        $order->client_id = $request->get('client_id');
        $order->subcontractor_id = ( $request->get('subcontractor_id') == "" ? null : $request->get('subcontractor_id'));
      
        $order->subcontractor_role = $request->get('subcontractor_role');
        $order->faza = $request->get('faza');
        $order->batai = $request->get('batai');
        $order->cutite = $request->get('cutite');
      
        $order->entry_date = $this->formatDate($request->get('entry_date'));
        $order->partial_date = $this->formatDate($request->get('partial_date'));
        $order->due_date = $this->formatDate($request->get('due_date'));
        $order->invoice_date = $this->formatDate($request->get('invoice_date'));
        $order->save();
        
        return back()->with('success', 'Comanda a fost actualizata');
    }
    
    public function storeAfterDuplicate(Request $request)
    {
        $messages = [
            'required' => '^ Aceasta informatie este obligatorie. ^',
        ];
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'article' => 'required',
            'quantity' => 'required',
            'client_id' => 'required',
            'entry_date' => 'required',
            'due_date' => 'required'
        ], $messages);
        
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $order = new \App\Order;
        $order->name = $request->get('name');
        $order->article = $request->get('article');
        $order->description = $request->get('description');
        $order->quantity = $request->get('quantity');
        $order->delivered = $request->get('delivered');
        $order->invoiced_products = $request->get('invoiced_products');
        $order->parcels = $request->get('parcels');
        $order->weight = $request->get('weight');
        $order->state = $request->get('state');
        $order->price_total = $request->get('price_total');
        $order->client_id = $request->get('client_id');
        $order->subcontractor_id = ( $request->get('subcontractor_id') == "" ? null : $request->get('subcontractor_id'));
      
        $order->subcontractor_role = $request->get('subcontractor_role');
        $order->faza = $request->get('faza');
        $order->batai = $request->get('batai');
        $order->cutite = $request->get('cutite');
      
        $order->entry_date = $this->formatDate($request->get('entry_date'));
        $order->partial_date = $this->formatDate($request->get('partial_date'));
        $order->due_date = $this->formatDate($request->get('due_date'));
        $order->invoice_date = $this->formatDate($request->get('invoice_date'));
        $order->save();
        
        return redirect("/client/{$order->client_id}/orders")->with('success', 'Comanda a fost creata');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = \App\Order::find($id);
        $order->delete();
        return back()->with('success', 'Comanda a fost stearsa');
    }
    
    public function duplicate($id)
    {
        $order = \App\Order::find($id);
        $clients=\App\Client::all();
        $subcontractors=\App\Subcontractor::all();
        if(str_contains(url()->previous(), 'order/')){
            Session::put('returnDuplicateURL', url()->previous());
        }
        return view('order.duplicate', compact('order', 'id', 'clients', 'subcontractors'));
    }
    
    /**
     * Get the client that owns the order.
     */
    public function getClient($id)
    {
        $client = \App\Client::find($id);
        return $client->name;
    }
    
    public function downloadPDF($id){
      $orders = \App\Order::find(json_decode($id));
      $pdf = PDF::loadView('pdf.invoice', compact('orders'));
      return $pdf->download('factura-' . date('Y-m-d H:i:s') . '.pdf');
    }
    
    public function downloadPartialPDF(Request $request, $id){
      $order = \App\Order::find($id);
      $order->invoiced_products = $order->invoiced_products + $request->get('invoiced');
      $order->save();
      $pdf = PDF::loadView('pdf.invoice', compact('order'));
      return $pdf->download('factura-partiala-' . $id . '.pdf');
    }
    
    public function updateState(Request $request, $id, $newState)
    {
        
        $order = \App\Order::find($id);
        $order->state = $newState;
        if($newState == 1) {
            $order->delivered = $order->delivered + $request->get('delivered');
        }
        $order->parcels = $order->parcels + $request->get('parcels');
        $order->weight = $order->weight + $request->get('weight');
        $order->save();
        return back()->with('success', 'Comanda a fost actualizata');
    }
    
    public function search(Request $request)
    {
        $clients=\App\Client::all();
        $searchTerm = $request->input('search');
        $from_date = $this->formatDate($request->input('from_date'));
        $to_date = $this->formatDate($request->input('to_date'));
        $selectedClient = $request->input('client');
        $selectedState = $request->input('state');
        
        $orders = \App\Order::where(function($query) use ($searchTerm, $selectedClient, $selectedState, $from_date, $to_date) {
                                    if (!is_null($from_date) && $from_date != '') {
                                        $query->whereDate('partial_date', '>=', $from_date);
                                    }
                                    if (!is_null($to_date) && $to_date != '') {
                                        $query->whereDate('partial_date', '<=', $to_date);
                                    }
                                    if (!is_null($from_date) && !is_null($to_date) && $from_date != '' && $to_date != '') {
                                        $query->whereBetween('partial_date', [$from_date, $to_date]);
                                    }
                                    if (!is_null($selectedClient) && $selectedClient != '') {
                                        $query->where('client_id', $selectedClient);
                                    }
                                    if (!is_null($selectedState) && $selectedState != '') {
                                        $query->where('state', $selectedState);
                                    }
                                    if (!is_null($searchTerm) && $searchTerm != '') {
                                        $query->where(function($query) use ($searchTerm) {
                                            $query->where( 'name', 'LIKE', '%' . $searchTerm . '%' );
                                            $query->orWhere('article', 'LIKE', '%' . $searchTerm . '%' ); 
                                        });
                                    }
                            })//->toSql();
                            ->get();
                            //dd($orders);

        return view('facturi', compact('orders', 'searchTerm', 'from_date', 'to_date', 'clients', 'selectedClient', 'selectedState'));

    }
    
    public function searchPerClient(Request $request)
    {
        $searchTerm = $request->input('search');
        $from_date = $this->formatDate($request->input('from_date'));
        $to_date = $this->formatDate($request->input('to_date'));
        
        $id = $request->input('id');
        
        $clientDb = \App\Client::find($id);
        $client = $clientDb->name;
        $selectedClient = $id;
        
        $selectedState = $request->input('state');
        
        $orders = \App\Order::where(function($query) use ($searchTerm, $selectedClient, $selectedState, $from_date, $to_date) {
                                    if (!is_null($from_date) && $from_date != '') {
                                        $query->whereDate('partial_date', '>=', $from_date);
                                    }
                                    if (!is_null($to_date) && $to_date != '') {
                                        $query->whereDate('partial_date', '<=', $to_date);
                                    }
                                    if (!is_null($from_date) && !is_null($to_date) && $from_date != '' && $to_date != '') {
                                        $query->whereBetween('partial_date', [$from_date, $to_date]);
                                    }
                                    if (!is_null($selectedClient) && $selectedClient != '') {
                                        $query->where('client_id', $selectedClient);
                                    }
                                    if (!is_null($selectedState) && $selectedState != 'empty') {
                                        $query->where('state', $selectedState);
                                    }
                                    if (!is_null($searchTerm) && $searchTerm != '') {
                                        $query->where(function($query) use ($searchTerm) {
                                            $query->where( 'name', 'LIKE', '%' . $searchTerm . '%' );
                                            $query->orWhere('article', 'LIKE', '%' . $searchTerm . '%' ); 
                                        });
                                    }
                            })//->toSql();
                            ->get();
                            //dd($orders);

        return view('order.perclient', compact('orders', 'client', 'searchTerm', 'from_date', 'to_date', "id", "selectedState"));

    }
    
    public function updateOrderData(Request $request, $id)
    {
        
        $order = \App\Order::find($id);
        $order->delivered = $order->delivered + $request->get('delivered');
        $order->invoiced_products = $order->invoiced_products + $request->get('invoiced_products');
        $order->parcels = $order->parcels + $request->get('parcels');
        $order->weight = $order->weight + $request->get('weight');
        $order->save();
        return view('order.show', compact('order', 'id'))->with('success', 'Factura a fost actualizata');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clientOrders($id)
    {
        $orders = DB::table('orders')
                ->where('client_id', $id)
                ->get();
        
        $clientDb = \App\Client::find($id);
        $client = $clientDb->name;
        return view('order.perclient', compact('orders', 'client', 'id'));
    }
    
    static public function formatDate($date){
        $dateArr = explode("-", $date);
        if($date == "" || $date == "-") {
            return $date;
        }
        else {
            return $dateArr[2] . "-" . $dateArr[1] . "-" . $dateArr[0];   
        }
    }

}
