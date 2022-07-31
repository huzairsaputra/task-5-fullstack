@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Show Category
                </div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <th>Kategori</th>
                                <td>
                                    {{ $category->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>Pengguna</th>
                                <td>
                                    {{ $category->user->name }}
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
