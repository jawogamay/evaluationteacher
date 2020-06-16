@extends('layouts.app')

@section('content')
<student-evaluation-page :student="{{ auth()->user() }}"></student-evaluation-page>
@endsection
