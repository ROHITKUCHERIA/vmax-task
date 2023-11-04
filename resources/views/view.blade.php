<!-- user_details.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<style>
    .profile-section {
            width: 75%;
            height: 300px;
        }

        .profile-section img {
            width: 75%;
            height: 300px;
        }
        
</style>
<body>
    @php
        $images = explode(',',$users['images']);
    @endphp
    <h1>User Details</h1>
    <div>
        <p><strong>First Name:</strong> {{ $users['first_name'] }}</p>
        <p><strong>Last Name:</strong> {{ $users['last_name'] }}</p>
        <p><strong>Email:</strong> {{ $users['email'] }}</p>
        <p><strong>Gender:</strong> {{ $users['gender'] }}</p>
        <p><strong>Favorite Colors:</strong> {{$users['fav_color'] }}</p>
        @foreach ($images as $img)
            <div class="profile-section">
                @if (isset($img) && file_exists(public_path($img)))
                    <img src="{{ url($img) }}" alt="uploaded Images">
                @endif
            </div>    
        @endforeach
    </div>
</body>
</html>
