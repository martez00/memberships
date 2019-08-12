<div>
    Hello, {{ $userMembership->user->name }},<br>
    Your {{ $userMembership->membership->name }} has expired at {{ $userMembership->end_date }}.
    @if($token)
        <br>If you want to extend that membership for another five minutes – visit this link:<br>
        <a href="{{ route('user_membership.showExtend', $token) }}" target="_blank">CLICK ON ME</a> or
        copy {{ route('user_membership.showExtend', $token) }} to your browser.
    @endif
</div>
