@extends('admin.app')

@section('content')
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

    <a href="{{ route('staff.refresh') }}" class="btn btn-primary">Refresh Staff</a>
@endsection
