<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Account Created</title>
</head>
<body>
    <h1>Your Employee Account Has Been Created</h1>
    <p>Hello,</p>
    <p>An employee account has been created for you. Below are your login details:</p>
    <p><strong>Email:</strong>{{ $email }}</p>
    <p><strong>Password:</strong>{{ $password }}</p>
    <p>Please log in to the platform using the provided credentials and change your password after logging in.</p>
    <p>Thank you!</p>
</body>
</html>