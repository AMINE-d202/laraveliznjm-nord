<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DepartmentsController extends Controller
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

        
        $departments = Department::orderBy('dept_name','asc')->Paginate(4);
        


        return view('sys_mg.departments.index')->with('departments',$departments);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('sys_mg.departments.create');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $this->validate($request,[
            'dept_name' => 'required|min:4|unique:departments'
        ]);


        
        $department = new Department();
        $department->dept_name = $request->input('dept_name');
        $department->save();
        

        
         return redirect('/departments')->with('info','department has been Created!');
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
        

        
         $department = Department::find($id);
        

        
         return view('sys_mg.departments.edit')->with('department',$department);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'dept_name' => 'required|unique:departments,dept_name,'.$id.'|min:4'
        ]);
        

        
        $department = Department::Find($id);
        $department->dept_name = $request->input('dept_name');
        $department->save();

        return redirect('/departments')->with('info','Selected Department has been updated!');
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $department = Department::find($id);
        $department->delete();
        return redirect('/departments')->with('info','Selected Department has been Deleted!');
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
        $departments = Department::where( 'dept_name' , 'LIKE' , '%'.$str.'%' )
            ->orderBy('dept_name','asc')
            ->paginate(4);
        return view('sys_mg.departments.index')->with([ 'departments' => $departments ,'search' => true ]);
    }
}
