@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('includes.sidebar')
        </div>
        <div class="col-6">
            @include('includes.success')
            <hr>
            <div class="mt-3">
                @include('ideas.sharedf.card')
            </div>
        </div>
        <div class="col-3">
            @include('includes.search-bar')
            @include('includes.follow-box')
        </div>
    </div>
@endsection
