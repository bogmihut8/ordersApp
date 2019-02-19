<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Http\Requests;

class ClientController extends Controller
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
        $clients=\App\Client::all();
        return view('client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
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
            'required' => 'Aceasta informatie este obligatorie.',
        ];
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'adresa' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return redirect('client/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $client = new \App\Client;
        $client->name = $request->get('name');
        $client->adresa=$request->get('adresa');
        $client->cod_fiscal=$request->get('cod_fiscal');
        $client->telefon=$request->get('telefon');
        $client->save();
        
        return redirect('client')->with('success', 'Clientul a fost creat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = \App\Client::find($id);
        return view('client.edit', compact('client','id'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'adresa' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                         ->route('client.edit',['id'=>$id])
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $client= \App\Client::find($id);
        $client->name=$request->get('name');
        $client->adresa=$request->get('adresa');
        $client->cod_fiscal=$request->get('cod_fiscal');
        $client->telefon=$request->get('telefon');
        $client->save();
        return redirect('client')->with('success', 'Clientul a fost actualizat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = \App\Client::find($id);
        $client->delete();
        return redirect('client')->with('success', 'Clientul a fost sters');
    }
}
