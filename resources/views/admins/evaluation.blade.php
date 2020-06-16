@extends('layouts.app')

@section('content')
<evaluation-page :admin="{{ auth()->user() }}"></evaluation-page>
@endsection
