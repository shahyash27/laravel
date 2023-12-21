<x-app-layout>
	<div class="min-h-screen flex flex-col sm:justiy-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

    <h1 class="text-lg font-bold">Tickets</h1>
    <x-nav-link class="" href="{{route('ticket.create')}}">Create New Ticket</x-primary-button>
    <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hiddensm:round-lg">

	<table style="border: 2px solid black" cellpadding="15">
		<thead style="border: 2px solid black">
			<tr>
				<td>ID</td>
				<td>Title</td>
				<td>Description</td>
				<td>Action</td>
			</tr>
		</thead>

		<tbody style="border: 2px solid black;" >
			@if (!empty($tickets))
				@foreach($tickets as $ticket) 
					<tr style="border: 2px solid black;padding: 20px">
						<td><a href="{{route('ticket.show',$ticket->id)}}"><?= $ticket->id ?></a></td>
						<td><a href="{{route('ticket.show',$ticket->id)}}"><?= $ticket->title ?></a></td>
						<td><?= $ticket->description ?></td>
						<td>
							<div class="flex">
								<x-nav-link href="{{route('ticket.edit',$ticket->id)}}">
									<x-primary-button class="ml-2">Edit</x-primary-button>
								</x-nav-link>
								<form class="ml-2" action="{{route('ticket.destroy',$ticket->id)}}" method="post">
									@csrf
									@method('delete')
									<x-primary-button>Delete</x-primary-button>
								</form>
							</div>
						</td>
					</tr>
				@endforeach
			 @else
				<tr>
					<td>No tickets found</td>
				</tr>
			@endif

		</tbody>
	</table>
</div>
</div>
</x-app-layout>