@extends('layouts.app')
@section('content')
<div id="messi">
    <div class="row white-text">
        <div class="col s12 m10 l40">
            <div class="custom-card pink lighten-1">
                <a href="/admins" class="black-text">
                    <h6>Admins</h6>
                    <p>Total({{$t_admins}})</p>
                </a>
            </div>
        </div>
        <div class="col s12 m10 l40">
            <div class="custom-card teal lighten-1">
                <a href="/employees" class="black-text">
                    <h6>Employees</h6>
                    <p class="black-employees">Total({{$t_employees}})</p>
                </a>
            </div>
        </div>
        <div class="col s12 m10 l40">
            <div class="custom-card red lighten-1">
                <a href="/departments" class="black-text">
                    <h6>Departments</h6>
                    <p>Total({{$t_departments}})</p>
                </a>
            </div>
        </div>
    </div>
</div>

    
    
@endsection