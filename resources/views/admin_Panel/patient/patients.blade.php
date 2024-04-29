@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
        	<div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-sm-6 text-right">
					<a class="btn btn-danger btn-rounded" href="{{ route('admin.dashboard')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>

			<div class="row">
				<div class="col-md-12">
					<div class="mb-2 d-flex justify-content-between">
				      <h6 style="font-weight: 400; font-size: 1.3rem;">Patients List</h6>
				      <div class="input-group" style="max-width: 300px;">
				        <input
				          type="text"
				          class="form-control"
				          placeholder="Search by name, email, or address..."
				          aria-label="Search"
				          id="tableSearchInput"
				        />
				        <div class="input-group-append">
				          <button class="btn btn-primary" type="button" id="tableSearchButton">Search</button>
				        </div>
				      </div>
				    </div>
					<div class="table-responsive">
						<table class="table table-border table-striped custom-table datatable mb-0">
							<thead>
								<tr>
									<th>Sno.</th>
									<th>Name</th>
									<th>Age</th>
									<th>Address</th>
									<th>Phone</th>
									<th>Email</th>
								</tr>
							</thead>
							<tbody>
								@foreach($patients as $patient)
								<tr>
									<td>{{ $loop->index + $patients->firstItem() }}</td>
									<td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> {{ $patient->fullname }}</td>
									<td>{{ $patient->age }} years</td>
									<td>{{ $patient->permanent_address }}</td>
									<td>{{ $patient->phone }}</td>
									<td>{{ $patient->email }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="d-flex justify-content-center mt-3">
						{{ $patients->links() }}
					</div>
				</div>
            </div>
        </div>
    </div>
	<div id="delete_patient" class="modal fade delete-modal" role="dialog">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body text-center">
					<img src="assets/img/sent.png" alt="" width="50" height="46">
					<h3>Are you sure want to delete this Patient?</h3>
					<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
						<button type="submit" class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
@endsection