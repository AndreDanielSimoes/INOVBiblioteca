<x-layout>
    <h1 class="font-bold text-4xl text-center">Add A New Book</h1>

    <div>
        <label class="font-semibold block mb-2">Search Google Books</label>
        <div class="flex gap-2">
            <input
                type="text"
                id="google-books-search"
                placeholder="Search by title..."
                class="w-full px-4 py-2 border border-gray-300 rounded text-black/70"
            >
            <button
                type="button"
                onclick="searchGoogleBooks()"
                class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded">
                Search
            </button>
        </div>
    </div>

    <div id="google-books-results" class="mt-6 space-y-4"></div>


    <x-forms.form method="POST" action="/books">
        <x-forms.input label="Title" name="title" placeholder="Book Title" />
        <x-forms.input label="Description" name="description" placeholder="Synopsis" />
        <x-forms.input label="Cover" name="cover" placeholder="Book Cover Image URL" />
        <x-forms.select-authors />
        <x-forms.select-publisher />
        <x-forms.input label="ISBN" name="isbn" placeholder="1234567890123"/>
        <x-forms.input label="Price" name="price" placeholder="10"/>
        <x-forms.select-tags />

        <x-forms.button>Add Book</x-forms.button>
    </x-forms.form>

    <script>
        async function searchGoogleBooks() {
            const query = document.getElementById('google-books-search').value;
            const resultsContainer = document.getElementById('google-books-results');
            resultsContainer.innerHTML = '<p class="text-gray-500">Searching...</p>';

            try {
                const response = await fetch(`https://www.googleapis.com/books/v1/volumes?q=intitle:${encodeURIComponent(query)}&key=AIzaSyDmcTBgsITeHjjvD-2LfxQH5UxQMMpnEiM`);
                const data = await response.json();
                resultsContainer.innerHTML = '';

                if (!data.items || data.items.length === 0) {
                    resultsContainer.innerHTML = '<p class="text-red-500">No results found.</p>';
                    return;
                }

                data.items.forEach(item => {
                    const info = item.volumeInfo;
                    const title = info.title || 'Unknown Title';
                    const description = info.description || 'No description available.';
                    const cover = info.imageLinks?.thumbnail || '';
                    const isbn = info.industryIdentifiers?.[0]?.identifier || '';
                    const author = info.authors?.[0] || 'Unknown';
                    const publisher = info.publisher || 'Unknown';

                    const card = document.createElement('div');
                    card.className = 'border border-white/10 p-4 rounded shadow bg-white/10 text-black space-y-2';

                    card.innerHTML = `
                <div class="text-white">
                    <h3 class="text-xl font-semibold">${title}</h3>
                    <p><strong>Author:</strong> ${author}</p>
                    <p><strong>Publisher:</strong> ${publisher}</p>
                    <p class="text-sm italic">${description.substring(0, 200)}...</p>
                </div>
                ${cover ? `<img src="${cover}" alt="${title} cover" class="w-24 h-auto">` : ''}
                <button
                    class="use-book-btn bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded mt-2"
                    data-title="${title.replace(/"/g, '&quot;')}"
                    data-description="${description.replace(/"/g, '&quot;')}"
                    data-isbn="${isbn}"
                    data-cover="${cover}"
                    data-author="${author}"
                    data-publisher="${publisher}"
                >Use this book</button>
            `;

                    resultsContainer.appendChild(card);
                });

                attachUseBookListeners();

            } catch (error) {
                resultsContainer.innerHTML = `<p class="text-red-500">Error: ${error.message}</p>`;
            }
        }

        function attachUseBookListeners() {
            document.querySelectorAll('.use-book-btn').forEach(button => {
                button.addEventListener('click', async () => {
                    const title = button.dataset.title;
                    const description = button.dataset.description;
                    const isbn = button.dataset.isbn;
                    const cover = button.dataset.cover;
                    const author = button.dataset.author;
                    const publisher = button.dataset.publisher;

                    document.querySelector('input[name="title"]').value = title;
                    document.querySelector('input[name="description"]').value = description;
                    document.querySelector('input[name="isbn"]').value = isbn;
                    document.querySelector('input[name="cover"]').value = cover;

                    const authorResponse = await fetch('/api/authors/find-or-create', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            name: author,
                            image: 'https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740',
                        })
                    });
                    const authorData = await authorResponse.json();

                    const authorSelect = document.querySelector('select[name="authors[]"]');
                    if (authorSelect && ![...authorSelect.options].some(opt => opt.value == authorData.id)) {
                        const option = new Option(authorData.name, authorData.id, true, true);
                        authorSelect.add(option);
                    }

                    const publisherResponse = await fetch('/api/publishers/find-or-create', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            name: publisher,
                            image: 'https://media.istockphoto.com/id/851887036/vector/colorful-icon.jpg?s=612x612&w=0&k=20&c=a8kAIu0ZX6QnS99I8nQFMkTFlVYqFCnsugm54q-WX_s='
                        })
                    });
                    const publisherData = await publisherResponse.json();

                    const publisherSelect = document.querySelector('select[name="publisher_id"]');
                    if (publisherSelect && ![...publisherSelect.options].some(opt => opt.value == publisherData.id)) {
                        const option = new Option(publisherData.name, publisherData.id, true, true);
                        publisherSelect.add(option);
                    }

                    document.getElementById('google-books-results').innerHTML = '';
                });
            });
        }
    </script>

</x-layout>
