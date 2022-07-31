@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Show Article
                </div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>Judul</th>
                                    <td>
                                        {{ $article->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Isi</th>
                                    <td>
                                        {{ $article->content }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Gambar</th>
                                    <td>
                                        <img src="{{ asset('storage/articles/'.$article->image) }}" alt="{{ $article->image }}"
                                            class="img-thumbnail">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td>
                                        {{ $article->category->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Penulis</th>
                                    <td>
                                        {{ $article->user->name }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a style="margin-top:20px;" class="btn btn-danger" href="{{ url()->previous() }}">
                            Back
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection