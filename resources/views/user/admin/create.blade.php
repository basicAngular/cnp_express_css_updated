@extends('layouts.user')
{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

{{-- Content --}}
@section('content')
    <div class="page-header clearfix">
    </div>
    <!-- ./ notifications -->
    @include('user/admin/_form')
@stop

@section('scripts')
    <script>
    </script>
@endsection
