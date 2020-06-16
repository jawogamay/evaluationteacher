@extends('layouts.app')

@section('content')
<user-page :admin="{{ auth()->user() }}"></user-page>
@endsection
