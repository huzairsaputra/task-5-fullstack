@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Create Article
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'articles.store', 'enctype'=>'multipart/form-data']) !!}
                    <div class="row">
                        @include('pages.articles.fields')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

