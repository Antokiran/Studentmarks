@extends('app.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Marks</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('marks.index') }}"> Back</a>
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
@foreach ($marks as $mark)
    <form action="{{ route('marks.update',[$mark->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">               
                    <div class="form-group">
                            <strong>Name:</strong>        
                            {{$mark->student->name}}
                    </div> 
                </div>
                
        </div>
        <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">               
                    <div class="form-group">
                            <strong>Term:</strong>        
                            {{$mark->term->term}}
                    </div> 
                </div>
                
        </div>
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Maths</strong>
                        <input type="text" name="mark1" class="form-control" value = {{$mark->maths}}>
                    </div>
                
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Science</strong>
                        <input type="text" name="mark2" class="form-control" value = {{$mark->science}}>
                    </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>History</strong>
                        <input type="text" name="mark3" class="form-control" value = {{$mark->history}}>
                    </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12"> 
                <button  type="submit" class="btn btn-primary">Submit</button>
        </div>
       
    </form> 
    @endforeach
@endsection