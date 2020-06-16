@extends('layouts.app')

@section('content')
<rating-page :faculty="{{ auth()->user() }}"></rating-page>
@endsection
