<button>Refresh Users</button>

<ul>
    @foreach($staff as $member)
        <li>
            {{ $member->user }}
        </li>
    @endforeach
</ul>
