<x-layout-app page-title="Edit Colaborator">

    <div class="w-100 p-4">

        <h3>Edit Colaborator</h3>
        <hr>

        <form action="#" method="post">

            @csrf

            <div class="d-flex gap-5 mt-4">
                <p>Colaborator name: <strong>{{ $colaborator->name }}</strong></p>
                <p>Colaborator email: <strong>{{ $colaborator->email }}</strong></p>
            </div>

            <hr>

            <input type="hidden" name="user_id" value="{{ $colaborator->id }}"> {{-- hidden field to identify the colaborator being edited --}}

            {{-- user --}}
            <div class="container-fluid">
                <div class="row gap-3">
                    <div class="col border border-black p-4">

                        <div class="col">
                            <div class="mb-3">
                                <label for="salary" class="form-label">Salary</label>
                                <input type="number" class="form-control" id="salary" name="salary" step=".01"
                                    placeholder="0,00" value="{{ old('salary', $colaborator->detail->salary) }}">
                                @error('salary')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label for="admission_date" class="form-label">Admission Date</label>
                                <input type="text" class="form-control" id="admission_date" name="admission_date"
                                    placeholder="YYYY-mm-dd"
                                    value="{{ old('admission_date', $colaborator->detail->admission_date) }}">
                                @error('admission_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label for="select_department">Department</label>
                                <select name="select_department" id="select_department" class="form-select">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ $colaborator->department_id == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                        {{-- isso é um colaborador ternario, que significa que "se o colaborador que estamos a editar, no seu departamento id, e o departamento id for igual ao departamento id que estamos a tenta colocar na opção, então vamos apresentar aqui um select. Porque ele vai automaticamente no nosso select ficar com aquela opção selecionada, isto é, se ele pertece ao departamento do aramazem, então quando estivermos aqui a adicionar o armazem, ele vai ficar como selecionado e assim sempre vai apresentar qual é o departamento no qual ao qual nosso colaborador pertence. Depois apresenta o department name" --}}
                                        {{-- Esse trecho monta um <select> de departamentos, e marca automaticamente o departamento ao qual o colaborador já pertence. --}}
                                    @endforeach
                                </select>
                                @error('select_department')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('rh.management.home') }}" class="btn btn-outline-danger me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update colaborator</button>
                </div>
            </div>
        </form>

    </div>

    </div>

</x-layout-app>
