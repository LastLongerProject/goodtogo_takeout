@extends('partials/app')
@section('title', '杯杯紀錄')
@section('content')
	<div class="container">
	<div class="row">
		
			  <table class="table table-responsive table-striped">
				  <thead>
				    <tr>
				      <th>代號</th>
				      <th>號碼</th>
				      <th>容量</th>
				      <th>顧客</th>
				      <th>狀態</th>
				      <th>時間</th>
				    </tr>
				  </thead>


				<tbody>
		@forelse($container as $c)
   			 <tr>
     				 	<th scope="row">{{ $c->id }}</th>
     				 	<td>{{ $c->number }}</td>
     				 	<td>{{ App\Models\Container_type::find($c->number)->decoration }}</td>
      					<td>{{ $c->customer_phone }}</td>
      					<td>@if($c->status == 0) 歸還 @else 借出 @endif</td>
      					<td>{{ Carbon\Carbon::parse($c->created_at)->format('m/d H:i') }}</td>
    			</tr>
		@empty
				   			 <tr>
				 	<th scope="row"></th>
     				 	<td></td>
     				 	<td></td>
     				 	<td></td>
     				 	<td>沒有資料</td>
     				 	<td></td>
     				 	<td></td>
     				 	<td></td>
    			</tr>
		    

    	@endforelse
  				</tbody>


			  </table>

	</div>
</div>

</div>
			
				<div class="container text-center">
					{{ $container->links() }}
				</div>
@stop