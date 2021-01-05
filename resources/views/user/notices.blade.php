<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
<title>Better Call Doc</title>
@include('layout.navbar')
    <table class="border-collapse w-full">
        <thead>
            <tr>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Date</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Notice</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Posted By</th>
            </tr>
        </thead>
        <tbody>
        @forelse($notice as $noti){ 
                <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Total</span>
                        {{ $noti->created_at }}
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Transaction</span>
                        {{ $noti->details }}
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Date</span>
                        {{ $noti->posted_by }}
                    </td>
                </tr>
                @empty
                                No appoinment available...
                            @endforelse
        </tbody>
    </table>

    <!-- <script type="text/javascript" src="Navbar.js"></script> -->

</body>

</html>