<section id="departments" class="departments">
      <div class="container">

        <div class="section-title">
          <h2>Departments</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row gy-4">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
              @foreach($departments as $department)
              <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" href="#tab-{{ $department->id }}" data-department-id="{{ $department->id }}">{{ $department->department_name }}</a>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="col-lg-9">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <div class="row gy-4">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Cardiology's Available Doctors</h3>

                    <div class="row" id="available-doctors">
                      @foreach($first_dept_doctors as $doctor)
                      <div class="col-md-4">
                        <div class="card bg-primary profile-card" data-doctor-id="{{ $doctor->id }}" style="cursor: pointer;">
                          <div class="profile-img">
                            <img src="{{ asset( $doctor->profile ) }}" alt="Profile Image">
                          </div>
                          <div class="profile-details">
                            <div class="profile-name">{{ $doctor->first_name }}{{ $doctor->middle_name }} {{ $doctor->last_name }}</div>
                            @foreach($doctor->educations as $education)
                            <div class="profile-specialization">{{ $education->specialization }}</div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Doctor Schedule Modal -->
          <div class="modal fade" id="doctorModal" tabindex="-1" aria-labelledby="doctorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="doctorModalLabel">Select Your Suitable Schedule</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div id="doctorSchedule">
                    <!-- Here doctor's schedules are displayed... -->
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </section>