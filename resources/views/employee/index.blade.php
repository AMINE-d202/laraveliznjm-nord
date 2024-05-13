@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="grey-text text-darken-1 center">Manage Employees</h4>
    {{-- Search --}}
    <div class="row mb-0">
        <ul class="collapsible">
            <li>
                <div class="collapsible-header">
                    <i class="material-icons">search</i>
                    Search 
                </div>
                <div class="collapsible-body">
                    <div class="row mb-0">
                        <form action="{{route('employees.search')}}" method="POST">
                            @csrf()
                            <div class="input-field col s12 m6 l5 xl6">
                                <input id="search" type="text" name="search" >
                                <label for="search">Search Employee</label>
                                <span class="{{$errors->has('search') ? 'helper-text red-text' : '' }}">{{$errors->has('search') ? $errors->first('search') : '' }}</span>
                            </div>
                            <div class="input-field col s12 m6 l4 xl4">
                                <select name="options" id="options">
                                    <option value="first_name">First Name</option>
                                    <option value="last_name">Last Name</option>
                                    <option value="email">Email</option>
                                    <option value="address">Address</option>
                                </select>
                                <label for="options">Search by:</label>
                            </div>
                            <div class="col s12 m6 l3 xl2">
                                <button type="submit" class="btn waves-effect waves-light">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    {{-- Search END --}}
    <div class="row">
        <h5 class="pl-15 grey-text text-darken-2">Employee List</h5>
        @if($employees->count())
            @foreach($employees as $employee)
                <div class="col s12 m6 l4 xl3">
                    <div class="card employee-card">
                        <div class="card-image">
                            <img src="{{asset('storage/employee_images/'.$employee->picture)}}" alt="{{$employee->first_name}}" class="employee-image">
                        </div>
                        <div class="card-content">
                            <span class="card-title grey-text text-darken-4">{{$employee->first_name}} {{$employee->last_name}}</span>
                            <p>Department: {{$employee->empDepartment->dept_name}}</p>
                            <p>Division: {{$employee->empDivision->division_name}}</p>
                            <p>Join Date: {{$employee->join_date}}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{route('employees.show',$employee->id)}}" class="btn waves-effect waves-light teal lighten-2">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
            @if(isset($search))
                <div class="col s12">
                    <a href="/employees" class="right">Show All</a>
                </div>
            @endif
        @else
            <div class="col s12">
                <h6 class="grey-text text-darken-2 center">No Employees Found!</h6>
            </div>
        @endif
    </div>
    <div class="center">
        {{$employees->links('vendor.pagination.default',['paginator' => $employees])}}
    </div>
</div>
<div class="fixed-action-btn">
    <a class="btn-floating btn-large waves-effect waves-light red" href="{{route('employees.create')}}">
        <i class="large material-icons">add</i>
    </a>
</div> 
@endsection
