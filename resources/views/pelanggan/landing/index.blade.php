@extends('layouts.app')

@section('content')
<main class="w-100">
    @include('sections.hero')
    @include('sections.brand-recommendation')
    @include('sections.recommended-products')
    @include('sections.featured-articles')
    @include('sections.footer')
</main>
@endsection
