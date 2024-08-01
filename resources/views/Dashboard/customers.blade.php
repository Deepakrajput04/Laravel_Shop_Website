<x-adminheader/>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <p class="card-title mb-0">our Customers</p>
             
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>#.</th>
                          <th>Full Name</th>
                          <th>Picture</th>
                          <th>Email</th>
                          <th>Type</th>
                          <th>Registration Date</th>
                          <th>Action</th>
                        </tr>  
                      </thead>
                      <tbody>
                        @php 
                          $i=0;
                        @endphp
                      @foreach ($customers as $item)
                        @php 
                          $i++;
                        @endphp
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ $item->fullname }}</td>
                          <td><img src="{{ asset('uploads/profiles/' . $item->picture) }}" width="100px" alt=""></td>
                          <td>{{ $item->email }}</td>
                          <td class="font-weight-bold">{{ $item->type }}</td>
                          <td>{{ $item->created_at }}</div></td>
                          <td>
                            <a href="{{ URL::to('deleteProduct/'.$item->id) }}" class="btn btn-danger">Delete</a>
                          </td>
                        </tr>
                        @endforeach
                 </tbody>
               </table>
              </div>
            </div>
           
          </div>
       </div> 
     </div>
</div>
         
      <x-adminfooter />