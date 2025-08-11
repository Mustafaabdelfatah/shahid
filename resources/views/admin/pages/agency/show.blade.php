@extends('admin.dashboard')
@section('title', __('Agency'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class=" page-title">{{ __('Show Agency') }}</h4>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3" role="tablist">
            <li class="nav-item" role="presentation">
                <a href="#information" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active"
                    aria-selected="true" role="tab" tabindex="-1">
                    {{__('Information')}}
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#team" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 "
                    aria-selected="false" role="tab">
                    {{__('Team')}}
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#settings1" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0"
                    aria-selected="false" role="tab" tabindex="-1">
                    {{__('Units')}}
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="information" role="tabpanel">
                <div class="row">
                    <div class="col-lg-4">
                        <!-- Date Range -->
                        <div class="mb-3">
                            <label class="form-label" for="name">{{__('Name')}}</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="{{__('Name')}}"
                                value="{{old('name',$user->name)}}" disabled>
                        </div>
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label" for="email">{{__('Email')}}</label>
                            <input type="email" class="form-control date" id="email" name="email"
                                value="{{old('email',$user->email)}}" disabled>
                        </div>
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <div>
                            <label class="form-label" for="password">{{__('Phone')}}</label>
                            <input type="text" class="form-control date" id="phone" name="phone"
                                value="{{old('phone',$user->phone)}}" disabled>
                        </div>
                        @error('phone')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="tab-pane  show" id="team" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">{{__('Team name is ')}} : {{$team->title}}</h4>
                    </div>
                    <div class="card-body">

                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Phone') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($team->teams as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                </tr>
                                @empty
                                @endforelse

                            </tbody>
                        </table>

                    </div> <!-- end card-body -->
                </div>
            </div>
            <div class="tab-pane" id="settings1" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3 mb-2 mb-sm-0">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <a class="nav-link show active" id="v-pills-home-tab" data-bs-toggle="pill"
                                        href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                                        aria-selected="true">
                                        {{__('List Unit Agency')}}
                                    </a>
                                    <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                        href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                                        aria-selected="false" tabindex="-1">
                                        {{__('List Unit Team')}}
                                    </a>

                                </div>
                            </div> <!-- end col-->

                            <div class="col-sm-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel"
                                        aria-labelledby="v-pills-home-tab">
                                        <div class="card-body">
                                            {{-- {{ route('admin.projects.actions') }} --}}
                                            <form id="update-pages" action="{{ route('admin.units.actions') }}"
                                                method="post">
                                                @csrf

                                            </form>
                                            <table id="datatable-buttons"
                                                class="table table-striped dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr class="bluck-actions" style="display: none" scope="row">
                                                        <td colspan="8">
                                                            <div class="col-md-12 mt-0 mb-0 text-center">
                                                                <button form="update-pages"
                                                                    class="btn btn-success btn-sm" type="submit"
                                                                    name="publish" value="1">
                                                                    <i class="ri-star-fill"></i>
                                                                </button>
                                                                <button form="update-pages"
                                                                    class="btn btn-warning btn-sm" type="submit"
                                                                    name="unpublish" value="1">
                                                                    <i class="ri-star-s-line"></i>
                                                                </button>
                                                                <button form="update-pages"
                                                                    class="btn btn-danger btn-sm" type="submit"
                                                                    name="delete_all" value="1">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 1px">
                                                            <input form="update-pages"
                                                                class="checkbox-check flat cursor-pointer"
                                                                type="checkbox" name="check-all" id="check-all"
                                                                title="check-all">
                                                        </th>
                                                        <th>#</th>
                                                        <th>{{ __('Title') }}</th>
                                                        <th>{{ __('Categories') }}</th>
                                                        <th>{{ __('Unit Code') }}</th>


                                                        <th>{{ __('Actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($team->user->units as $item)
                                                    <tr class="text-center">
                                                        <td>
                                                            <input form="update-pages" class="checkbox-check"
                                                                type="checkbox" name="record[{{ $item->id }}]" value={{
                                                                $item->id }}>
                                                        </td>
                                                        <th>{{ $loop->iteration }}</th>
                                                        <td>{{ optional($item->trans->where('locale',
                                                            $current_lang)->first())->title }}</td>
                                                        <td>{{ optional($item->category->trans->where('locale',
                                                            $current_lang)->first())->title }}
                                                        </td>

                                                        <td>{{ $item->code }}</td>


                                                        <td>
                                                            <div class="d-flex justify-content-around">
                                                                @if ($item->status == 1)
                                                                <a href="{{ route('admin.units.update-status', $item->id) }}"
                                                                    class="btn btn-outline-success btn-sm"
                                                                    title="{{ __('Active') }}">
                                                                    <i class="ri-star-fill"></i>
                                                                </a>
                                                                @else
                                                                <a href="{{ route('admin.units.update-status', $item->id) }}"
                                                                    class="btn btn-outline-warning btn-sm"
                                                                    title="{{ __('Inactive') }}">
                                                                    <i class="ri-star-s-line"></i>
                                                                </a>
                                                                @endif

                                                                @if ($item->for_sale == 1)
                                                                <a href="{{ route('admin.units.for_sale', $item->id) }}"
                                                                    class="btn btn-outline-success btn-sm"
                                                                    title="{{ __('Sold') }}">
                                                                    <i class="ri-shield-check-fill"></i>
                                                                </a>
                                                                @else
                                                                <a href="{{ route('admin.units.for_sale', $item->id) }}"
                                                                    class="btn btn-outline-warning btn-sm"
                                                                    title="{{ __('For Sale') }}">
                                                                    <i class="ri-shield-check-line"></i>
                                                                </a>
                                                                @endif

                                                                <a href="{{ route('admin.units.show', $item->id) }}"
                                                                    class="btn btn-pink btn-sm"
                                                                    title="{{ __('Show') }}">
                                                                    <i class="ri-eye-fill"></i>
                                                                </a>
                                                                <a href="{{ route('admin.units.edit', $item->id) }}"
                                                                    class="btn btn-primary btn-sm"
                                                                    title="{{ __('Edit') }}">
                                                                    <i class="ri-edit-line"></i>
                                                                </a>

                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#danger-header-modal{{ $item->id }}"
                                                                    title="{{ __('Delete') }}">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </button>
                                                            </div>
                                                            @include('admin.pages.unit._model_delete')
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="11" class="text-center">{{ __('No products found')
                                                            }}</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>


                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                        aria-labelledby="v-pills-profile-tab">
                                        <div class="card-body">
                                            {{-- {{ route('admin.projects.actions') }} --}}
                                            <form id="update-pages" action="{{ route('admin.units.actions') }}"
                                                method="post">
                                                @csrf

                                            </form>
                                            <table id="datatable-buttons"
                                                class="table table-striped dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr class="bluck-actions" style="display: none" scope="row">
                                                        <td colspan="8">
                                                            <div class="col-md-12 mt-0 mb-0 text-center">
                                                                <button form="update-pages"
                                                                    class="btn btn-success btn-sm" type="submit"
                                                                    name="publish" value="1">
                                                                    <i class="ri-star-fill"></i>
                                                                </button>
                                                                <button form="update-pages"
                                                                    class="btn btn-warning btn-sm" type="submit"
                                                                    name="unpublish" value="1">
                                                                    <i class="ri-star-s-line"></i>
                                                                </button>
                                                                <button form="update-pages"
                                                                    class="btn btn-danger btn-sm" type="submit"
                                                                    name="delete_all" value="1">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 1px">
                                                            <input form="update-pages"
                                                                class="checkbox-check flat cursor-pointer"
                                                                type="checkbox" name="check-all" id="check-all"
                                                                title="check-all">
                                                        </th>
                                                        <th>#</th>
                                                        <th>{{ __('Title') }}</th>
                                                        <th>{{ __('Categories') }}</th>
                                                        <th>{{ __('Unit Code') }}</th>


                                                        <th>{{ __('Actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($units as $item)
                                                    <tr class="text-center">
                                                        <td>
                                                            <input form="update-pages" class="checkbox-check"
                                                                type="checkbox" name="record[{{ $item->id }}]" value={{
                                                                $item->id }}>
                                                        </td>
                                                        <th>{{ $loop->iteration }}</th>
                                                        <td>{{ optional($item->trans->where('locale',
                                                            $current_lang)->first())->title }}</td>
                                                        <td>{{ optional($item->category->trans->where('locale',
                                                            $current_lang)->first())->title }}
                                                        </td>

                                                        <td>{{ $item->code }}</td>


                                                        <td>
                                                            <div class="d-flex justify-content-around">
                                                                @if ($item->status == 1)
                                                                <a href="{{ route('admin.units.update-status', $item->id) }}"
                                                                    class="btn btn-outline-success btn-sm"
                                                                    title="{{ __('Active') }}">
                                                                    <i class="ri-star-fill"></i>
                                                                </a>
                                                                @else
                                                                <a href="{{ route('admin.units.update-status', $item->id) }}"
                                                                    class="btn btn-outline-warning btn-sm"
                                                                    title="{{ __('Inactive') }}">
                                                                    <i class="ri-star-s-line"></i>
                                                                </a>
                                                                @endif

                                                                @if ($item->for_sale == 1)
                                                                <a href="{{ route('admin.units.for_sale', $item->id) }}"
                                                                    class="btn btn-outline-success btn-sm"
                                                                    title="{{ __('Sold') }}">
                                                                    <i class="ri-shield-check-fill"></i>
                                                                </a>
                                                                @else
                                                                <a href="{{ route('admin.units.for_sale', $item->id) }}"
                                                                    class="btn btn-outline-warning btn-sm"
                                                                    title="{{ __('For Sale') }}">
                                                                    <i class="ri-shield-check-line"></i>
                                                                </a>
                                                                @endif

                                                                <a href="{{ route('admin.units.show', $item->id) }}"
                                                                    class="btn btn-pink btn-sm"
                                                                    title="{{ __('Show') }}">
                                                                    <i class="ri-eye-fill"></i>
                                                                </a>
                                                                <a href="{{ route('admin.units.edit', $item->id) }}"
                                                                    class="btn btn-primary btn-sm"
                                                                    title="{{ __('Edit') }}">
                                                                    <i class="ri-edit-line"></i>
                                                                </a>

                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#danger-header-modal{{ $item->id }}"
                                                                    title="{{ __('Delete') }}">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </button>
                                                            </div>
                                                            @include('admin.pages.unit._model_delete')
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="11" class="text-center">{{ __('No products found')
                                                            }}</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>


                                        </div>
                                    </div>

                                </div> <!-- end tab-content-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->
                    </div> <!-- end card-body -->
                </div>
            </div>
        </div>
    </div> <!-- end card-body -->
</div>
@endsection