<div>
    Hello, {{ $userMembership->user->name }},<br>
    We want to inform you, that your {{ $userMembership->membership->name }} membership has expired
    at {{ $userMembership->end_date }}.
    @if($token)
        <br>If you want to extend that membership for another five minutes – visit this link:
        <a href="{{ route('user_membership.showExtend', $token) }}" class="btn btn-sm btn-primary" target="_blank">CLICK ON ME</a> or
        copy {{ route('user_membership.showExtend', $token) }} to your browser.
    @endif
</div>
