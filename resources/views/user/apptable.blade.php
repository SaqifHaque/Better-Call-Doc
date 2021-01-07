<title>Better Call Doc</title>
@include('layout.navbar')

    <table class="border-collapse w-full">
        <thead>
            <tr>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Date</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Time</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Status</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($app as $ap)
                <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Date</span>
                        {{ $ap->date }}
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Time</span>
                        {{ $ap->time }}
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Status</span>
                            @if($ap->status == "Pending")
                            <span class="rounded bg-yellow-200 py-1 px-3 text-xs font-bold">{{ $ap->status }}</span>
                                @elseif($ap->status == "Completed")
                                <span class="rounded bg-blue-400 py-1 px-3 text-xs font-bold">{{ $ap->status }}</span>
                                    @elseif($ap->status == "Accepted")
                                    <span class="rounded bg-green-400 py-1 px-3 text-xs font-bold">{{ $ap->status }}</span>
                                        @else 
                                        <span class="rounded bg-red-400 py-1 px-3 text-xs font-bold">{{ $ap->status }}</span>
                                        @endif

                    </td>

                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        @if($ap->status == "Completed") 
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                            @if($ap->prescription_id !== null)

                                <!-- <form method="GET" action="generate-pdf/{{ $ap->id }}">
                                @csrf
                                    <button type="submit" class="text-blue-400 hover:text-blue-600">Prescription</a>
                            </form> -->
                            <a href="generate-pdf/{{ $ap->prescription_id }}" class="rounded bg-green-400 block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900">Prescription</a>

                            @endif
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                        <a href="review/{{$ap->doctor_id}}" class="rounded bg-green-400 block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900">Review</a>
                        @endif
                        @if($ap->status == "Pending")
                            <form method="POST" action="cancel/{{ $ap->id }}">
                            @csrf
                                <button type="submit" class="text-red-400 hover:text-blue-600">Cancel</a>
                        </form>
                           @endif 
                    </td>
                </tr>
               @empty
                                No appoinment available...
                            @endforelse
        </tbody>
    </table>

</body>

</html>