@extends('layouts.app_layout')

@section('app_layout')

@includeIf('layouts.partials.navbar')

@includeIf('layouts.partials.sidebar')

<div class="main-content">
    <section >
        <div >
            @include('layouts.partials.flash-message')
            @yield('content')

        </div>
    </section>

    @includeIf('layouts.partials.setting')

</div>
    
@endsection