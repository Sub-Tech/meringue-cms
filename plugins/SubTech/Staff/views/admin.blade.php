<button>Refresh Users</button>

<ul>
    @foreach($staff as $category => $members)
        @foreach($members as $member)
            <li>
                {{ $member->user }}
            </li>
        @endforeach
    @endforeach
</ul>
