<x-layout-app page-title="Colaborators">

    <div class="w-100 p-4">

        <h3>All colaborators</h3>

        <hr>

        <!-- table -->
        @if ($colaborators->count() === 0)

            <div class="text-center my-5">
                <p>No colaborators found.</p>
            </div>
        @else
            <table class="table" id="table">
                <thead class="table-dark">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Active</th>
                    <th>Department</th>
                    <th>Role</th>
                    <th>Admission date</th>
                    <th>Salary</th>
                    <th></th>
                </thead>
                <tbody>

                    @foreach ($colaborators as $colaborator)
                        <tr>
                            <td>{{ $colaborator->name }}</td>
                            <td>{{ $colaborator->email }}</td>
                            <td>
                                @empty($colaborator->email_verified_at)
                                    <span class="badge bg-danger">No</span>
                                @else
                                    <span class="badge bg-success">Yes</span>
                                @endempty
                            </td>
                            <td>{{ $colaborator->department->name }}</td>
                            <td>{{ $colaborator->role }}</td>
                            <td>{{ $colaborator->detail->admission_date }}</td>
                            <td>{{ $colaborator->detail->salary }}$</td>

                            <td>

                                <div class="d-flex pag-3 justify-content-end">
                                    @if ($colaborator->id === 1)
                                        <i class="fa-solid fa-lock"></i>
                                    @else
                                        <a href="{{ route('colaborators.details', ['id' => $colaborator->id]) }}"
                                            class="btn btn-sm btn-outline-dark ms-3">
                                            <i class="fas fa-eye me-2"></i>
                                            Details
                                        </a>
                                        <a href="{{ route('colaborators.delete', ['id' => $colaborator->id]) }}"
                                            class="btn btn-sm btn-outline-dark ms-3">
                                            <i class="fa-regular fa-trash-can me-2"></i>
                                            Delete
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @endif

</x-layout-app>
