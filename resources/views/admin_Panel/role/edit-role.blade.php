@extends('admin_Panel.layout.main')
@section('Main-container')
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content">
                <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                    <div class="col-sm-6">
                        {{ Breadcrumbs::render() }}
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('role.index') }}" class="btn btn-danger btn-rounded"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="POST" action="{{ route('role.update',['role'=> $role->id])}}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Role Name <span class="text-danger">*</span></label>
                                        <input class="form-control" name="name" value="{{ $role->name }}" type="text">
                                    </div>
                                    @php
                                    $modules = [
                                        ['name' => 'Role Module', 'permissions' => $permissions->skip(24)->take(4)],
                                        ['name' => 'User Module', 'permissions' => $permissions->take(4)],
                                        ['name' => 'Department Module', 'permissions' => $permissions->skip(4)->take(4)],
                                        ['name' => 'Doctor Module', 'permissions' => $permissions->skip(8)->take(4)],
                                        ['name' => 'Schedule Module', 'permissions' => $permissions->skip(12)->take(4)],
                                        ['name' => 'Patient Module', 'permissions' => $permissions->skip(16)->take(4)],
                                        ['name' => 'Appointment Module', 'permissions' => $permissions->skip(20)->take(4)],
                                    ];
                                    @endphp
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>Choose Permissions<span class="text-danger">*</span></p>
                                            <div class="row mb-4 border-bottom">
                                                <div class="col-lg-6">
                                                    <h5>Module Access</h5>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h5>Permission Options</h5>
                                                </div>
                                            </div>
                                            @foreach($modules as $moduleIndex => $module)
                                            <div class="row mb-5">
                                                <!-- Module Name-->
                                                <div class="col-lg-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="toggle-switch">
                                                            <input type="checkbox"
                                                                id="module_toggle_{{ $moduleIndex }}"
                                                                data-module-toggle="{{ $moduleIndex }}"
                                                            >
                                                            <label for="module_toggle_{{ $moduleIndex }}"></label>
                                                        </div>
                                                        <p class="ml-3 permission_name text-primary" style="font-weight: 400;">{{ $module['name'] }}</p>
                                                    </div>
                                                </div>

                                                <!-- Permission Options -->
                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        @foreach($module['permissions'] as $permission)
                                                        <div class="col-lg-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="toggle-switch">
                                                                    <input type="checkbox"
                                                                        name="permission[]"
                                                                        value="{{ $permission->id }}"
                                                                        class="permission-checkbox module-{{ $moduleIndex }}"
                                                                        data-module="{{ $moduleIndex }}"
                                                                        id="permission_{{ $permission->id }}"
                                                                        {{ in_array($permission->id, $rolePermissions->pluck('id')->toArray()) ? 'checked' : '' }}
                                                                    >
                                                                    <label for="permission_{{ $permission->id }}"></label>
                                                                </div>
                                                                <p class="ml-3 permission_name">{{ $permission->name }}</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-lg-12">
                                            <p>Choose Permissions<span class="text-danger">*</span></p>
                                            <div class="row mb-5">
                                                <div class="col-lg-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="toggle-switch">
                                                            <input type="checkbox" id="user_module_toggle">
                                                            <label for="user_module_toggle"></label>
                                                        </div>
                                                        <p class="ml-3 permission_name">User Module</p>
                                                    </div>
                                                </div>

                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        @foreach($permissions->take(4) as $permission)
                                                        <div class="col-lg-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="toggle-switch">
                                                                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}" class="permission-checkbox" id="permission_{{ $permission->id }}">
                                                                    <label for="permission_{{ $permission->id }}"></label>
                                                                </div>
                                                                <p class="ml-3 permission_name">{{ $permission->name }}</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-5">
                                                <div class="col-lg-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="toggle-switch">
                                                            <input type="checkbox" id="doctor_permission">
                                                            <label for="doctor_permission"></label>
                                                        </div>
                                                        <p class="ml-3 permission_name">Department Module</p>
                                                    </div>
                                                </div>

                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        @foreach($permissions->skip(4)->take(4) as $permission)
                                                        <div class="col-lg-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="toggle-switch">
                                                                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                                                                    <label for="permission_{{ $permission->id }}"></label>
                                                                </div>
                                                                <p class="ml-3 permission_name">{{ $permission->name }}</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-5">
                                                <div class="col-lg-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="toggle-switch">
                                                            <input type="checkbox" id="doctor_permission">
                                                            <label for="doctor_permission"></label>
                                                        </div>
                                                        <p class="ml-3 permission_name">Doctor Module</p>
                                                    </div>
                                                </div>

                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        @foreach($permissions->skip(8)->take(4) as $permission)
                                                        <div class="col-lg-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="toggle-switch">
                                                                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                                                                    <label for="permission_{{ $permission->id }}"></label>
                                                                </div>
                                                                <p class="ml-3 permission_name">{{ $permission->name }}</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-5">
                                                <div class="col-lg-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="toggle-switch">
                                                            <input type="checkbox" id="doctor_permission">
                                                            <label for="doctor_permission"></label>
                                                        </div>
                                                        <p class="ml-3 permission_name">Schedule Module</p>
                                                    </div>
                                                </div>


                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        @foreach($permissions->skip(12)->take(4) as $permission)
                                                        <div class="col-lg-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="toggle-switch">
                                                                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                                                                    <label for="permission_{{ $permission->id }}"></label>
                                                                </div>
                                                                <p class="ml-3 permission_name">{{ $permission->name }}</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-5">
                                                <div class="col-lg-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="toggle-switch">
                                                            <input type="checkbox" id="doctor_permission">
                                                            <label for="doctor_permission"></label>
                                                        </div>
                                                        <p class="ml-3 permission_name">Patient Module</p>
                                                    </div>
                                                </div>


                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        @foreach($permissions->skip(16)->take(4) as $permission)
                                                        <div class="col-lg-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="toggle-switch">
                                                                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                                                                    <label for="permission_{{ $permission->id }}"></label>
                                                                </div>
                                                                <p class="ml-3 permission_name">{{ $permission->name }}</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-5">
                                                <div class="col-lg-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="toggle-switch">
                                                            <input type="checkbox" id="doctor_permission">
                                                            <label for="doctor_permission"></label>
                                                        </div>
                                                        <p class="ml-3 permission_name">Appointment Module</p>
                                                    </div>
                                                </div>


                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        @foreach($permissions->skip(20)->take(4) as $permission)
                                                        <div class="col-lg-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="toggle-switch">
                                                                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                                                                    <label for="permission_{{ $permission->id }}"></label>
                                                                </div>
                                                                <p class="ml-3 permission_name">{{ $permission->name }}</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary submit-btn">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // Function to check if all permissions in a module are checked
        function allPermissionsChecked(moduleIndex) {
          const permissions = $(`.permission-checkbox[data-module="${moduleIndex}"]`);
          return permissions.length === permissions.filter(":checked").length;
        }

        // When a module toggle changes, set all permissions in that module
        $("[data-module-toggle]").on("change", function () {
          const moduleIndex = $(this).data("module-toggle");
          const isChecked = $(this).is(":checked");

          // Set all permission checkboxes in the same module
          $(`.permission-checkbox[data-module="${moduleIndex}"]`).prop("checked", isChecked);
        });

        // When a permission checkbox changes, update the related module toggle
        $(".permission-checkbox").on("change", function () {
          const moduleIndex = $(this).data("module");
          const moduleToggle = $(`[data-module-toggle="${moduleIndex}"]`);

          // Set the module toggle based on whether all permissions are checked
          const allChecked = allPermissionsChecked(moduleIndex);
          moduleToggle.prop("checked", allChecked);
        });


        // $("#user_module_toggle").on("change", function () {
        //   const isChecked = $(this).is(":checked");

        //   $(".permission-checkbox").prop("checked", isChecked);
        // });
        // $(".permission-checkbox").on("change", function () {
        // //gets the total number of permission checkboxes & gets the number of checked permission checkboxes
        //   const allChecked = $(".permission-checkbox").length === $(".permission-checkbox:checked").length;

        // // If all permission checkboxes are checked, check the User Module toggle
        //   $("#user_module_toggle").prop("checked", allChecked);
        // });
    </script>
@endsection