<!DOCTYPE html>
<html>
<head>
    <title>Get Username</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/stylesheets/theme.min.css') }}">
    <style type="text/css" media="screen">
        .font-large {font-size: larger;}
    </style>
</head>
<body>
    <h4>Hi {{ $details['name'] }},</h4>
    <p>
    	You've requested to know your username at {{ $details['time'] }}.<br />
		If it's not you then ignore this mail and don't share it with anyone or if it's you then here's your username <strong class="font-large">{{ $details['username'] }}</strong>.<br />
		Thank you!
    </p>
    <p>
    	- Regarding <a href="{{ route('home') }}" title="">BoinawTeam</a>
    </p>

</body>
</html>