<x-app-layout>
	<div class="min-h-screen flex flex-col sm:justiy-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    <h1 class="text-lg font-bold">Ticket #<?= $ticket->id ?> </h1>
    <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hiddensm:round-lg">

			@if (!empty($ticket))
				<div>
					ID : <?= $ticket->id ?>
					<br>
					
					Title : <?= $ticket->title ?>
					<br>
					
					Description : <?= $ticket->description ?>
					<br>
					
					@if (!empty($ticket->attachment))
						<img src="{{'/storage/'.$ticket->attachment}}" height="50" width="50">
					@else
						No attachment
					@endif
					<br>

					Created At : <?= $ticket->created_at->diffForHumans(); ?>
					<br>
					
					Updated At : <?= $ticket->updated_at->diffForHumans(); ?>
					<br>

					<div class="flex justiy-between">
						<div class="flex pt-6">
							<x-nav-link href="{{route('ticket.edit',$ticket->id)}}">
								<x-primary-button class="ml-2">Edit</x-primary-button>
							</x-nav-link>
							<form class="ml-2" action="{{route('ticket.destroy',$ticket->id)}}" method="post">
								@csrf
								@method('delete')
								<x-primary-button>Delete</x-primary-button>
							</form>
						</div>
						@if (auth()->user()->isAdmin) 
							<div class="flex pt-6">
								<form class="ml-2" action="{{route('ticket.update',$ticket->id)}}" method="post">
									@csrf
									@method('patch')
									<input type="hidden" name="status" value="resolved">
									<x-primary-button class="ml-2">Appprove</x-primary-button>
								</form>
								<form class="ml-2" action="{{route('ticket.update',$ticket->id)}}" method="post">
									@csrf
									@method('patch')
									<input type="hidden" name="status" value="rejected">
									<x-primary-button class="ml-2">Reject</x-primary-button>
								</form>
							</div>
						@else
							Status : {{$ticket->status}}
						@endif
					</div>
				</div>
			 @else
				No ticket found
			@endif
</div>
<x-nav-link href="{{route('ticket.index')}}"><--Back</x-nav-link>
</div>
</x-app-layout>