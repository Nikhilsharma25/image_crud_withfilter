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
<!-- latest validation jqoery -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<style type="text/css">
    .error {
      color: red;
  }
</style>
</head>
<body>
      <div class="container" style="margin-top: 5px;">
        
       <form method="post" id="eclub" action="{{route('images.store')}}" enctype="multipart/form-data">

         @csrf
            <div class="form-group">
              <label for="image" class="required">Image Upload</label>
              <input type="file" name="image_upload" class="form-control required" id="image" placeholder="Select image" >
               @if($errors->has('image_upload'))
                 <div class="text-danger">{{ $errors->first('image_upload') }}</div>
               @endif
  
            </div>
    
         
            <button type="submit" class="btn btn-primary">Submit</button>
         </form>

      </div>
</body>
<script type="text/javascript">
  $('#eclub').validate({ // initialize the plugin
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
</html>