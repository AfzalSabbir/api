<footer class="footer text-center mt-3 bg-light border-light rounded py-1">
	&copy; 2020{{ (int)date('Y') > 2020 ? ' - Present':'' }}
	<br />
	All Rights Reserved by <a href="{{ env('APP_DEVELOPER_COMPANY_URL') }}">{{ env('APP_DEVELOPER_COMPANY') }}</a>
</footer>
