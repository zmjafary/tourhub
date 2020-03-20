<div class="col-md-12">
    @if(\Session::has('success'))
        <div class="alert alert-success">
            {{\Session::get('success')}}
        </div>
    @endif  

    <div class="card">              
        <div class="card-header">
          <strong> Admin Dashboard </strong>
        </div>
                        
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header"> Manage Users </div>

                <div class="card-body">
                    @if(count($profiles) > 0)
                        <table class="table table-bordered table-hover table-responsive-lg table-responsive-md table-responsive-sm">
                          <thead>
                            <tr style="text-align:center;">
                              <th class="align-middle" scope="col">Display</th>
                              <th class="align-middle" scope="col">Username</th>
                              <th class="align-middle" scope="col">Name</th>
                              <th class="align-middle" scope="col">Email</th>
                              <th class="align-middle" scope="col">Phone Number</th>
                              <th class="align-middle" scope="col">Gender</th>
                              <th class="align-middle" scope="col">DOB</th>
                              <th class="align-middle" scope="col">About</th>
                              <th class="align-middle" scope="col">Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($profiles as $user)
                              <tr style="text-align:center;">
                                  <td class="align-middle">
                                    <img src="{{ $user->display }}" alt="user-display" height="50px" width="50px" class="rounded-circle">
                                  </td>
                                  <td class="align-middle">{{ $user->username }}</td>
                                  <td class="align-middle">{{ $user->name }}</td>
                                  <td class="align-middle">{{ $user->email }}</td>
                                  <td class="align-middle">{{ $user->phone_no }}</td>
                                  <td class="align-middle">
                                    @if(isset($user->profile->gender))
                                      @if($user->profile->gender == 'M')
                                        Male
                                      @elseif($user->profile->gender == 'F')
                                        Female
                                      @endif
                                    @endif
                                  </td>
                                  <td class="align-middle">
                                    @if(isset($user->profile->dob))
                                      {{ $user->profile->dob->format('Y-m-d') }}
                                    @endif
                                  </td>
                                  <td class="align-middle">
                                    @if(isset($user->profile->about))
                                      {{ $user->profile->about }}</td>
                                    @endif
                                  <td class="align-middle">
                                  @if($user->status == "Unapproved")
                                    <a class="btn btn-info" style="color:#ffffff;" href="{{ route('approve', $user->id) }}"> Approve </a>
                                  @else
                                    <a class="btn btn-secondary" href="{{ route('unApprove', $user->id) }}"> Unapprove </a>
                                  @endif
                                  </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                    @else
                        <h5> No profiles added yet. </h5> 
                    @endif
                </div>
            </div>

            <br>

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col text-left" style="padding-top: 10px;">
                            Manage Companies
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($companies) > 0)
                        <table class="table table-bordered table-hover table-responsive-lg table-responsive-md table-responsive-sm">
                          <thead>
                            <tr style="text-align:center;">
                              <th class="align-middle" scope="col">Display</th>
                              <th class="align-middle" scope="col">Username</th>
                              <th class="align-middle" scope="col">Name</th>
                              <th class="align-middle" scope="col">Email</th>
                              <th class="align-middle" scope="col">Phone Number</th>
                              <th class="align-middle" scope="col">Description</th>
                              <th class="align-middle" scope="col">Address</th>
                              <th class="align-middle" scope="col">Status</th>
                              <!-- <th class="align-middle" scope="col">Add User</th> -->
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($companies as $user)
                              <tr style="text-align:center;">
                                  <td class="align-middle">
                                    <img src="{{ $user->display }}" alt="company-display" height="50px" width="50px" class="rounded-circle">
                                  </td>
                                  <td class="align-middle">{{ $user->username }}</td>
                                  <td class="align-middle">{{ $user->name }}</td>
                                  <td class="align-middle">{{ $user->email }}</td>
                                  <td class="align-middle">{{ $user->phone_no }}</td>
                                  <td class="align-middle">
                                    @if(isset($user->company->description))
                                    {{ $user->company->description }}
                                    @endif
                                  </td>
                                  <td class="align-middle">
                                    @if(isset($user->company->address))
                                    {{ $user->company->address }}
                                    @endif
                                  </td>
                                  <td class="align-middle">
                                  @if($user->status == "Unapproved")
                                    <a class="btn btn-info" style="color:#ffffff;" href="{{ route('approve', $user->id) }}"> Approve </a>
                                  @else
                                    <a class="btn btn-secondary" href="{{ route('unApprove', $user->id) }}"> Unapprove </a>
                                  @endif
                                  </td>
<!--                                   <td class="align-middle">
                                    <a class="btn btn-outline-primary" href="{{ route('addUserToCompanyView', $user->id) }}"> Add User </a>
                                  </td> -->
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                    @else
                        <h5> No companies added yet. </h5> 
                    @endif                            
                </div>
            </div>
        </div>
    </div>
</div>