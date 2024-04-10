
@component('admin.layout.content')
    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" ></script>
        <script>
            $('#cpf').validate({
                rules: {
                    name : "required"
                },
                messages: {
                    name: "Please enter permission name"
                }
            })

        </script>
    @endsection

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('admin.layout.errors')
                <h4 class="card-title">Create permission</h4>
                <form id="cpf" class="form-inline" method="post" action="{{ route('store-permission') }}">
                    @csrf
                    <label class="sr-only" for="inlineFormInputName2">Permission name</label>
                    <input type="text" id="name" name="name" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" placeholder="Permission name">
                    <label class="sr-only" for="inlineFormInputName2">Permission label</label>
                    <input type="text" id="label" name="label" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" placeholder="Permission name">
                    <br>
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endcomponent
