<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                {{-- <a href="{{ route('admin.prices.create',) }}" class="btn btn-primary float-end">{{
                    __('Create') }}</a> --}}
            </div>
            <div class="card-body">
                {{-- <form id="update-pages" action="{{ route('admin.prices.actions') }}" method="post">
                    @csrf
                </form> --}}
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Price Unit') }}</th>
                            <th>{{ __('Down Payment') }}</th>
                            <th>{{ __('Monthly Installment') }}</th>
                            <th>{{ __('Years') }}</th>
                            <th>{{ __('Settings') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($project->installments as $item)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $item->price }} EGP</td>
                                <td>{{ $item->deposit }} EGP</td>
                                <td>{{ $item->monthly_installment }} EGP</td>
                                <td>{{ $item->years }} years </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __('Settings') }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <button type="button" class="dropdown-item  text-center"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}"
                                                    data-bs-whatever="@getbootstrap">
                                                    {{ __('Edit') }}
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item text-bg-danger text-center" type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#danger-header-modal{{ $item->id }}">
                                                    {{ __('Delete') }}
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    @include('admin.pages.project.installment.__model_delete', ['id' => $item->id])
                                    @include('admin.pages.project.installment.__model_edit', ['id' => $item->id])
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">{{ __('No installment found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
