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
                @include('users.shared.user-card')
            </div>
            <hr>
            @forelse ($ideas as $idea)
                <div class="mt-3">
                    @include('ideas.shared.card')
                </div>
            @empty
                <h4 class="text-center">No Ideas yet</h4>
            @endforelse
        </div>
        <div class="col-3">
            @include('includes.search-bar')
            @include('includes.follow-box')
        </div>
    </div>
@endsection
