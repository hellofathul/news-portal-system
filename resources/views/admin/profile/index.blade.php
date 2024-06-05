@extends("admin.layouts.master")

@section("content")
<section class="section">
    <div class="section-header">
        <h1>{{__("Profile")}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{__("Dashboard")}}</a></div>
            <div class="breadcrumb-item">{{__("Profile")}}</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Hi, Ujang!</h2>
        <p class="section-lead">
            {{__("Change information about yourself on this page")}}.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-6">
                <div class="card">
                    <form method="post" class="needs-validation" novalidate="">
                        <div class="card-header">
                            <h4>{{__("Edit Profile")}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>{{__("Upload Image")}}</label>
                                    <div id="image-preview" class="image-preview" style="width: 100%;">
                                        <label for="image-upload" id="image-label">{{__("Choose File")}}</label>
                                        <input type="file" name="image" id="image-upload" />
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__("Name")}}</label>
                                    <input type="text" class="form-control" required="" value="{{ $user->name }}">
                                    <div class="invalid-feedback">
                                        {{__("Please fill in the first name")}}
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__("Email")}}</label>
                                    <input type="text" class="form-control" required="" value="{{ $user->email }}">
                                    <div class="invalid-feedback">
                                        {{__("Please fill in the email")}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">{{__("Save Changes")}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <form method="post" class="needs-validation" novalidate="">
                        <div class="card-header">
                            <h4>{{__("Update Password")}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>{{__("Old Password")}}</label>
                                    <input type="text" class="form-control" required="" value="{{ $user->name }}">
                                    <div class="invalid-feedback">
                                        {{__("Please fill in the first name")}}
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__("New Password")}}</label>
                                    <input type="text" class="form-control" required="" value="{{ $user->email }}">
                                    <div class="invalid-feedback">
                                        {{__("Please fill in the email")}}
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__("Password Confirmation")}}</label>
                                    <input type="text" class="form-control" required="" value="{{ $user->email }}">
                                    <div class="invalid-feedback">
                                        {{__("Please fill in the email")}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">{{__("Save Changes")}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection