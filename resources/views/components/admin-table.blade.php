@props(['headings', 'rows'])

<div class="overflow-x-auto rounded-lg border border-base-content/5 bg-gray-900">
    <table class="table text-white w-full">

        <thead class="bg-gray-800 text-gray-200">
        <tr>
            <th class="px-4 py-3 text-left">#</th>
            @foreach ($headings as $heading)
                <th class="px-4 py-3 text-left">{{ $heading }}</th>
            @endforeach
        </tr>
        </thead>

        <tbody>
        @foreach ($rows as $index => $row)
            <tr class="hover:bg-gray-800 transition">
                <th class="px-4 py-3 font-normal">{{ $index + 1 }}</th>
                @foreach ($row as $cell)
                    <td class="px-4 py-3">{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


