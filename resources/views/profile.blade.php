<x-header />
    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="section-title">
                        <h2>My Account</h2>
                    </div>
                    <div class="contact__form">
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
                                    <input type="text" name="fullname" placeholder="Name" value="{{$user->fullname}}" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="email" placeholder="Email" value="{{$user->email}}" readonly required>
                                </div>
                                <div class="col-lg-12">
                                    <input type="file" name="file">
                                </div>
                                <div class="col-lg-12">
                                    <input type="password" name="password" value="{{$user->password}} placeholder="Password" required>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" name="register" class="site-btn">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Footer Section Begin -->
    <x-footer />