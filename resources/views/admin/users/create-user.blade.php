@component('admin.layout.content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('admin.layout.errors')
                <h4 class="card-title">Create user</h4>
                <form class="form-inline" method="post" action="{{ route('store-user') }}">
                    @csrf
                    <label class="sr-only" for="name">User Name</label>
                    <input type="text" id="name" name="name" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" placeholder="Name">

                    <label class="sr-only" for="email">User Email</label>
                    <input type="email" id="email" name="email" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" placeholder="Email">

                    <label class="sr-only" for="phone">User Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" placeholder="Phone">

                    <label class="sr-only" for="address">User Address</label>
                    <input type="text" id="address" name="address" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" placeholder="Address">

                    <label class="sr-only" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" placeholder="Password">

                    <label class="sr-only" for="password_confirmation">Password Confirmation</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" placeholder="Password Confirmation">
                    <br>
                    <label class="sr-only" for="verify">User Verification</label>
                    <input type="checkbox" id="verify" name="verify" class="form-check-input mb-2 mr-sm-2" >
                    <br>
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endcomponent
