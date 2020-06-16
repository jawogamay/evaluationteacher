@extends('layouts.app')

@section('content')
<student-page :student="{{ auth()->user() }}"></student-page>
@endsection
