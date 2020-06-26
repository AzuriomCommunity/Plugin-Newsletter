@extends('admin.layouts.admin')

@section('title', trans('newsletter::messages.titles.newsletter'))

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
        <form action="{{ route('newsletter.admin.newsletter') }}" method="POST">

                @include('newsletter::admin._form')

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-envelope"></i> {{ trans('newsletter::messages.actions.send') }}
                </button>
            </form>
        </div>
    </div>
@endsection
