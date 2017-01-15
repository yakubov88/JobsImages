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

    <style>
        .row{
            padding: 10px 10px 10px 5px;
            width: 1300px;
            height: 1200px;
            margin: 5px 5px 5px 5px;


        }
        #image-holder {
            padding: 0;
            width: 300px;
            height: 300px;
            background: #5e5e5e;
            float: right;
            margin: 100px 200px 10px 10px;
        }
        .rota {
            width: 150px;
            height: 150px;
            float: left;
            border-radius: 50%;
            margin-right: 25px

        }


    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <![endif]-->

</head>
<body>
<div class="row">
    <div class="table-responsive">
        <table class="table table-striped" id="table">
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Filename</th>

            </tr>

            @foreach($jobs as $job)
                <tr >
                    <td>{{$job->id}}</td>
                    <td>{{$job->title}}</td>
                    <td>{{$job->description}}</td>
                    <td>

                        @foreach ($job->image as $item)

                            <img src="/uploads/{{$item->original_filename}}" alt="" class="rota">

                        @endforeach

                    </td>

                </tr>
            @endforeach

        </table>

    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://raw.githubusercontent.com/wilq32/jqueryrotate/master/jQueryRotate.js"></script>

<script>


</script>


</body>
</html>