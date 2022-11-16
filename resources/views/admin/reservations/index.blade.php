@extends('admin.empty')
@section('css')

@section('title')
    Reservation
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> Reservation</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Reservation</li>
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
                                New Reservation
                            </button>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>PHONE</th>
                                <th>RESERVATION DATE</th>
                                <th>GUEST NUMBER</th>
                                <th>TABLE</th>
                                <th>PROCESS</th>

                            </tr>
                            </thead>
                            <tbody>
                           <?php $i=1; ?>
                            @foreach($reservations as $res)
                            <tr>
                                <td><?php echo $i++?></td>
                                <td>{{$res->first_name}} {{$res->last_name}}</td>
                                <td>{{$res->email}}</td>
                                <td>{{$res->phone}}</td>
                                <td>{{$res->res_date}}</td>
                                <td>{{$res->guest_number}}</td>
                                <td>{{$res->table->name}}</td>
                                <td>
                                    <a class="btn btn-primary d-inline-block" data-toggle="modal" data-target="#edit"><i class="fa fa-edit" style="color: #ffffff"></i></a>
                                    <a class="btn btn-danger d-inline-block" data-toggle="modal" data-target="#delete"><i class="fa fa-trash" style="color: #ffffff"></i></a>

                                </td>
                            </tr>





                            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">UPDATE RESERVATION</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('admin.reserv.update','test')}}">
                                                @csrf
                                                {{@method_field('patch')}}

                                                <input type="hidden" name="id" value="{{$res->id}}">
                                                <div class="sm:col-span-6">
                                                    <label for="first_name" class="block text-sm font-medium text-gray-700"> First Name </label>
                                                    <div class="mt-1">
                                                        <input type="text" id="first_name" name="first_name"
                                                               value="{{ $res->first_name }}"
                                                               class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                                    </div>
                                                    @error('first_name')
                                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="sm:col-span-6">
                                                    <label for="last_name" class="block text-sm font-medium text-gray-700"> Last Name </label>
                                                    <div class="mt-1">
                                                        <input type="text" id="last_name" name="last_name"
                                                               value="{{ $res->last_name }}"
                                                               class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                                    </div>
                                                    @error('last_name')
                                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="sm:col-span-6">
                                                    <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
                                                    <div class="mt-1">
                                                        <input type="email" id="email" name="email" value="{{ $res->email }}"
                                                               class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                                    </div>
                                                    @error('email')
                                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="sm:col-span-6">
                                                    <label for="tel_number" class="block text-sm font-medium text-gray-700"> Phone number
                                                    </label>
                                                    <div class="mt-1">
                                                        <input type="text" id="tel_number" name="tel_number"
                                                               value="{{ $res->phone }}"
                                                               class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                                    </div>
                                                    @error('tel_number')
                                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="sm:col-span-6">
                                                    <label for="res_date" class="block text-sm font-medium text-gray-700"> Reservation Date
                                                    </label>
                                                    <div class="mt-1">
                                                        <input type="date" id="res_date" name="res_date"
                                                               value="{{ $res->res_date}}"
                                                               class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                                    </div>
                                                    @error('res_date')
                                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="sm:col-span-6">
                                                    <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest Number
                                                    </label>
                                                    <div class="mt-1">
                                                        <input type="number" id="guest_number" name="guest_number"
                                                               value="{{ $res->guest_number }}"
                                                               class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                                    </div>
                                                    @error('guest_number')
                                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="sm:col-span-6 pt-5">
                                                    <label for="status" class="block text-sm font-medium text-gray-700">Table</label>
                                                    <div class="mt-1">
                                                        <select id="table_id" name="table_id" class="form-multiselect block w-full mt-1">
                                                            @foreach ($tables as $table)
                                                                <option value="{{ $table->id }}" @selected($table->id == $res->table_id)>
                                                                    {{ $table->name }}
                                                                    ({{ $table->guest_number }} Guests)
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('table_id')
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
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">DELETE RESERVATION</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('admin.reserv.destroy','test')}}">
                                                @csrf
                                                {{@method_field('Delete')}}

                                                Are you sure

                                                <input type="hidden" name="id" value="{{$res->id}}">
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
                        <h5 class="modal-title" id="exampleModalScrollableTitle">NEW RESERVATION</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('admin.reserv.store')}}">
                            @csrf
                            <div class="sm:col-span-6">
                                <label for="first_name" class="block text-sm font-medium text-gray-700"> First Name </label>
                                <div class="mt-1">
                                    <input type="text" id="first_name" name="first_name"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('first_name')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6">
                                <label for="last_name" class="block text-sm font-medium text-gray-700"> Last Name </label>
                                <div class="mt-1">
                                    <input type="text" id="last_name" name="last_name"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('last_name')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6">
                                <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
                                <div class="mt-1">
                                    <input type="email" id="email" name="email"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('email')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6">
                                <label for="tel_number" class="block text-sm font-medium text-gray-700"> Phone number
                                </label>
                                <div class="mt-1">
                                    <input type="text" id="tel_number" name="tel_number"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('tel_number')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6">
                                <label for="res_date" class="block text-sm font-medium text-gray-700"> Reservation Date
                                </label>
                                <div class="mt-1">
                                    <input type="date" id="res_date" name="res_date"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('res_date')
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
                                <label for="status" class="block text-sm font-medium text-gray-700">Table</label>
                                <div class="mt-1">
                                    <select id="table_id" name="table_id" class="form-multiselect block w-full mt-1">
                                        @foreach ($tables as $table)
                                            <option value="{{ $table->id }}">{{ $table->name }}
                                                ({{ $table->guest_number }} Guests)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('table_id')
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
