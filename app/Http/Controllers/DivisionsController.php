<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Division;

class DivisionsController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        $divisions = Division::paginate(5);
        return view('sys_mg.divisions.index')->with('divisions',$divisions);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sys_mg.divisions.create');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'division_name' => 'required|min:3|unique:divisions'
        ]);
        $division = new Division();
        $division->division_name = $request->input('division_name');
        $division->save();
        return redirect('/divisions')->with('info','New Division has been created!');
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $division = Division::find($id);
        return view('sys_mg.divisions.edit')->with('division',$division);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'division_name' => 'required|min:3|unique:divisions'
        ]);
        $division = Division::find($id);
        $division->division_name = $request->input('division_name');
        $division->save();
        return redirect('/divisions')->with('info','Selected Division has been updated!');
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $division = Division::find($id);
        $division->delete();
        return redirect('/divisions')->with('info','Selected Division has been deleted!');
    }

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $this->validate($request,[
            'search' => 'required'
        ]);
        $str = $request->input('search');
        $divisions = Division::where( 'division_name' , 'LIKE' , '%'.$str.'%' )
            ->orderBy('division_name','asc')
            ->paginate(4);
        return view('sys_mg.divisions.index')->with([ 'divisions' => $divisions ,'search' => true ]);
    }
}
