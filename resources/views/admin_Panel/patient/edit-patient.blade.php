@extends('admin_Panel.layout.main')
@section('Main-container')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Edit Patient</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" value="Terry">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" type="text" value="Baker">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Username <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" value="terrybaker">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input class="form-control" type="email" value="terrybaker@example.com">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="form-control" type="password">
                                </div>
                            </div>
							<div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
								<div class="form-group gender-select">
									<label class="gen-label">Gender:</label>
									<div class="form-check-inline">
										<label class="form-check-label">
											<input type="radio" name="gender" class="form-check-input" checked>Male
										</label>
									</div>
									<div class="form-check-inline">
										<label class="form-check-label">
											<input type="radio" name="gender" class="form-check-input">Female
										</label>
									</div>
								</div>
                            </div>
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Address</label>
											<input type="text" class="form-control" value="555 Front St #APT 2H, Hempstead">
										</div>
									</div>
									<div class="col-sm-6 col-md-6 col-lg-3">
										<div class="form-group">
											<label>Country</label>
											<select class="form-control select">
												<option selected>USA</option>
												<option>United Kingdom</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6 col-md-6 col-lg-3">
										<div class="form-group">
											<label>City</label>
											<input type="text" class="form-control">
										</div>
									</div>
									<div class="col-sm-6 col-md-6 col-lg-3">
										<div class="form-group">
											<label>State/Province</label>
											<select class="form-control select">
												<option>California</option>
												<option>Alaska</option>
												<option>Alabama</option>
												<option class="selected">New York</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6 col-md-6 col-lg-3">
										<div class="form-group">
											<label>Postal Code</label>
											<input type="text" class="form-control" value="11550">
										</div>
									</div>
								</div>
							</div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone </label>
                                    <input class="form-control" type="text" value="3761506975">
                                </div>
                            </div>
                            <div class="col-sm-6">
								<div class="form-group">
									<label>Avatar</label>
									<div class="profile-upload">
										<div class="upload-img">
											<img alt="" src="assets/img/user.jpg">
										</div>
										<div class="upload-input">
											<input type="file" class="form-control">
										</div>
									</div>
								</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="display-block">Status</label>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="status" id="product_active" value="option1" checked>
								<label class="form-check-label" for="product_active">
								Active
								</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="status" id="product_inactive" value="option2">
								<label class="form-check-label" for="product_inactive">
								Inactive
								</label>
							</div>
                        </div>
                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection