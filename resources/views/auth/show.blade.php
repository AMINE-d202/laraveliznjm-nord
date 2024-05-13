@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2 l6 offset-l3 xl6 offset-xl3">
                <div class="card-panel grey-text text-darken-2 mt-20">
                    <h4 class="grey-text text-darken-1 center">My Profile</h4>
                    <div class="row">
                        <div class="col m4 l4 xl3">
                            <img class="p5 card-panel emp-img-big" src="{{asset('storage/admins/'.Auth::user()->picture)}}">
                        </div>
                        <div class="col m8 l8 xl9">
                            <h5 class="pl-15 mt-20">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h5>
                            <p class="pl-15 mt-20"><i class="material-icons left">person</i>{{Auth::user()->username}}</p>
                            <p class="pl-15 mt-20"><i class="material-icons left">email</i>{{Auth::user()->email}}</p>
                            <div class="center mt-20">
                                <a class="btn orange" href="{{route('admins.edit',Auth::user()->id)}}">Update</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
