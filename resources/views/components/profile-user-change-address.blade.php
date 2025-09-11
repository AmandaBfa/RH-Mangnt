<div class="col-5">
    <div class="border p-5 shadow-sm">
        <form action="{{ route('user.profile.update-user-address') }}" method="post">

            @csrf

            <h3>Change user address</h3>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address" class="form-control"
                    value="{{ old('address', $colaborator->detail->address) }}">
                @error('address')
                    <div class="text-danger mt-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex gap-3">
                <div class="mb-3">
                    <label for="zip_code" class="form-label">Zip code</label>
                    <input type="text" name="zip_code" id="zip_code" class="form-control"
                        value="{{ old('zip_code', $colaborator->detail->zip_code) }}">
                    @error('zip_code')
                        <div class="text-danger mt-3">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" name="city" id="city" class="form-control"
                        value="{{ old('city', $colaborator->detail->city) }}">
                    @error('city')
                        <div class="text-danger mt-3">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control"
                    value="{{ old('phone', $colaborator->detail->phone) }}">
                @error('phone')
                    <div class="text-danger mt-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update user address</button>
            </div>

        </form>

        @if (session('success_change_address'))
            <div class="alert alert-success mt-3">
                {{ session('success_change_address') }}
            </div>
        @endif

    </div>
</div>

<script>
    // CEP -> 9999-999
    document.getElementById("zip_code").addEventListener("input", function(e) {
        let v = e.target.value.replace(/\D/g, "");
        if (v.length > 4) {
            e.target.value = v.substring(0, 4) + "-" + v.substring(4, 7);
        } else {
            e.target.value = v;
        }
    });

    // Telefone -> (99) 99999-9999
    // ESSE JS É APENAS PARA BRINCAR COM MÁSCARAS, CURIOSIDADE APENAS - NÃO É OBRIGATÓRIO
    document.getElementById("phone").addEventListener("input", function(e) {
        let v = e.target.value.replace(/\D/g, "");
        if (v.length > 10) {
            e.target.value = "(" + v.substring(0, 2) + ") " + v.substring(2, 7) + "-" + v.substring(7, 11);
        } else if (v.length > 6) {
            e.target.value = "(" + v.substring(0, 2) + ") " + v.substring(2, 6) + "-" + v.substring(6);
        } else if (v.length > 2) {
            e.target.value = "(" + v.substring(0, 2) + ") " + v.substring(2);
        } else {
            e.target.value = v;
        }
    });
</script>
