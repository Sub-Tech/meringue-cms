@extends('admin.app')

@section('content')
    <button class="btn btn-primary">Refresh Users</button>

    <table>
        <tbody>
        @foreach($staff as $member)
            <tr>
                <td>{{ $member->user }}</td>
                <td>
                    <a href="https://stamp.submissiontechnology.co.uk/users/edit/{{ $member->userid }}">
                        <button class="btn btn-success">Edit</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
