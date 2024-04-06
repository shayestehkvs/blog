@component('admin.layout.content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit user</h4>
                <form class="form-inline" method="post" action="{{ route('update-user', $category->id) }}">
                    @csrf
                    @method('PUT')
                    <label class="sr-only" for="inlineFormInputName2">User name</label>
                    <input type="text" name="userName" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" value="{{ old('userName', $user->userName) }}"  placeholder="User name">
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endcomponent
