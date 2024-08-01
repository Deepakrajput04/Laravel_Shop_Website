 <x-adminheader/>
  
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <p class="card-title mb-0">our Orders</p>
             
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Customer</th>
                          <th>Email</th>
                          <th>Customer Status</th>
                          <th>Bill</th>
                          <th>Phone#</th>
                          <th>Address</th>
                          <th>Order Status</th>
                          <th>Order Date</th>
                          <th>Action</th>


                        </tr>  
                      </thead>
                      <tbody>
                        @php 
                          $i=0;
                        @endphp
                      @foreach ($orders as $item)
                        @php 
                          $i++;
                        @endphp
                        <tr>
                          <td>{{ $item->fullname }}</td>
                          <td>{{ $item->email }}</td>
                          <td class="text-info">{{ $item->status }}</td>
                          <td class="font-weight-bold">{{ $item->bill }}</td>
                          <td>{{ $item->phone }}</div></td>
                          <td>{{ $item->address }}</div></td>
                          <td class="font-weight-medium">
                            <div class="badge badge-success">{{$item->status}}</div>
                          </td>
                          <td class="font-weight-medium">
                            <div class="badge badge-info">{{$item->created_at}}</div>
                          </td>
                         
                          <td>
                            @if($item->status=='paid')
                            <a href="{{ URL::to('changreOrderStatus/Accepted/'.$item->id) }}" class="btn btn-success">Accept</a>
                            <a href="{{ URL::to('changreOrderStatus/Rejected/'.$item->id) }}" class="btn btn-danger">Reject</a>
                            @elseif($item->status=='Accepted')
                            <a href="{{ URL::to('changreOrderStatus/Delivered/'.$item->id) }}" class="btn btn-success">Completed</a>
                            @else
                            <a href="{{ URL::to('changreOrderStatus/Accepted/'.$item->id) }}" class="btn btn-success">Accepted</a>
                            @endif
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