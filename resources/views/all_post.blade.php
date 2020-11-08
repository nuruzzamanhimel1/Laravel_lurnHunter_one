@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard
                        <a href="#addNew" class="btn btn-primary float-right" data-toggle="modal">Add New</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped" id="mytable">
                                <thead class="thead-dark">
                                <tr>
                                    <th width="">No</th>
                                    <th width="">Title</th>
                                    <th width="">Author</th>
                                    <th width="">Description</th>
                                    <th width="">Tags</th>
                                    <th width="">Action</th>
                                </tr>
                                </thead>
                                <tbody id="table_body">
                                @if($posts->count() > 0)
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->author }}</td>
                                            <td>{{ $post->description }}</td>
                                            <td>{{ $post->tags }}</td>
                                            <td>
                                                <a href="#editModal" class="btn btn-success btn-sm" data-toggle="modal">Edit</a>

                                                <a href="{{ route('delete_info',$post->id) }}" class="btn btn-danger btn-sm delete-confirm"> Delete</a>
                                            </td>

                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-la belledby="exampleModalCenterTitle"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Post</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <form method="POST" action="{{ route('update_post',$post->id) }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" class="form-control" id="" name="title" value="{{ $post->title }}">

                                            </div>
                                            <div class="form-group">
                                                <label for="">Author</label>
                                                <input type="text" class="form-control" id="author" name="author" value="{{ $post->author }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea class="form-control" id="" rows="3" name="description">{{ $post->description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Tags</label>
                                                <input type="text" class="form-control" id="tags" name="tags" value="{{ $post->tags }}">
                                            </div>

                                            <button type="submit" class="btn btn-primary mx-auto d-block">Update Record</button>
                                        </form>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                                        </tr>
                                    @endforeach
                                @endif


                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('insert_post') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control" id="" name="title">

                                </div>
                                <div class="form-group">
                                    <label for="">Author</label>
                                    <input type="text" class="form-control" id="author" name="author">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea class="form-control" id="" rows="3" name="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Tags</label>
                                    <input type="text" class="form-control" id="tags" name="tags">
                                </div>

                                <button type="submit" class="btn btn-primary mx-auto d-block">Add new Record</button>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
         </div>
@endsection
