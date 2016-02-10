<!DOCTYPE html>
<html>
    <head>
        <title>Bookstore</title>
    </head>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/dataTables.bootstrap.css" >

    <script src="jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/dataTables.bootstrap.js"></script>


    <body>
        <div class="container">
          <nav class="navbar navbar-default">
            <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <a class="navbar-brand" href="#">Bookstore</a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  {{  Form::open(array('url' => 'import', 'action'=> 'BookController@importBooks', 'method' => 'post', 'class'=>'navbar-form navbar-left', 'role' => 'search', 'files' => true)) }}
                  {{  Form::file('csvfile', array('class' => 'form-control'))  }}
                  {{ Form::button('<span class="glyphicon glyphicon-upload"/>', array('class' => 'btn btn-success', 'type'=>'submit')) }}
                  {{  Form::close()  }}
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
          </nav>

          <div class="jumbotron">
            {{  Form::open(array('action'=>'BookController@addBook', 'method' => 'post', 'class'=>'form-horizontal')) }}
            <fieldset>
            <!-- Text input-->
            <div class="form-group">
              {{  Form::label('title', 'Title', array('class' => 'col-md-4 control-label')) }}
              <div class="col-md-4">
              {{  Form::text('title', '', array('class' => 'form-control input-md', 'placeholder' => 'Title'))  }}
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              {{  Form::label('author', 'Author', array('class' => 'col-md-4 control-label')) }}
              <div class="col-md-4">
              {{  Form::text('author', '', array('class' => 'form-control input-md', 'placeholder' => 'Author'))  }}
              </div>
            </div>

            <!-- Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="add"></label>
              <div class="col-md-4">
                {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
              </div>
            </div>
            </fieldset>
            {{  Form::close()  }}
          </div>

          <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">Books</div>

            <!-- Table -->
            <table class="table" id="booktable">
              <thead>
                <tr>
                  <td><b>Title<b></td>
                  <td><b>Author<b></td>
                  <td><b>Delete<b></td>
                </tr>
              </thead>
              <tbody>
                  @foreach ($books as $book)
                  <tr>
                      <td>{{ $book->title }}</td>
                      <td>{{ $book->author }}</td>
                      <td>
                        {{  Form::open(array('action'=> ['BookController@removeBook', $book->id], 'method' => 'post', 'class'=>'form-horizontal')) }}
                        {{ Form::button('<span class="glyphicon glyphicon-trash"/>', array('class' => 'btn btn-danger', 'type'=>'submit')) }}
                        {{  Form::close()  }}
                      </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <script>
        $(document).ready(function(){
            $('#booktable').DataTable();
        });
        </script>
    </body>
</html>
