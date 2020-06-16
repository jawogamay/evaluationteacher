@extends('layouts.app')

@section('content')
<school-page :admin="{{ auth()->user() }}"></school-page>
@endsection
