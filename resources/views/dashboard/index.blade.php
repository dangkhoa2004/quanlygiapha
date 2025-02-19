@extends('layouts.app')

@section('content')
<style>
    .container {
        max-width: 1280px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 2fr 1.5fr;
        gap: 16px;
        padding: 48px 16px;
    }

    .sticky-sidebar {
        position: sticky;
        top: 24px;
        height: 130vh;
        overflow-y: auto;
    }

    .main-content {
        overflow-y: auto;
        border-radius: 16px;
        min-height: 130vh;
    }

    @media (max-width: 640px) {

        .sidebar-left,
        .sidebar-right {
            display: none;
        }

        .container {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container">
    <div class="sidebar-left sticky-sidebar">
        @include('dashboard.partials.reminder')
    </div>
    <div class="main-content">
        @include('dashboard.partials.newfeed')
    </div>
    <div class="sidebar-right sticky-sidebar">
        <div class="pb-4">
            @include('dashboard.partials.notification')
        </div>
        <div class="pb-4">
            @include('dashboard.partials.finance')
        </div>
    </div>
</div>
@endsection