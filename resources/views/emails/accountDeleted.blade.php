<!DOCTYPE html>
<html>
<head>
    <title>Account Deleted</title>
</head>
<body>
    <h1>Account Deleted</h1>
    <p>Dear {{ $userName }},</p>
    <p>We regret to inform you that your account has been Banned by the admin.</p>
    <p>Because your content may be in violation of our community guidlines, and all content of yours have been deleted to protect our community.</p>
    <p>Best regards,<br/>{{ config('app.name') }}</p>
</body>
</html>
