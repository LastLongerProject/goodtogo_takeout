@extends('partials/backstage')
@section('title','店鋪清單')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">
            @forelse($lists as $list)
			<a href="{{ Route('main',['slug' => $list->slug ]) }}"><button class="gtg-button button-small">{{ $list->name }}</button></a>
			@empty
		    <h2>沒有店家</h2>
            @endforelse
		</div>
	</div>
</div>
@stop