<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
      <div class="container"  style="margin-top: 5px;">
        
       <form method="post" action="{{route('images.update',$Images->id)}}" enctype="multipart/form-data">
        @method('PUT')
         @csrf
            <div class="form-group">
              <label for="image">Image Upload</label>
              <input type="file" name="image_upload" class="form-control" id="image" placeholder="Select image" value="{{$Images->image_upload}}">
              <img src="{{asset('uploads/images/'.$Images->image_upload)}}" width="50px;" height="50px;">
  
            </div>
    
         
            <button type="submit" class="btn btn-primary">Submit</button>
         </form>

      </div>
</body>
</html>