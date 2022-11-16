@extends('admin.empty')
@section('css')

@section('title')
    Categories
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> Categories</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Categories</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')


    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @include('admin.errors')
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModalScrollable">
                                New Category
                            </button>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>processes</th>

                            </tr>
                            </thead>
                            <tbody>
                        <?php $i=0; ?>
                            @foreach($categories as $cat)
                                <tr>
                                    <td>#</td>
                                    <td><img src="{{asset('uploads/categories/'.$cat->img)}}" class="img-thumbnail" style="width: 100px;height: 100px;border-radius: 50%;"/></td>
                                    <td>{{$cat->name}}</td>
                                    <td>{{$cat->desc}}</td>
                                    <td>
                                        <a class="btn btn-primary d-inline-block" data-toggle="modal" data-target="#edit{{$cat->id}}"><i class="fa fa-edit" style="color: #ffffff"></i></a>
                                        <a class="btn btn-danger d-inline-block" data-toggle="modal" data-target="#delete{{$cat->id}}"><i class="fa fa-trash" style="color: #ffffff"></i></a>

                                    </td>
                                </tr>





                                <div class="modal fade" id="edit{{$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle">New Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{route('admin.categories.update','test')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    {{@method_field('patch')}}

                                                    <input type="hidden" name="id" value="{{$cat->id}}">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Name</label>
                                                        <input type="text" value="{{$cat->name}}" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Description</label>
                                                        <input type="text" value="{{$cat->desc}}" name="desc" class="form-control" id="exampleInputPassword1" placeholder="Description">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Image</label>
                                                        <img src="{{asset('uploads/categories/'.$cat->img)}}" class="img-thumbnail" style="width: 100px;height: 100px;border-radius: 50%;">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Image</label>
                                                        <input type="file" name="img" class="form-control" id="exampleInputPassword1" placeholder="">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Save</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="delete{{$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{route('admin.categories.destroy','test')}}">
                                                    @csrf
                                                    {{@method_field('Delete')}}

                                                  Are you sure

                                                    <input type="hidden" name="id" value="{{$cat->id}}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Delete</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">NEW CATEGORY</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.categories.store','test')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <input type="text" name="desc" class="form-control" id="exampleInputPassword1" placeholder="Description">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Image</label>
                            <input type="file" name="img" class="form-control" id="exampleInputPassword1" placeholder="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>




@endsection
@section('js')

@endsection
