@extends('app.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add Student</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('students.index') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
    <form action="{{ route('students.store') }}" method="POST">
        @csrf    
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Enter Name">
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Age:</strong>
                    <input type="text" name="age" class="form-control" placeholder="Enter Age">
                </div>
            </div>
             
             <div class="col-xs-6 col-sm-6 col-md-6">               
                    
                    <select  name="teacher" class="form-group custom-select">
                        <option value="">Select Reporting to</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}"> {{ $teacher->name }}</option>
                        @endforeach
                     </select>
             </div> 
             <div class="col-xs-6 col-sm-6 col-md-6">   
                              
                    <strong>Gender:</strong>
                    <input class="form-group" type="radio" name="gender" value ="Male" class="form-control" >Male
                    <input class="form-group" type="radio" name="gender" value ="Female" class="form-control" >Female                   
                
             </div>
             <div class="col-xs-12 col-sm-12 col-md-12">
                 
                 <button  type="submit" class="btn btn-primary">Submit</button>
           
            </div>
        </div>
    
    </form>
@endsection