<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
    
    <div>
        <a href="{{ route('register') }}" class="btn btn-secondary btn-lg btn-block">Register</a>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Fav Colors</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key => $val)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $val['first_name'] }} {{ $val['last_name'] }}</td>
                        <td>{{ $val['email'] }}</td>
                        <td>{{ $val['gender'] }}</td>
                        <td>{{ $val['fav_color'] }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="{{ url('view/'.Crypt::encryptString($val["id"])) }}">View</a>
                                  <a class="dropdown-item" href="{{ url('edit/'.Crypt::encryptString($val["id"])) }}">Edit</a>
                                  <form id="deleteForm_{{ $val['id'] }}" action="{{ route('delete', Crypt::encryptString($val['id'])) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>