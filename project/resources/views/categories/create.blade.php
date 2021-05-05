@extends('layouts.app')
@section('title', __('headings.categories.create'))

@section('page-header')
    <h1>
        <i class="fas fa-user-shield fa-fw mr-2 text-muted"></i>
        @lang('headings.categories.create')
    </h1>
    <breadcrumb>
        <breadcrumb-item href="{{ route('home') }}">
            @lang('breadcrumb.common.home')
        </breadcrumb-item>

        <breadcrumb-item href="{{ route('categories.index') }}">
            @lang('breadcrumb.categories.index')
        </breadcrumb-item>

        <breadcrumb-item active>
            @lang('breadcrumb.common.create')
        </breadcrumb-item>
    </breadcrumb>
@endsection

@section('content')
<div class="card card-secondary">
    <form class="form-horizontal" method="POST" action="{{ route('categories.store') }}">
        <div class="card-body pb-0">
            @include('categories._partials.form')
        </div>
        <div class="card-footer">
            @include('shared.create_buttons', ['urlBack' => route('categories.index')])
        </div>
    </form>
</div>
@endsection
