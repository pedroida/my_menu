@extends('layouts.app')
@section('title', __('headings.promotions.edit'))

@section('page-header')
    <h1>
        <i class="fas fa-user-shield fa-fw mr-2 text-muted"></i>
        @lang('headings.promotions.edit')
    </h1>
    <breadcrumb>
        <breadcrumb-item href="{{ route('home') }}">
            @lang('breadcrumb.common.home')
        </breadcrumb-item>

        <breadcrumb-item href="{{ route('promotions.index') }}">
            @lang('breadcrumb.promotions.index')
        </breadcrumb-item>

        <breadcrumb-item active>
            @lang('breadcrumb.common.edit')
        </breadcrumb-item>
    </breadcrumb>
@endsection

@section('content')
<div class="card card-secondary">
    <form class="form-horizontal" method="POST" action="{{ route('promotions.update', $promotion) }}">
        @method('PUT')
        <div class="card-body pb-0">
            @include('promotions._partials.form')
        </div>
        <div class="card-footer">
            @include('shared.update_buttons', ['urlBack' => route('promotions.index')])
        </div>
    </form>
</div>
@endsection
