<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Http\Requests;

class SubcontractorController extends Controller
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
        $subcontractors=\App\Subcontractor::all();
        return view('subcontractor.index', compact('subcontractors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subcontractor.create');
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
            'name' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return redirect('subcontractor/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $subcontractor = new \App\Subcontractor;
        $subcontractor->name = $request->get('name');
        $subcontractor->adresa=$request->get('adresa');
        $subcontractor->telefon=$request->get('telefon');
        $subcontractor->save();
        
        return redirect('subcontractor')->with('success', 'Subcontractorul a fost creat');
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
        $subcontractor = \App\Subcontractor::find($id);
        return view('subcontractor.edit', compact('subcontractor','id'));
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
        $subcontractor = \App\Subcontractor::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                         ->route('subcontractor.edit',['id'=>$id])
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $subcontractor = \App\Subcontractor::find($id);
        $subcontractor->name=$request->get('name');
        $subcontractor->adresa=$request->get('adresa');
        $subcontractor->telefon=$request->get('telefon');
        $subcontractor->save();
        return redirect('subcontractor')->with('success', 'Subcontractorul a fost actualizat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcontractor = \App\Subcontractor::find($id);
        $subcontractor->delete();
        return redirect('subcontractor')->with('success', 'Subcontractorul a fost sters');
    }
}
