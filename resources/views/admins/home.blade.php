@extends('layouts.app')

@section('content')
<admin-page :admin="{{ auth()->user() }}"></admin-page>
@endsection
