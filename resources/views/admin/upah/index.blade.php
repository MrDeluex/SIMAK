<x-layout.userPage>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border-bottom: 1px solid #000000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .pagination-button {
            display: inline-block;
            padding: 6px 12px;
        }

        .pagination-button.disabled {
            cursor: not-allowed;
            opacity: 0.6;
        }

        .pagination-button.active {
            background-color: #1e2697;
            color: white;
            cursor: default;
        }

        button {
            font-size: 0.875rem;
            font-weight: 500;
        }

        button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>

    <body>
        <h1 class="text-2xl font-light mb-4 mt-10">UPAH KARYAWAN</h1>

        <a href="/admin/upah/create">
            <button class="font-light w-68 py-1 bg-secondary-2 text-white rounded-xl mb-6">INPUT UPAH KARYAWAN</button>
        </a>

        <div id="app" class="py-8"
            style="box-shadow: 4px 0px 4px 0px rgba(0,0,0,0.25), -4px 0px 4px 0px rgba(0,0,0,0.25), 0px 4px 4px 0px rgba(0,0,0,0.25), 0px -4px 4px 0px rgba(0,0,0,0.25);">
            <div class="w-full flex sm:flex-wrap-reverse justify-between items-center mb-10 gap-5 px-3">
                <div class="">
                    <label for="entries" class="mr-2">Show</label>
                    <select id="entries" onchange="fetchData()" class="border border-gray-300 px-2 rounded">
                        <option value="5">5</option>
                        <option value="10">10</option>
                    </select>
                    <span class="ml-2">entries</span>
                </div>

                <div class="flex sm:w-full">
                    <label for="search" class="mr-2">Search:</label>
                    <input type="text" id="search" onkeyup="fetchData()"
                        class="border border-gray-300 px-1 rounded w-full">
                </div>
            </div>

            {{-- <div class="mb-4">
                <label for="category" class="mr-2">Filter by Category:</label>
                <select id="category" onchange="fetchData()" class="border border-gray-300 p-2 rounded">
                    <option value="">All</option>
                </select>
            </div> --}}
            <div class="w-full h-80 overflow-y-auto overflow-x-hidden">
                <table id="dataTable" class="min-w-full">
                    <thead class="bg-secondary-2 text-white">
                        <tr>
                            <th style="width: 5%;" class="text-center">ID</th>
                            <th style="width: 35%;">Name</th>
                            <th style="width: 35%;">Category</th>
                            <th style="width: 25%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows will be populated dynamically -->
                    </tbody>
                </table>
            </div>

            <div class="w-full flex justify-between items-center px-2">
                <div id="entriesInfo" class="mt-2 text-gray-600 sm:w-32">
                    <!-- Informasi jumlah data akan di-render di sini -->
                </div>
                <div id="pagination" class="mt-4 flex justify-end">
                    <!-- Pagination controls -->
                </div>
            </div>

        </div>

        <div id="detailModal" class="z-50 hidden fixed inset-0 bg-gray-900 bg-opacity-50 justify-center items-center">
            <div class="bg-white rounded-lg shadow-lg w-170 max-h-152"
                style="box-shadow: 4px 0px 4px 0px rgba(0,0,0,0.25), -4px 0px 4px 0px rgba(0,0,0,0.25), 0px 4px 4px 0px rgba(0,0,0,0.25), 0px -4px 4px 0px rgba(0,0,0,0.25);">

                <div class="w-full h-14 px-6 flex justify-between items-center"
                    style="box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);">
                    <h2 class="text-xl font-light ">INFORMASI DATA PENGGUNA</h2>
                    <button onclick="closeModal()" id="menu-close" class=" focus:outline-none">
                        <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="p-6 flex flex-col justify-start items-center">
                    <div class="w-42 h-42 bg-cover bg-center my-6"
                        style="background-image: url('{{ asset('assets/img/logo/logoBgWhite.png') }}')"></div>

                    <div id="modalContent" class="w-full flex flex-col gap-3 mb-6">
                        
                    </div>
                </div>
            </div>
        </div>
        <script>
            let currentPage = 1;

            async function fetchData() {
                const entries = parseInt(document.getElementById("entries").value);
                const search = document.getElementById("search").value.toLowerCase();
                const categoryElement = document.getElementById("category");
                const category = categoryElement ? categoryElement.value : ""; // Default ke kosong jika elemen tidak ada

                const response = await fetch('/data');
                const data = await response.json();

                // Filter berdasarkan kategori dan pencarian
                const filteredData = data.filter(item =>
                    item.name.toLowerCase().includes(search) &&
                    (category === '' || item.category === category)
                );

                const totalEntries = filteredData.length;
                const totalPages = Math.ceil(totalEntries / entries);

                if (currentPage > totalPages) {
                    currentPage = 1; // Kembali ke halaman 1 jika halaman tidak valid
                }

                const start = (currentPage - 1) * entries;
                const end = Math.min(start + entries, totalEntries);
                const paginatedData = filteredData.slice(start, end);

                renderTable(paginatedData);
                renderPagination(totalPages);
                renderEntriesInfo(start, end, totalEntries); // Tambahkan informasi jumlah data

                if (categoryElement) {
                    renderCategories(data, category);
                }
            }

                    async function viewDetail(id) {
                        // Ambil data detail berdasarkan ID
                        const response = await fetch(`/data/${id}`);
                        const detailData = await response.json();

                        // Isi konten modal dengan data detail
                        const modalContent = document.getElementById("modalContent");
                        modalContent.innerHTML = `
        <div class="w-full flex justify-start items-center gap-3">
                            <p class="w-auto">Id Karyawan : </p>
                            <span class="flex-grow border-b border-black">${detailData.id}</span>
                        </div>
                        <div class="w-full flex justify-start items-center gap-3">
                            <p class="w-auto">Nama Lengkap : </p>
                            <span class="flex-grow border-b border-black">${detailData.name}</span>
                        </div>
                        <div class="w-full flex justify-start items-center gap-3">
                            <p class="w-auto">Category : </p>
                            <span class="flex-grow border-b border-black">${detailData.category}</span>
                        </div>
                        <div class="w-full flex justify-start items-center gap-3">
                            <p class="w-auto">Detail : </p>
                            <span class="flex-grow border-b border-black">${detailData.description || "No description available."}</span>
                        </div>
    `;

                        // Tampilkan modal
                        document.getElementById("detailModal").style.display = "flex";
                    }

            function closeModal() {
                // Sembunyikan modal
                document.getElementById("detailModal").style.display = "none";
            }

            function renderTable(data) {
                const tbody = document.querySelector("#dataTable tbody");
                tbody.innerHTML = "";
                data.forEach(item => {
                    const row =
                        `<tr>
                    <td class="text-center">${item.id}</td>
                    <td>${item.name}</td>
                    <td>${item.category}</td>
                    <td class="flex justify-center gap-2 items-center">
                        <button onclick="viewDetail(${item.id})" 
                            class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">Detail</button>
                        <button onclick="editItem(${item.id})" 
                            class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Edit</button>
                        <button onclick="deleteItem(${item.id})" 
                            class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
                    </td>
                </tr>`;
                    tbody.innerHTML += row;
                });
            }

            function renderEntriesInfo(startIndex, endIndex, totalEntries) {
                const entriesInfo = document.getElementById("entriesInfo");
                if (totalEntries === 0) {
                    entriesInfo.textContent = "No entries to show.";
                } else {
                    entriesInfo.textContent = `Showing ${startIndex + 1} to ${endIndex} of ${totalEntries} entries`;
                }
            }

            function renderPagination(totalPages) {
                const paginationDiv = document.getElementById("pagination");
                paginationDiv.innerHTML = "";

                // Tombol Previous
                const prevButton = document.createElement("button");
                prevButton.textContent = "Previous";
                prevButton.className =
                    "pagination-button border border-gray-300 font-light hover:bg-gray-200 cursor-pointer";
                prevButton.disabled = currentPage === 1; // Nonaktifkan jika di halaman pertama
                prevButton.onclick = () => {
                    if (currentPage > 1) {
                        currentPage--;
                        fetchData();
                    }
                };
                paginationDiv.appendChild(prevButton);

                // Tombol untuk setiap halaman
                for (let i = 1; i <= totalPages; i++) {
                    const button = document.createElement("button");
                    button.textContent = i;
                    button.className =
                        `pagination-button border border-gray-300 font-light hover:bg-gray-200 cursor-pointer ${ i === currentPage ? "active" : "" }`;
                    button.disabled = i === currentPage; // Nonaktifkan tombol untuk halaman saat ini
                    button.onclick = () => {
                        currentPage = i;
                        fetchData();
                    };
                    paginationDiv.appendChild(button);
                }

                // Tombol Next
                const nextButton = document.createElement("button");
                nextButton.textContent = "Next";
                nextButton.className =
                    "pagination-button border border-gray-300 font-light hover:bg-gray-200 cursor-pointer";
                nextButton.disabled = currentPage === totalPages; // Nonaktifkan jika di halaman terakhir
                nextButton.onclick = () => {
                    if (currentPage < totalPages) {
                        currentPage++;
                        fetchData();
                    }
                };
                paginationDiv.appendChild(nextButton);
            }


            function renderCategories(data, selectedCategory) {
                const categorySelect = document.getElementById("category");
                const categories = Array.from(new Set(data.map(item => item.category)));

                categorySelect.innerHTML = '<option value="">All</option>'; // Tambahkan opsi awal
                categories.forEach(cat => {
                    const option = document.createElement("option");
                    option.value = cat;
                    option.textContent = cat;
                    option.selected = cat === selectedCategory; // Tetapkan opsi yang dipilih
                    categorySelect.appendChild(option);
                });
            }

            fetchData();
        </script>
    </body>

    </html>

    </x-userPage>
