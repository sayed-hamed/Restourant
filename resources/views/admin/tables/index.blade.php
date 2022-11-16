@extends('admin.empty')
@section('css')

@section('title')
    Tables
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> Tables</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Tables</li>
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
                                New Tables
                            </button>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Guest Number</th>
                                <th>Status</th>
                                <th>Location</th>
                                <th>Processes</th>

                            </tr>
                            </thead>
                            <tbody>
                           <?php $i=0; ?>
                           @foreach($tables as $table)
                            <tr>
                                <td><?php echo $i++?></td>
                                <td>{{$table->name}}</td>
                                <td>{{$table->guest_number}}</td>
                                <td>{{$table->status->name}}</td>
                                <td>{{$table->location->name}}</td>
                                <td>
                                    <a class="btn btn-primary d-inline-block" data-toggle="modal" data-target="#edit"><i class="fa fa-edit" style="color: #ffffff"></i></a>
                                    <a class="btn btn-danger d-inline-block" data-toggle="modal" data-target="#delete"><i class="fa fa-trash" style="color: #ffffff"></i></a>

                                </td>
                            </tr>





                            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">UPDATE TABLE</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('admin.tables.update','test')}}">
                                                @csrf
                                                {{@method_field('patch')}}

                                                <input type="hidden" name="id" value="{{$table->id}}">
                                                <div class="sm:col-span-6">
                                                    <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                                                    <div class="mt-1">
                                                        <input type="text" id="name" name="name" value="{{ $table->name }}"
                                                               class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                                    </div>
                                                    @error('name')
                                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="sm:col-span-6">
                                                    <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest Number
                                                    </label>
                                                    <div class="mt-1">
                                                        <input type="number" id="guest_number" name="guest_number"
                                                               value="{{ $table->guest_number }}"
                                                               class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                                    </div>
                                                    @error('guest_number')
                                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="sm:col-span-6 pt-5">
                                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                                    <div class="mt-1">
                                                        <select id="status" name="status" class="form-multiselect block w-full mt-1">
                                                            @foreach (App\Enums\TableStatus::cases() as $status)
                                                                <option value="{{ $status->value }}" @selected($table->status->value == $status->value)>
                                                                    {{ $status->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('status')
                                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="sm:col-span-6 pt-5">
                                                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                                                    <div class="mt-1">
                                                        <select id="location" name="location" class="form-multiselect block w-full mt-1">
                                                            @foreach (App\Enums\TableLocation::cases() as $location)
                                                                <option value="{{ $location->value }}" @selected($table->location->value == $location->value)>
                                                                    {{ $location->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('location')
                                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                                    @enderror
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

                            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Table</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('admin.tables.destroy','test')}}">
                                                @csrf
                                                {{@method_field('Delete')}}

                                                Are you sure

                                                <input type="hidden" name="id" value="{{$table->id}}">
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
                        <h5 class="modal-title" id="exampleModalScrollableTitle">NEW TABLE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('admin.tables.store','test')}}">
                            @csrf
                            <div class="sm:col-span-6">
                                <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                                <div class="mt-1">
                                    <input type="text" id="name" name="name"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('name')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6">
                                <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest Number
                                </label>
                                <div class="mt-1">
                                    <input type="number" id="guest_number" name="guest_number"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('guest_number')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <div class="mt-1">
                                    <select id="status" name="status" class="form-multiselect block w-full mt-1">
                                        @foreach (App\Enums\TableStatus::cases() as $status)
                                            <option value="{{ $status->value }}">{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('status')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                                <div class="mt-1">
                                    <select id="location" name="location" class="form-multiselect block w-full mt-1">
                                        @foreach (App\Enums\TableLocation::cases() as $location)
                                            <option value="{{ $location->value }}">{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('location')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
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
