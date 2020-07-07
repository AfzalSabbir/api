<!DOCTYPE html>
<html>
<head>
    <title>Initial Password</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/stylesheets/theme.min.css') }}">
    <style type="text/css" media="screen">
        .font-large {font-size: larger;}
    </style>
</head>
<body>
    <h4>Hi {{ $details['name'] }},</h4>
    <p>
        Thank you for signup!<br />
        Your initial<br />
        <span style="margin-left: 12px;">Username : <strong class="font-large" style="padding: 2px 4px; color: white; border-radius: 3px; background: #346cb0;">{{ $details['username'] }}</strong></span>
        <br />
        <span style="margin-left: 12px;">Password : <strong class="font-large" style="padding: 2px 4px; color: white; border-radius: 3px; background: #346cb0;">{{ $details['password'] }}</strong></span>
    </p>
    <p>
        - Regarding <a href="{{ route('home') }}" title="">BoiNaw Team</a>
    </p>

</body>
</html>