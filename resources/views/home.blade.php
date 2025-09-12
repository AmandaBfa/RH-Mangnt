<x-layout-app page-title="Home">

    <div class="w-100 p-4">
        <h3>Home</h3>
        <hr>

        {{-- <div class="d-flex">
            <x-info-title-value item-title="Total Colaboradores" :item-value="$data['total_colaborators']" />
            <x-info-title-value item-title="Total Delete Colaboradores" :item-value="$data['total_colaborators_deleted']" />
            <x-info-title-value item-title="Total Salary" :item-value="$data['total_salary']" />
        </div> --}}

        <div class="row g-3">
            <div class="col-md-4">
                <x-info-title-value item-title="Total Colaboradores" :item-value="$data['total_colaborators']" />
            </div>
            <div class="col-md-4">
                <x-info-title-value item-title="Total Delete Colaboradores" :item-value="$data['total_colaborators_deleted']" />
            </div>
            <div class="col-md-4">
                <x-info-title-value item-title="Total Salary" :item-value="$data['total_salary']" />
            </div>
        </div>

        <hr>

        <div class="d-flex">
            <x-info-title-collection item-title="Colaborators by Department" :collection="$data['total_colaborators_per_department']" />
            <x-info-title-collection item-title="Total Salary by Department" :collection="$data['total_salary_by_department']" />

        </div>

    </div>

</x-layout-app>
