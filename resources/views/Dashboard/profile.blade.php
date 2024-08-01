<x-adminheader/>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mx-auto grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <p class="card-title mb-0">My Profile</p>
                          @if(session()->has('success'))
                              <div class="alert alert-success">
                                  <p>{{ session('success') }}</p>
                              </div>
                          @endif
                        <img src="{{ asset('uploads/profiles/'.$user->picture) }}" class="mx-auto d-block" width="200px" alt="">
                        <form action="{{ URL::to('updateUser') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="fullname" placeholder="Name" class="form-control mb-2" value="{{$user->fullname}}" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="email" placeholder="Email" class="form-control mb-2" value="{{$user->email}}" readonly required>
                                </div>
                                <div class="col-lg-12">
                                    <input type="file" name="file" class="form-control mb-2">
                                </div>
                                <div class="col-lg-12">
                                    <input type="password" name="password" class="form-control mb-2" value="{{$user->password}} placeholder="Password" required>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" name="register" class="btn btn-info">Save Changes</button>
                                </div>
                            </div>
                        </form>
            </div>       
          </div>
        </div>
         
      <x-adminfooter />