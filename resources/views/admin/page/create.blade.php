@extends('admin.app')

@section('content')

    <form action="{{ route('admin.page.store') }}" method="post">
        <input type="text" name="name">
        <input type="text" name="slug">
        <input type="submit">
    </form>

@endsection