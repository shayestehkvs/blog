
@component('admin.layout.content')
    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" ></script>
        <script>
            $(document).ready(function() {
                $('#permission').select2({
                    'placeholder' : 'please select some permission'
                });
                $('#role').select2({
                    'placeholder' : 'please select some permission'
                });
            });
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
                <h4 class="card-title">User Permission and role</h4>
                <form id="cpf" class="form-inline" method="post" action="{{ route('user.permissions.store', $user->id) }}">
                    @csrf

                    <label class="sr-only" for="role">Role label</label>
                    <select name="roles[]" id="role" class="form-control" multiple style="background-color: white !important; color: #0a0a0a !important;" placeholder="Role">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }} >{{$role->name}} - {{ $role->label }}</option>
                        @endforeach
                    </select>
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
