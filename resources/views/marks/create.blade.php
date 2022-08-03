@extends('app.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add Marks</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('marks.index') }}"> Back</a>
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
   
    <form action="{{ route('marks.store') }}" method="POST">
        @csrf
    
        <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">               
                    <div class="form-group">
                            <strong>Name:</strong>        
                            <select  name="student" id="student" class="form-group custom-select">
                                <option value="">Select Student</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}"> {{ $student->name }}</option>
                                @endforeach
                            </select>
                    </div> 
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">               
                    <div class="form-group">
                    <strong>Term:</strong> 
                    <select class="form-control" name="term" id="term">
                    </select>
                    </div> 
                </div>
        </div>
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Maths</strong>
                        <input type="text" name="mark1" class="form-control" placeholder="Enter Marks">
                    </div>
                
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Science</strong>
                        <input type="text" name="mark2" class="form-control" placeholder="Enter Marks">
                    </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>History</strong>
                        <input type="text" name="mark3" class="form-control" placeholder="Enter Marks">
                    </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12"> 
                <button  type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form> 
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function () {
                $('#student').on('change',function(e) {
                    var id = e.target.value;
                    $.ajax({
                    url:'/ajax/' +id,
                    type:"POST",
                        data: {
                        id: id
                        },
                        success:function (data) {
                            
                            if (!$.trim(data)){ 
                                $("#term").empty() ;
                                alert("Both terms are already added for this Student, Please edit the records")    
                            }else{
                            console.log(data);

                            //Add the Options to the DropDownList.
                                var options = data.terms.map(function(val, ind){
                                $("#term").empty() ;
                                return $("<option></option>").val(val.id).html(val.term);
                                });
                            $('#term').append(options);
                            } 
                        }
                })
            });
        });
</script>
    
@endsection