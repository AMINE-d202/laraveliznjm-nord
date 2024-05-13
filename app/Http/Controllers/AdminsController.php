<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller
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
       
        
        $admins = Admin::Paginate(4);
        return view('admin.index')->with('admins',$admins);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = new Admin();
        $this->validateRequest($request,NULL);
        $fileNameToStore = $this->handleImageUpload($request);
        $this->setAdmin($request ,$admin, $fileNameToStore);
        return redirect('/admins')->with('info','New Admin has been created!');
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::find($id);
        return view('admin.edit')->with('admin',$admin);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateRequest($request,$id);
        
        $admin = Admin::find($id);
        
        if($request->hasFile('picture')){

            $fileNameToStore = $this->handleImageUpload($request);
            Storage::delete('public/admins/'.$admin->picture);
        }else{
            $fileNameToStore = '';
        }
        
        $this->setAdmin($request, $admin ,$fileNameToStore);
        return redirect('/admins')->with('info','selected admin has been updated');
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if($id == Auth::user()->id){
            return redirect('/admins')->with('info','Authenticated Admin cannot be deleted!');
        }
        
        $admin = Admin::find($id);

        Storage::delete('public/admins/'.$admin->picture);
        $admin->delete();
        return redirect('/admins')->with('info','selected admin has been deleted!');
    }

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $this->validate($request,[
            'search' => 'required',
            'options' => 'required',
        ]);
        $str = $request->input('search');
        $option = $request->input('options');
        $admins = Admin::where( $option , 'LIKE' , '%'.$str.'%' )
            ->orderBy($option,'asc')
            ->paginate(4);
        return view('admin.index')->with([ 'admins' => $admins ,'search' => true ]);
    }

    private function validateRequest(Request $request, $id)
    {
        $this->validate($request,[
            'first_name'   =>  'required|min:3',
            'last_name'    =>  'required|min:3',
            'password'     =>  ''.( $id ? 'nullable|min:7' : 'required|min:7' ),
            'username'     =>  'required|unique:admins,username,'.($id ? : '' ).'|min:3',
            'email'        =>  'required|email|unique:admins,email,'.($id ? : '' ).'|min:7',
            'picture'      =>  ''.($request->hasFile('picture')  ? 'required|image|max:1999' : '')
        ]);
    }


    private function setAdmin(Request $request , Admin $admin , $fileNameToStore){
        $admin->first_name = $request->input('first_name');
        $admin->last_name = $request->input('last_name');
        $admin->username = $request->input('username');
        $admin->email = $request->input('email');
        if($request->input('password') != NULL){
            $admin->password = bcrypt($request->input('password'));
        }
        if($request->hasFile('picture')){
            $admin->picture = $fileNameToStore;
        }
        $admin->save();
    }


    public function handleImageUpload(Request $request){
        if( $request->hasFile('picture') ){
            
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            
            $filename = pathInfo($filenameWithExt,PATHINFO_FILENAME);
            
            $extension = $request->file('picture')->getClientOriginalExtension();
     
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            
            $path = $request->file('picture')->storeAs('public/admins' , $fileNameToStore);
        }

        return $fileNameToStore;
    }
}
