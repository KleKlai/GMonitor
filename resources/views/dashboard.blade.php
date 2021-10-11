<x-custom-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <div class="row">
                    <div class="col">
                        {{ "Class List" }}
                    </div>
                    <div class="col float-right">
                        <a href="{{ route('classroom.create') }}"><i class="mdi mdi-plus"></i></a>
                    </div>
                </div>
            </h4>
            <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th> Name </th>
                        <th> Code </th>
                        <th> # of Student </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($classrooms as $classroom)
                        <tr>
                            <td>{{ $classroom->name }}</td>
                            <td>{{ $classroom->code }}</td>
                            <td>{{ $classroom->users_count -1 }}</td>
                            <td>
                                <a href="{{ route('classroom.show', $classroom->id) }}" class="btn btn-primary btn-rounded btn-fw">Open Attendance</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Create your first <a href="{{ route('classroom.create') }}">classroom</a></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>

</x-custom-layout>
