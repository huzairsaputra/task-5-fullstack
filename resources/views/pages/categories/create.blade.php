@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Create Category
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'categories.store']) !!}
                    <div class="row">
                        @include('pages.categories.fields')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

