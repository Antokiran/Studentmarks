@extends('app.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Student</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('students.index') }}"> Back</a>
        </div>
    </div>
</div></br>
   
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
@foreach ($student as $stud)
    <form action="{{ route('students.update',[$stud->id]) }}" method="POST">
    @csrf    
    @method('PUT')
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" value = {{$stud->name}}>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Age:</strong>
                    <input type="text" name="age" class="form-control" value = {{$stud->age}}>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">               
                    
                    <select  name="teacher" class="form-group custom-select">
                        <option value="">Select Reporting to</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ $teacher->id == $stud->teacher_id? 'selected' : ''  }}>{{ $teacher->name}}</option>                            
                            @endforeach
                     </select>
             </div>
             <div class="col-xs-6 col-sm-6 col-md-6">   
                              
                    <strong>Gender:</strong>
                    <input class="form-group" type="radio" name="gender" value ="Male" class="form-control"{{ $stud->gender == "Male" ? 'checked' : '' }}>Male
                    <input class="form-group" type="radio" name="gender" value ="Female" class="form-control"{{ $stud->gender == "Female" ? 'checked' : '' }} >Female                   
                
             </div>
             <div class="col-xs-12 col-sm-12 col-md-12">
                 
                 <button  type="submit" class="btn btn-primary">Submit</button>
           
            </div>
        </div>
       
    </form>
    @endforeach
@endsection