@extends('app.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left text-center">
                <h3>Student List</h3>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('students.create') }}"> Create Student</a>
            </div><br>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <span>{{ $message }}</span>
    </div>
    @endif
    <?php
        if(count($students)>0)
        {
    ?>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Teacher</th>
            <th>Action</th>
        </tr>
        @foreach ($students as $student)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->age }}</td>
            <td>{{ $student->gender }}</td>
            <td>{{ $student->teacher->name}}</td>
            <td><form action="{{ route('students.destroy',$student->id) }}" method="POST">            
            <a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Do you really want to delete student!')" class="btn btn-danger">Delete</button>
            </form></td>
        </tr>
        @endforeach
    </table>
    <?php
        }else{
            echo "No records found!!";
        }
    ?>
{!! $students->links() !!}
<div class="pull-left">
            <a class="btn btn-primary" href="{{ route('students.index') }}"> Back</a>
</div>
@endsection