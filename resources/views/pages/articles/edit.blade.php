@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Article
                </div>
                <div class="card-body">
                    {!! Form::model($article, ['route' => ['articles.update', $article->id], 'method' => 'patch', 'enctype'=>'multipart/form-data']) !!}
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


