<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
</head>
<body>
    <div>
        <h1>Registration Form</h1>
        <form method ="POST" action="{{ route('user.register') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="first_name">First Name </label>
                <input type="text" name="first_name" placeholder="First Name" required>
            </div>
            <div>
                <label for="last_name">last Name </label>
                <input type="text" name="last_name" placeholder="Last Name" required>
            </div>
            <div>
                <label for="email">Email </label>
                <input type="text" name="email" placeholder="Email" required>
            </div>
            <div>
                <label for="gender_name">Gender </label>
                <label><input type="radio" name="gender" value="male" required>Male</label>
                <label><input type="radio" name="gender" value="female">Female</label>
            </div>
            <div>
                <label for="fav_color">Fav Color </label>
                <label><input type="checkbox" name="color[]" value="Yellow" class="checkbtn">Yellow</label>
                <label><input type="checkbox" name="color[]" value="Orange" class="checkbtn">Orange</label>
                <label><input type="checkbox" name="color[]" value="Brown"  class="checkbtn">Brown</label>
            </div>
            <div>
                <label for="password">Password </label>
                <input type="password" name="password" placeholder="password" required>
            </div>
            <div>
                <label for="confirm_password">Confirm Password </label>
                <input type="password" name="password_confirm" placeholder="Confirm Password" required>
            </div>
            <div>
                <label for="confirm_password">Upload image </label>
                <input type="file" name="images[]" multiple required>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</body>

</html>