@extends('app.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left"><br>
            <h2>Student Management</h2>
        </div><br>
        
        <div class="pull-right">
                <a class="btn btn-success" href="{{ route('students.index') }}">Student Details</a>
        </div><br>
        <div class="pull-right">
                <a class="btn btn-success" href="{{ route('marks.index') }}">Marks Details</a>
        </div><br>
        
    </div>
</div>    
@endsection