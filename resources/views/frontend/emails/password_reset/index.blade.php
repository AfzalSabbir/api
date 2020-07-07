<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/stylesheets/theme.min.css') }}">
</head>
<body>
    <h4>Hi {{ $details['userData']['name'] }},</h4>
    <p>
    	You've requested for a password recovery at {{ $details['time'] }}.<br />
		If it's not you then ignore this mail and don't share it with anyone or if it's you then <a href="{{ route('user.setPassword', $details['token']) }}" title="">click here</a> and reset your password within 3hrs.<br />
		<a href="{{ route('user.setPassword', $details['token']) }}" title="">{{ route('user.setPassword', $details['token']) }}</a><br />
		Or use this code <strong class="text-primary">{{ $details['code'] }}</strong> in reset box.<br />
		Thank you!
    </p>
    <p>
		<i class="alert alert-info d-block">[Note: This link/code will be available for 3hrs]</i>
    </p>
    <p>
    	- Regarding <a href="{{ route('home') }}" title="">BoinawTeam</a>
    </p>

</body>
</html>