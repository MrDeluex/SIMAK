<x-layout.adminPage>

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

        /* Untuk Chrome, Safari, Edge, dan Opera */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

    <body>
        <h1 class="text-2xl font-light mb-4 mt-10">DATA BARANG</h1>

        <a href="/admin/barang/create">
            <button class="font-light w-68 py-1 bg-button-true text-white rounded-xl mb-6">INPUT BARANG</button>
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
                <div class="flex gap-4">
                    <div class="flex sm:w-full">
                        <label for="search" class="mr-2">Search:</label>
                        <input type="text" id="search" onkeyup="fetchData()"
                            class="border border-gray-300 px-1 rounded w-full">
                    </div>.

                    <div class="flex items-center gap-2">
                        <label for="mingguKe">Minggu Ke</label>
                        <button onclick="adjustMingguKe(-1)">-</button>
                        <input type="number" id="mingguKe" class="border p-1 w-10 text-center" value="1" min="1" />
                        <button onclick="adjustMingguKe(1)">+</button>
                    </div>


                </div>
            </div>


            <div class="w-full h-80 overflow-y-auto overflow-x-hidden">
                <table id="dataTable" class="min-w-full">
                    <thead class="bg-custom-1 text-white">
                        <tr>
                            <th style="width: 5%;" class="text-center">No</th>
                            <th style="width: 95%;">Keterangan</th>
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
                        style="background-image: url('{{ asset('assets/img/logo/logoBgWhite.png'); }}')"></div>

                    <div id="modalContent" class="w-full flex flex-col gap-3 mb-6">

                    </div>
                </div>
            </div>
        </div>
        <script>
            function formatRupiah(angka) {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                    minimumFractionDigits: 0
                }).format(angka);
            }

            let currentPage = 1; // Global variable for current page

            async function fetchData() {
                try {
                    const entries = parseInt(document.getElementById("entries").value) || 5; // Default to 5 if empty or invalid
                    const searchTerm = document.getElementById("search").value.toLowerCase(); // Get the search term

                    // Fetch data from API
                    const response = await fetch('http://localhost:8080/api/admin/logs', {
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + '{{ session("api_token") }}'
                        }
                    });

                    if (!response.ok) throw new Error("Failed to fetch data");

                    const data = await response.json();

                    // Filter the data based on searchTerm (case insensitive) in 'description'
                    const filteredData = data.data.data.filter(item => {
                        return item.description && item.description.toLowerCase().includes(searchTerm);
                    });

                    const totalEntries = filteredData.length;
                    const totalPages = Math.ceil(totalEntries / entries);

                    // Adjust currentPage if it's out of bounds after filtering
                    currentPage = Math.min(currentPage, totalPages) || 1;

                    const start = (currentPage - 1) * entries;
                    const end = Math.min(start + entries, totalEntries);

                    const paginatedData = filteredData.slice(start, end);

                    // Render the filtered and paginated data
                    renderTable(paginatedData);
                    renderPagination(totalPages);
                    renderEntriesInfo(start, end, totalEntries);

                    // Handle case when no results are found
                    if (filteredData.length === 0) {
                        renderTable([]); // Clear the table or show a 'No results found' message
                        renderPagination(0); // No pagination if no results
                        renderEntriesInfo(0, 0, 0); // Empty info
                    }

                } catch (error) {
                    console.error("Error fetching data:", error);
                }
            }






            async function viewDetail(id) {
                try {
                    const response = await fetch(`http://localhost:8080/api/admin/barang/${id}`, {
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + '{{ session("api_token") }}'
                        }
                    });

                    if (!response.ok) throw new Error("Failed to fetch details");

                    const detailData = await response.json();

                    const modalContent = document.getElementById("modalContent");
                    modalContent.innerHTML = `
            <div class="w-full flex justify-start items-center gap-3">
                <p class="w-auto">Nama Barang :</p>
                <span class="flex-grow border-b border-black">${detailData.data.nama}</span>
            </div>
            <div class="w-full flex justify-start items-center gap-3">
                <p class="w-auto">Deskripsi Barang :</p>
                <span class="flex-grow border-b border-black">${detailData.data.deskripsi}</span>
            </div>
            <div class="w-full flex justify-start items-center gap-3">
                <p class="w-auto">Stock Tersedia :</p>
                <span class="flex-grow border-b border-black">${detailData.data.stok}</span>
            </div>
            <div class="w-full flex justify-start items-center gap-3">
                <p class="w-auto">Upah Per Kodi :</p>
                <span class="flex-grow border-b border-black">${detailData.data.upah}</span>
            </div>
            <div class="w-full flex justify-start items-center gap-3">
                <p class="w-auto">Kategori Barang :</p>
                <span class="flex-grow border-b border-black">${detailData.data.kategori}</span>
            </div>`;

                    document.getElementById("detailModal").style.display = "flex";
                } catch (error) {
                    console.error("Error fetching details:", error);
                }
            }


            function closeModal() {
                document.getElementById("detailModal").style.display = "none";
            }




            function renderTable(data) {
                console.log(data);
                const tbody = document.querySelector("#dataTable tbody");
                tbody.innerHTML = data.map(item => `
                    <tr>
                        <td class="text-center">${item.id}</td>
                        <td>${item.description}</td>
                        
                    </tr>`).join("");
            }

            function renderEntriesInfo(startIndex, endIndex, totalEntries) {
                document.getElementById("entriesInfo").textContent = totalEntries === 0 ?
                    "No entries to show." : `Showing ${startIndex + 1} to ${endIndex} of ${totalEntries} entries`;
            }

            function renderPagination(totalPages) {
                const paginationDiv = document.getElementById("pagination");
                paginationDiv.innerHTML = "";

                const createButton = (text, disabled, onClick) => {
                    const button = document.createElement("button");
                    button.textContent = text;
                    button.className = "pagination-button border border-gray-300 font-light hover:bg-gray-200 cursor-pointer";
                    button.disabled = disabled;
                    button.onclick = onClick;
                    return button;
                };

                paginationDiv.appendChild(createButton("Previous", currentPage === 1, () => {
                    if (currentPage > 1) {
                        currentPage--;
                        fetchData();
                    }
                }));

                const maxVisibleButtons = 5;
                let startPage = Math.max(1, currentPage - Math.floor(maxVisibleButtons / 2));
                let endPage = Math.min(totalPages, startPage + maxVisibleButtons - 1);
                startPage = Math.max(1, endPage - maxVisibleButtons + 1);

                for (let i = startPage; i <= endPage; i++) {
                    paginationDiv.appendChild(createButton(i, i === currentPage, () => {
                        currentPage = i;
                        fetchData();
                    }));
                }

                paginationDiv.appendChild(createButton("Next", currentPage === totalPages, () => {
                    if (currentPage < totalPages) {
                        currentPage++;
                        fetchData();
                    }
                }));
            }
            document.getElementById("search")?.addEventListener("input", fetchData);
            fetchData();
        </script>

        <script>
            async function editItem(id) {
                try {
                    let response = await fetch(`http://localhost:8080/api/admin/barang/${id}`, {
                        method: "GET",
                        headers: {
                            "Authorization": "Bearer " + '{{ session("api_token") }}'
                        }
                    });

                    if (!response.ok) {
                        throw new Error("Gagal mengambil data Barang.");
                    }

                    let user = await response.json();

                    // Simpan data user ke sessionStorage agar bisa digunakan di halaman edit
                    sessionStorage.setItem("editBarang", JSON.stringify(user));

                    // Redirect ke halaman edit
                    window.location.href = `/admin/barang/edit`;
                } catch (error) {
                    alert(error.message);
                }
            }

            async function deleteItem(id) {
                if (!confirm("Apakah Anda yakin ingin menghapus Barang ini?")) {
                    return;
                }

                try {
                    let response = await fetch(`http://localhost:8080/api/admin/barang/${id}`, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "Authorization": "Bearer " + '{{ session("api_token") }}'
                        }
                    });

                    if (!response.ok) {
                        throw new Error("Gagal menghapus barang.");
                    }

                    alert("Barang berhasil dihapus!");
                    window.location.reload(); // Refresh halaman setelah menghapus
                } catch (error) {
                    alert("Terjadi kesalahan: " + error.message);
                }
            }

            async function tambahStock(id) {
                try {
                    let response = await fetch(`http://localhost:8080/api/admin/barang/${id}`, {
                        method: "GET",
                        headers: {
                            "Authorization": "Bearer " + '{{ session("api_token") }}'
                        }
                    });

                    if (!response.ok) {
                        throw new Error("Gagal mengambil data Barang.");
                    }

                    let barang = await response.json();

                    // Simpan data user ke sessionStorage agar bisa digunakan di halaman edit
                    sessionStorage.setItem("tambahStock", JSON.stringify(barang));

                    // Redirect ke halaman edit
                    window.location.href = `/admin/stock`;
                } catch (error) {
                    alert(error.message);
                }
            }
        </script>
    </body>

    </html>

    </x-adminPage>