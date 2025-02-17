@extends('layouts.app')

@section('content')
<style>
    .sticky-sidebar {
        position: sticky;
        top: 24px;
        height: 130vh;
        overflow-y: auto;
    }
</style>

<body class="bg-none p-6">
    <div class="max-w-7xl mx-auto grid grid-cols-12 pt-6 gap-4">
        <!-- Sidebar left -->
        <div class="col-span-3 sticky-sidebar">
            @include('dashboard.partials.reminder')
        </div>

        <!-- Main content (newsfeed) -->
        <div class="col-span-5 overflow-y-auto rounded-2xl" style="min-height: 130vh;">
            @include('dashboard.partials.newfeed')
        </div>

        <!-- Sidebar right -->
        <div class="col-span-4 sticky-sidebar">
            <div class="pb-4">
                @include('dashboard.partials.notification')
            </div>
            <div>
                @include('dashboard.partials.finance')
            </div>
        </div>
    </div>
</body>

</html>
@endsection