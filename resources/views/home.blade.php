@extends('layouts.app')

@section('content')
<example :user="{{ auth()->user() }}" :user2="{{ $friend }}"></example>
@endsection
