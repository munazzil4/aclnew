@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Employees</h2>
            </div>
            <div class="pull-right">
                @can('employee-create')
                <a class="btn btn-success" href="{{ route('employees.create') }}"> Create New Employee</a>
                @endcan
            </div>
        </div>
        <br>
        <div class="mx-auto pull-right">
            <div class="">
                <form action="{{ route('employees.index') }}" method="GET" role="search">

                    <div class="input-group">
                        <span class="input-group-btn mr-5 mt-1">
                            <button class="btn btn-info" type="submit" title="Search Employees">
                                <span class="fas fa-search">Search</span>
                            </button>
                        </span>
                        <input type="text" class="form-control mr-2" name="term" placeholder="Search Employees" id="term">
                        <a href="{{ route('employees.index') }}" class="mt-1">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button" title="Refresh page">
                                    <span class="fas fa-sync-alt">Refresh</span>
                                </button>
                            </span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th>NIC</th>
            <th>Basic</th>
            <th>Allowance</th>
            <th>Gross</th>
            <th>EPF</th>
            <th>Net</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($employees as $employee)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $employee->name }}</td>
	        <td>{{ $employee->detail }}</td>
            <td>{{ $employee->nic }}</td>
	        <td>{{ $employee->basic }}</td>
            <td>{{ $employee->allowance }}</td>
	        <td>{{ $employee->gross }}</td>
            <td>{{ $employee->epf }}</td>
	        <td>{{ $employee->net }}</td>
	        <td>
                <form action="{{ route('employees.destroy',$employee->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('employees.show',$employee->id) }}">Show</a>
                    @can('employee-edit')
                    <a class="btn btn-primary" href="{{ route('employees.edit',$employee->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('employee-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $employees->links() !!}

    @endsection