<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;

class CitiesController extends Controller
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

        
        $cities = City::Paginate(5);
        return view('sys_mg.cities.index')->with('cities',$cities);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sys_mg.cities.create');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'city_name' => 'required|min:2',
            'zip_code' => 'required|min:4|unique:cities'
        ]);
        $city = new City();
        $city->city_name = $request->input('city_name');
        $city->zip_code = $request->input('zip_code');
        $city->save();
        return redirect('/cities')->with('info','City has been created!');
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
        $city = City::find($id);
        return view('sys_mg.cities.edit')->with('city',$city);
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
            'city_name' => 'required|min:2',
            'zip_code' => 'required|min:4|unique:cities,zip_code,'.$id
        ]);
        $city = City::find($id);
        $city->city_name = $request->input('city_name');
        $city->zip_code = $request->input('zip_code');
        $city->save();
        return redirect('/cities')->with('info','Selected city has been updated!');
        
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();
        return redirect('/cities')->with('info','Selected city has been deleted!');
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
        $cities = City::where( 'city_name' , 'LIKE' , '%'.$str.'%' )
            ->orderBy('city_name','asc')
            ->paginate(4);
        return view('sys_mg.cities.index')->with([ 'cities' => $cities ,'search' => true ]);
    }
}
