
@component('admin.layout.content')
    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" ></script>
        <script>
            $('#cpf').validate({
                rules: {
                    name : "required"
                },
                messages: {
                    name: "Please enter role name"
                }
            })

        </script>
    @endsection

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('admin.layout.errors')
                <h4 class="card-title">Create role</h4>
                <form id="cpf" class="form-inline" method="post" action="{{ route('update-role', $role->id) }}">
                    @csrf
                    @method('PUT')
                    <label class="sr-only" for="name">Role name</label>
                    <input type="text" id="name" name="name" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;"  value="{{ old('name', $role->name) }}">
                    <label class="sr-only" for="label">Role label</label>
                    <input type="text" id="label" name="label" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" value="{{ old('label', $role->label) }}">
                    <label class="sr-only" for="permissions">Role label</label>
                    <select name="permissions[]" id="permission" class="form-control" multiple style="background-color: white !important; color: #0a0a0a !important;" placeholder="Permission name">
                        @foreach($permissions as $permission)
                            <option value="{{ $permission->id }}" {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'selected' : '' }} >{{$permission->name}} - {{ $permission->label }}</option>
                        @endforeach
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endcomponent
