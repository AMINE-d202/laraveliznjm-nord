<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;

class StatesController extends Controller
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

        
        $states = State::Paginate(5);
        return view('sys_mg.states.index')->with('states',$states);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sys_mg.states.create');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'state_name' => 'required|unique:states|min:3'
        ]);
        $state = new State();
        $state->state_name = $request->input('state_name');
        $state->save();
        return redirect('/states')->with('info','New State has been created!');
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
        $state = State::find($id);
        return view('sys_mg.states.edit')->with('state',$state);
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
            'state_name' => 'required|min:3|unique:states'
        ]);

        $state = State::find($id);
        $state->state_name = $request->input('state_name');
        $state->save();
        return redirect('/states')->with('info','Selected State has been Updated!');
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = State::find($id);
        $state->delete();
        return redirect('/states')->with('info','Selected State has been deleted!');
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
        $states = State::where( 'state_name' , 'LIKE' , '%'.$str.'%' )
            ->orderBy('state_name','asc')
            ->paginate(4);
        return view('sys_mg.states.index')->with([ 'states' => $states ,'search' => true ]);
    }
}
