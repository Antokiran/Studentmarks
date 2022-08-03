@extends('app.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left text-center">
                <h3>Mark List</h3>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('marks.create') }}"> Create Marks</a>
            </div><br>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <span>{{ $message }}</span>
    </div>
    @endif
    <?php
        if(count($marks)>0)
        {
    ?>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Term</th>
            <th>Maths</th>
            <th>Science</th>
            <th>History</th>
            <th>Total Marks</th>
        </tr>
        
        @foreach ($marks as $mark)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $mark->student->name }}</td>
            <td>{{ $mark->term->term }}</td>
            <td>{{ $mark->maths }}</td>
            <td>{{ $mark->science}}</td>
            <td>{{ $mark->history}}</td>
            <td>{{ $mark->total}}</td>
            <td><form action="{{ route('marks.destroy',$mark->id) }}" method="POST">            
            <a class="btn btn-primary" href="{{ route('marks.edit',$mark->id) }}">Edit</a>
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
    <div class="pull-left">
            <a class="btn btn-primary" href="{{ route('students.index') }}"> Back</a>
    </div><br>
@endsection