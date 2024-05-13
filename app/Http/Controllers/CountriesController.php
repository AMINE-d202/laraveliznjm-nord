<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;

class CountriesController extends Controller
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
        /**
         */
        
        $countries = Country::Paginate(5);
        return view('sys_mg.countries.index')->with('countries',$countries);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sys_mg.countries.create');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'country_name' => 'required|unique:countries|min:3'
        ]);
        $country = new Country();
        $country->country_name = $request->input('country_name');
        $country->save();
        return redirect('/countries')->with('info','New Country has been created!');
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);
        return view('sys_mg.countries.edit')->with('country',$country);
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
            'country_name' => 'required|min:3|unique:countries'
        ]);

        $country = Country::find($id);
        $country->country_name = $request->input('country_name');
        $country->save();
        return redirect('/countries')->with('info','Selected Country has been Updated!');
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);
        $country->delete();
        return redirect('/countries')->with('info','Selected Country has been deleted!');
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
        $countries = Country::where( 'country_name' , 'LIKE' , '%'.$str.'%' )
            ->orderBy('country_name','asc')
            ->paginate(4);
        return view('sys_mg.countries.index')->with([ 'countries' => $countries ,'search' => true ]);
    }
}
