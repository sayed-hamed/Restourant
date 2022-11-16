@extends('admin.empty')
@section('css')

@section('title')
    Menue
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> Menue</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Menue</li>
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
                                New Menu
                            </button>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>IMAGE</th>
                                <th>NAME</th>
                                <th>DESCRIPTION</th>
                                <th>PRICE</th>
                                <th>processes</th>

                            </tr>
                            </thead>
                            <tbody>
                                                     <?php $i=0; ?>
                           @foreach($menus as $menu)
                            <tr>
                                <td>#</td>
                                <td><img src="{{asset('uploads/menus/'.$menu->img)}}" class="img-thumbnail" style="width: 100px;height: 100px;border-radius: 50%;"></td>
                                <td>{{$menu->name}}</td>
                                <td>{{$menu->desc}}</td>
                                <td>{{$menu->price}}</td>
                                <td>
                                    <a class="btn btn-primary d-inline-block" data-toggle="modal" data-target="#edit"><i class="fa fa-edit" style="color: #ffffff"></i></a>
                                    <a class="btn btn-danger d-inline-block" data-toggle="modal" data-target="#delete{{$menu->id}}"><i class="fa fa-trash" style="color: #ffffff"></i></a>

                                </td>
                            </tr>





                            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">UPDATE MENU</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('admin.menues.update','test')}}" enctype="multipart/form-data">
                                                @csrf
                                                {{@method_field('patch')}}

                                                <input type="hidden" name="id" value="{{$menu->id}}">
                                                <div class="form-group">
                                                    <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                                                    <div class="mt-1">
                                                        <input type="text" id="name" value="{{$menu->name}}" name="name"
                                                               class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                                    </div>
                                                    @error('name')
                                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="image" class="block text-sm font-medium text-gray-700"> Image </label>
                                                    <div class="mt-1">
                                                        <img src="{{asset('uploads/menus/'.$menu->img)}}" class="img-thumbnail" style="width: 100px;height: 100px;border-radius: 50%;">
                                                    </div>

                                                <div class="form-group">
                                                    <label for="image" class="block text-sm font-medium text-gray-700"> Image </label>
                                                    <div class="mt-1">
                                                        <input type="file" id="image" name="img"
                                                               class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                                    </div>
                                                    @error('image')
                                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="price"  class="block text-sm font-medium text-gray-700"> Price </label>
                                                    <div class="mt-1">
                                                        <input type="number" value="{{$menu->price}}" min="0.00" max="10000.00" step="0.01" id="price" name="price"
                                                               class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                                    </div>
                                                    @error('price')
                                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="body" class="block text-sm font-medium text-gray-700">Description</label>
                                                    <div class="mt-1">
                                              <textarea id="body" rows="3"  name="description"
                                          class="shadow-sm focus:ring-indigo-500 appearance-none bg-white border py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                  {{$menu->desc}}
                                              </textarea>
                                                    </div>
                                                    @error('description')
                                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="categories" class="block text-sm font-medium text-gray-700">Categories</label>
                                                    <div class="mt-1">
                                                        <select id="categories" name="categories[]" class="form-multiselect block w-full mt-1"
                                                                multiple>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}" @selected($menu->categories->contains($category))>{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

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







                            <div class="modal fade" id="delete{{$menu->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('admin.menues.destroy','test')}}">
                                                @csrf
                                                {{@method_field('Delete')}}

                                                Are you sure

                                                <input type="hidden" name="id" value="{{$menu->id}}">
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
                        <h5 class="modal-title" id="exampleModalScrollableTitle">New Menu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('admin.menues.store','test')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                                <div class="mt-1">
                                    <input type="text" id="name" name="name"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('name')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image" class="block text-sm font-medium text-gray-700"> Image </label>
                                <div class="mt-1">
                                    <input type="file" id="image" name="img"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('image')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price" class="block text-sm font-medium text-gray-700"> Price </label>
                                <div class="mt-1">
                                    <input type="number" min="0.00" max="10000.00" step="0.01" id="price" name="price"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('price')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="body" class="block text-sm font-medium text-gray-700">Description</label>
                                <div class="mt-1">
                                <textarea id="body" rows="3" name="description"
                                          class="shadow-sm focus:ring-indigo-500 appearance-none bg-white border py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                                </div>
                                @error('description')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="categories" class="block text-sm font-medium text-gray-700">Categories</label>
                                <div class="mt-1">
                                    <select id="categories" name="categories[]" class="form-multiselect block w-full mt-1"
                                            multiple>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

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
