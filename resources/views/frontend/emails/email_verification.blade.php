<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/stylesheets/theme.min.css') }}">
    <style type="text/css" media="screen">
        .font-large {font-size: larger;}
    </style>
</head>
<body>
    <h4>Hi {{ $details['name'] }},</h4>
    <p>
        You've signed up for an account at {{ $details['time'] }} using this email.<br />
        If it's not you then ignore this mail and don't share it with anyone or if it's you then here's your verification code <strong class="font-large" style="padding: 0px 4px; color: white; border-radius: 3px; background: #346cb0;">{{ $details['code'] }}</strong>.<br />
        <a href="{{ route('emailVerification', encrypt($details['token'])) }}">Click here</a> to verify or <a href="{{ route('emailVerification', encrypt($details['token'])) }}" title="">{{ route('emailVerification', encrypt($details['token'])) }}</a><br />
        Use this code within <strong>3hrs</strong>!
    </p>
    <p>
        - Regarding <a href="{{ route('home') }}" title="">BoiNaw Team</a>
    </p>

</body>
</html>