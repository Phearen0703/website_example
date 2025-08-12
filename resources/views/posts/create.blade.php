@extends('layouts.app')
@section('content')
    <div class="container-xxl">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Create Post</h4>
                            </div><!--end col-->
                        </div> <!--end row-->
                    </div><!--end card-header-->
                    <div class="card-body pt-0">
                        <form class="form" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-2">
                                <label for="menu_id" class="form-label">Menu Name</label>
                                <select class="form-select" name="menu_id" required>
                                    <option value="">Select Menu</option>
                                    @foreach($menus as $menu)
                                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">{{ $errors->first('menu_id') }}</small>
                            </div>
                            <div class="mb-2">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" required>
                                <small class="text-danger">{{ $errors->first('title') }}</small>
                            </div>
                            <div class="mb-2">
                                <label for="subtitle" class="form-label">Sub Title</label>
                                <input type="text" class="form-control" name="subtitle">
                                <small class="text-danger">{{ $errors->first('subtitle') }}</small>
                            </div>
                            <div class="mb-2">
                                <label for="contents" class="form-label">content</label>
                                <textarea class="form-control" name="contents" cols="30" rows="2"></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                <input type="file" class="form-control" name="thumbnail">
                                <small class="text-danger">{{ $errors->first('thumbnail') }}</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form><!--end form-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->

    </div>
@endsection
