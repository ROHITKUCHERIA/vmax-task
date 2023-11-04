<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
                <label for="last_name">Last Name </label>
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
                <label><input type="checkbox" name="color[]" value="Brown" class="checkbtn">Brown</label>
            </div>
            <div id="checkboxError" style="color: red; display: none;">Please select at least one color.</div>
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
            <button type="submit" onclick="return validateForm()">Register</button>
        </form>
    </div>

    <script>
        function validateForm() {
            var checkboxes = document.querySelectorAll('input[name="color[]"]:checked');
            if (checkboxes.length === 0) {
                document.getElementById('checkboxError').style.display = 'block';
                return false;
            } else {
                document.getElementById('checkboxError').style.display = 'none';
                return true;
            }
        }
    </script>
</body>

</html>