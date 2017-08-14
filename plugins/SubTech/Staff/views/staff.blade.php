<div style="background-color: limegreen; color: firebrick">
    <h1>da subtech peeps</h1>
    @foreach($staff as $category => $members)
        <h2>{{ ucfirst($category) }}</h2>
        @foreach($members as $member)
            <div style="width: 25%">
                <strong>{{ $member->user }}</strong><br/>
                <i>{{ $member->title }}</i><br/>
            </div>
        @endforeach
    @endforeach
</div>
