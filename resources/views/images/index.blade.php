<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>

<!-- latest validation jqoery -->
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>

<style type="text/css">
    .error {
      color: red;
  }
</style>

</head>

<body >
      @if(session('status'))
        <h1 class="alert alert-success">{{session('status')}}</h1>
      @endif

     <div class="container" style="margin-top: 5px;">
      <a href="{{route('images.create')}}" class="btn btn-primary ">Add Image</a>
      <form method="POST" id="filter" action="{{url('datefilter')}}">
        @csrf
          <input type="text" class="datetimepicker1 required" name="from_date" >

            @if($errors->has('from_date'))
               <div class="text-danger">{{$errors->first('from_date')}}</div>      
            @endif

          <input type="text" class="datetimepicker1 required" name="to_date" >
             @if($errors->has('to_date'))
               <div class="text-danger">{{$errors->first('to_date')}}</div>
             @endif
          <button type="submit" class="btn btn-primary">Search</button>
      </form>
    <table class="table" id="example">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Image</th>
          <th scope="col">Action</th>
       
        </tr>
      </thead>
      <?php  $count = 1;?>
      <tbody>
        @foreach($Images as $Image)
        <tr>
            <td scope="row">{{$count ++}}</td> 
          <td> <img src="{{asset('uploads/images/'.@$Image->image_upload)}}" width="50px;" height="50px;"></td>        
          <td>
            <a href="{{route('images.edit',@$Image->id)}}" class="btn btn-primary">Edit</a>
            <a href="{{route('images.destroy',@$Image->id)}}" class="btn btn-danger del">Delete</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function () {
      $('#example').DataTable({
          pagingType: 'full_numbers',
      });
  });
    $(function() {
  $('.datetimepicker1').datetimepicker();
});
  $(document).ready(function(){
  $(".del").click(function(){
    if (!confirm("Do you want to delete")){
      return false;
    }
  });
});
   $('#filter').validate({ // initialize the plugin
        rules: {
            image_upload: {
                required: true,
            },
       
        },
        highlight: function (element) {
                $(element).parent().addClass('error')
            },
            unhighlight: function (element) {
                $(element).parent().removeClass('error')
            }
    });

</script>
</body>
</html>
