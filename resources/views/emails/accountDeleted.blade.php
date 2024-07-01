<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Deleted</title>
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col gap-8 justify-center items-center min-h-screen bg-white p-8">
    <img class="w-96" src="/images/not-found.svg" alt="not found">
    <div class="text-center">
        <h1 class="text-3xl font-bold mb-4">Account Deleted</h1>
        <p class="mb-4">Dear {{ $userName }},</p>
        <p>We regret to inform you that your account has been Banned by the admin.</p>
        <p class="mb-4">Because your content may be in violation of our community guidlines, and all content of yours have been deleted to protect our community.</p>
        <p class="font-bold">Best regards,<br />{{ config('app.name') }}</p>
    </div>
</body>

</html>