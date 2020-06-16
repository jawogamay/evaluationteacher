@extends('layouts.app')

@section('content')
<faculty-page :faculty="{{ auth()->user() }}"></faculty-page>
@endsection
