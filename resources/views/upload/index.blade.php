<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Multiple Upload</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="http://cdn.sobekrepository.org/includes/jquery-rotate/2.2/jquery-rotate.js"></script>

    <style>
        .container{
            width: 700px;
            height: 700px;
            float: left;
        }
        #image-holder {
            padding: 0;
            width: 300px;
            height: 300px;

            float: right;
            margin: 100px 200px 10px 10px;
        }
        #image_preview{
            width: 300px;
            height: 300px;
            padding: 10px 10px 10px 10px;
            margin: 10px 10px 10px 10px;
            float: inherit;
        }


    </style>


</head>
<body>

<div class="container">
    <div class="alert-box success" id="alert">
        </div>
    @if(Session::has('success'))
        <div class="alert-box success">
            <h2>{!! Session::get('success') !!}</h2>
        </div>
    @endif
    <div class="form-group">
        <h2> Jobs Upload</h2>

        {!! Form::open(array('url'=>'upload/uploadFiles','method'=>'POST', 'files'=>true , 'id'=>'form')) !!}
        {{Form::label('title','Title')}}
        {{Form::text('title',null,array('class'=>'form-control','required'=>'','id'=>'title'))}}
        {{Form::label('description',' Description')}}
        {{Form::textarea('description', null, array('class'=>'form-control','required'=>''))}}
        {!! Form::file('images[]', array('class'=>'form-control','multiple'=>true,'id'=>'fileUpload')) !!}
        <p>{!!$errors->first('images')!!}</p>
        @if(Session::has('error'))
            <p>{!! Session::get('error') !!}</p>
        @endif

        <button class="btn btn-lg btn-primary col-md-4" id="add">Upload</button>
        {!! Form::close() !!}



    </div>


</div>
        <div id="image-holder">  </div>

         <div id="image_preview"></div>



<script type="text/javascript">


    $(document).ready(function(){



    var title = $('input[name=title]').val();
    var description = $('input[name=description]').val();
    var _token = $('input[name=_token]').val();
    var file = $('input[type=file]').val();
    var image_holder = $('#image-holder');
    var image_preview = $('#image_preview');
    $("#fileUpload").on('change', function () {

        //Get count of selected files
        var countFiles = $(this)[0].files.length;

        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();


        image_holder.empty();


        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {

                //loop for each file selected for uploaded.
                var clas = 'img';
                for (var i = 0; i < countFiles; i++) {

                    var reader = new FileReader();

                    reader.onload = function (e) {

                        clas+=i;
                        $("<img />", {
                            "src": e.target.result,
                            "id": "thumb-image"
                        }).appendTo(image_holder).css("width", 200).css("height", 200).addClass( clas).clone()
                                .css("width", 500).css("height", 300).appendTo(image_preview);
                    }

                    image_holder.show();
                    image_preview.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                    console.log(clas);

                }
                var angle = 0;
                $(clas).click(function () {
                    angle = angle+45;
                    $(this).rotate(angle);
                });



            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            alert("Pls select only images" );
            $(this).val('');
        }



    });

        $('#add').on('click',(function(e) {
            e.preventDefault();
            if($('#title').val()==0) {
                alert('title false');
                $('#title').focus();
            }else {
                $.ajax({
                    url: '/upload/uploadFiles',
                    type: 'POST',
                    data: new FormData($('#form')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function () {
                        $('#alert').html('<div class="alert alert-success"> <strong>Success!</strong> The Jobs Success Uploaded</div>');
                    },
                    error: function () {
                        alert('error');
                    }

                });
                $('#title').val('');
                $('#description').val('');
                $('#fileUpload').val('');
                image_holder.hide();
                image_preview.hide();
            }
        }));

    });







</script>
</body>
</html>