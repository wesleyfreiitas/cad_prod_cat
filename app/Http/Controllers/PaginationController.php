<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pagination;

class PaginationController extends Controller
{
    //Sem usar Jquery
    public function index()
    {
        //$paginations = Pagination::all();
        $paginations = Pagination::paginate(10);
        return view('pagination', compact('paginations'));
    }
    //Usando Jquery
    public function indexjs()
    {
        return view('indexjs');
    }
    public function indexjson()
    {
        return Pagination::paginate(10);
    }
    public function create()
    {
        
    }

    
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
