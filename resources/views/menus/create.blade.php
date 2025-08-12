@extends('layouts.app')
@section('content')
    <div class="container-xxl">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Create Menu</h4>
                            </div><!--end col-->
                        </div> <!--end row-->
                    </div><!--end card-header-->
                    <div class="card-body pt-0">
                        <form class="form" action="{{ route('menu.store') }}" method="POST">
                            @csrf
                            <div class="mb-2">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" type="text" name="name" placeholder="Enter name">
                                <small>Error Message</small>
                            </div>
                            <div class="mb-2">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" cols="30" rows="2"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form><!--end form-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->

    </div>
@endsection
