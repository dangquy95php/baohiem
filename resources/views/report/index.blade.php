@section('title','Báo cáo cuộc gọi khách hàng')
@extends('layouts.template')

@section('breadcrumb')

   <h1>BÁO CÁO CUỘC GỌI KHÁCH HÀNG HÔM NAY</h1>

   {{ Breadcrumbs::render('report') }}

@endsection

@section('content')

<section class="section">
   <div class="row">
      <div class="col-lg-8">
         <div class="card">
            <div class="card-body table-responsive pt-3">
               <form action="" method="get">
                  <div class="row">
                     <div class="col-sm-3">
                        <select name="type" class="form-select" aria-label="Default select example">
                           <option {{ Request::get('type') == 'today' ? 'selected' : '' }} value="today">Hôm nay</option>
                           <option {{ Request::get('type') == '7_days_ago' ? 'selected' : '' }} value="7_days_ago">7 ngày trước</option>
                           <option {{ Request::get('type') == '1_month_ago' ? 'selected' : '' }} value="1_month_ago">1 tháng trước</option>
                        </select>
                     </div>
                     <button type="submit" class="btn btn-primary col-sm-2">Tìm kiếm</button>
                  </div>
               </form>

               <!-- Table with stripped rows -->
               <table data-toggle="table" class="table table-striped">
                  <thead>
                     <tr>
                     <th scope="col">#</th>
                     <th scope="col">Nhân Viên</th>
                     <th class="text-center" scope="col">Tổng Cuộc Gọi</th>
                     <th class="text-center" scope="col">Tổng Cuộc Gọi Đã Hẹn</th>
                     </tr>
                  </thead>
                  <tbody>
                    @php
                    $i = count($listCallOfStaff);
                     @endphp
                    @foreach($listCallOfStaff as $user)
                        @if($user->username != 'dangquy')
                            <tr>
                                <th scope="row">{{ $i }}</th>
                            <td>{{ $user->name ?: $user->username }}</td>
                            <td class="text-center">
                                 @if(Request::get('type') == 'today' || empty(Request::get('type')))
                                 <span class="badge bg-{{ count($user->customers_today_called) > 0 ? 'success' : 'secondary' }}">{{ count($user->customers_today_called) }}</span>
                                 @endif
                                 @if(Request::get('type') == '7_days_ago')
                                 <span class="badge bg-{{ count($user->customers_7_days_ago_called) > 0 ? 'success' : 'secondary' }}">{{ count($user->customers_7_days_ago_called) }}</span>
                                 @endif
                                 @if(Request::get('type') == '1_month_ago')
                                 <span class="badge bg-{{ count($user->customers_1_month_ago_called) > 0 ? 'success' : 'secondary' }}">{{ count($user->customers_1_month_ago_called) }}</span>
                                 @endif
                                </td>
                            <td class="text-center">
                                 @if(Request::get('type') == 'today' || empty(Request::get('type')))
                                    <span class="badge bg-{{ $user->customers_today_called->where('type_call', 0)->count() > 0 ? 'primary' : 'secondary' }}">{{ $user->customers_today_called->where('type_call', 0)->count() }}</span>
                                 @endif
                                 @if(Request::get('type') == '7_days_ago')
                                    <span class="badge bg-{{ $user->customers_7_days_ago_called->where('type_call', 0)->count() > 0 ? 'primary' : 'secondary' }}">{{ $user->customers_7_days_ago_called->where('type_call', 0)->count() }}</span>
                                 @endif
                                 @if(Request::get('type') == '1_month_ago')
                                    <span class="badge bg-{{ $user->customers_1_month_ago_called->where('type_call', 0)->count() > 0 ? 'primary' : 'secondary' }}">{{ $user->customers_1_month_ago_called->where('type_call', 0)->count() }}</span>
                                 @endif
                                </td>
                            </tr>
                        @endif
                    @php
                    $i--;
                    @endphp
                    @endforeach
                  </tbody>
               </table>
               <!-- End Table with stripped rows -->
            </div>
         </div>
      </div>
   </div>
</section>

@endsection
