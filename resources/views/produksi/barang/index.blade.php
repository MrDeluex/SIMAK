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

        /* Untuk Chrome, Safari, Edge, dan Opera */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

    <body>
        <h1 class="text-2xl font-light mb-4 mt-10">DATA BARANG</h1>

        <a href="/staffProduksi/barang/create">
            <button class="font-light w-68 py-1 bg-secondary-2 text-white rounded-xl mb-6">INPUT BARANG</button>
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
                    <thead class="bg-secondary-2 text-white">
                        <tr>
                            <th style="width: 5%;" class="text-center">ID</th>
                            <th style="width: 35%;">Nama Barang</th>
                            <th style="width: 10%;" class="text-center">Kategori</th>
                            <th style="width: 25%;" class="text-center sm:hidden">Stock</th>
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

            let currentPage = 1;

            async function fetchData() {
                try {
                    const entries = parseInt(document.getElementById("entries").value);
                    const KategoriBarangElement = document.getElementById("KategoriBarang");
                    const KategoriBarang = KategoriBarangElement ? KategoriBarangElement.value : "";

                    const response = await fetch('http://localhost:8080/api/staff-produksi/barang', {
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + '{{ session("api_token") }}'
                        }
                    });
                    if (!response.ok) throw new Error("Failed to fetch data");

                    const data = await response.json();

                    const filteredData = data.data.filter(item =>
                        (item.staff_produksi?.user?.nama_lengkap.toLowerCase()) &&
                        (KategoriBarang === '' || item.kategori == KategoriBarang)
                    );

                    const totalEntries = filteredData.length;
                    const totalPages = Math.ceil(totalEntries / entries);
                    currentPage = Math.min(currentPage, totalPages) || 1;

                    const start = (currentPage - 1) * entries;
                    const end = Math.min(start + entries, totalEntries);
                    const paginatedData = filteredData.slice(start, end);

                    renderTable(paginatedData);
                    renderPagination(totalPages);
                    renderEntriesInfo(start, end, totalEntries);

                    if (KategoriBarangElement) renderKategoriBarangs(data, KategoriBarang);
                } catch (error) {
                    console.error("Error fetching data:", error);
                }
            }

            async function viewDetail(id) {
                try {
                    const response = await fetch(`http://localhost:8080/api/staff-produksi/barang/${id}`, {
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
                        <td>${item.nama}</td>
                        <td class="text-center">${item.kategori}</td>
                        <td class="sm:hidden text-center">${item.stok}</td>
                        <td class="flex justify-center gap-2 items-center">
                            <button onclick="viewDetail(${item.id})" class="px-2 py-4">
                                <svg width="18" height="13" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.77 6C17.77 5.641 17.576 5.406 17.188 4.934C15.768 3.21 12.636 0 8.99998 0C5.36398 0 2.23198 3.21 0.81198 4.934C0.42398 5.406 0.22998 5.641 0.22998 6C0.22998 6.359 0.42398 6.594 0.81198 7.066C2.23198 8.79 5.36398 12 8.99998 12C12.636 12 15.768 8.79 17.188 7.066C17.576 6.594 17.77 6.359 17.77 6ZM8.99998 9C9.79563 9 10.5587 8.68393 11.1213 8.12132C11.6839 7.55871 12 6.79565 12 6C12 5.20435 11.6839 4.44129 11.1213 3.87868C10.5587 3.31607 9.79563 3 8.99998 3C8.20433 3 7.44127 3.31607 6.87866 3.87868C6.31605 4.44129 5.99998 5.20435 5.99998 6C5.99998 6.79565 6.31605 7.55871 6.87866 8.12132C7.44127 8.68393 8.20433 9 8.99998 9Z" fill="black"/>
                                </svg>
                            </button>
                            <button onclick="editItem(${item.id})" class="px-2 py-4">
                                <svg width="14" height="13" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.625 1.62268H2.25C1.91848 1.62268 1.60054 1.75438 1.36612 1.9888C1.1317 2.22322 1 2.54116 1 2.87268V11.6227C1 11.9542 1.1317 12.2721 1.36612 12.5066C1.60054 12.741 1.91848 12.8727 2.25 12.8727H11C11.3315 12.8727 11.6495 12.741 11.8839 12.5066C12.1183 12.2721 12.25 11.9542 12.25 11.6227V7.24768" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.60895 1.38833C9.85759 1.13968 10.1948 1 10.5464 1C10.8981 1 11.2353 1.13968 11.4839 1.38833C11.7326 1.63697 11.8723 1.97419 11.8723 2.32583C11.8723 2.67746 11.7326 3.01468 11.4839 3.26333L5.85082 8.89708C5.70241 9.04535 5.51907 9.1539 5.3177 9.2127L3.52207 9.7377C3.46829 9.75339 3.41128 9.75433 3.35701 9.74042C3.30275 9.72652 3.25321 9.69828 3.2136 9.65867C3.17399 9.61906 3.14575 9.56952 3.13185 9.51526C3.11794 9.46099 3.11888 9.40398 3.13457 9.3502L3.65957 7.55457C3.71865 7.35336 3.8274 7.17024 3.97582 7.02208L9.60895 1.38833Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <button onclick="deleteItem(${item.id})" class="px-2 py-4">
                            <svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.875 4.375H8.75L5.625 1.25V3.125C5.625 3.46875 5.7475 3.76313 5.9925 4.00812C6.2375 4.25313 6.53167 4.37542 6.875 4.375ZM8.75 10.8906L7.875 11.75C7.76042 11.8646 7.61729 11.9246 7.44563 11.93C7.27396 11.9354 7.12542 11.8754 7 11.75C6.88542 11.6354 6.82812 11.4896 6.82812 11.3125C6.82812 11.1354 6.88542 10.9896 7 10.875L7.875 10L7 9.125C6.88542 9.01042 6.82812 8.86458 6.82812 8.6875C6.82812 8.51042 6.88542 8.36458 7 8.25C7.11458 8.13542 7.26042 8.07812 7.4375 8.07812C7.61458 8.07812 7.76042 8.13542 7.875 8.25L8.75 9.125L9.625 8.25C9.73958 8.13542 9.88292 8.07562 10.055 8.07062C10.2271 8.06563 10.3754 8.12542 10.5 8.25C10.6146 8.36458 10.6719 8.51042 10.6719 8.6875C10.6719 8.86458 10.6146 9.01042 10.5 9.125L9.64062 10L10.5 10.875C10.6146 10.9896 10.6746 11.1329 10.68 11.305C10.6854 11.4771 10.6254 11.6254 10.5 11.75C10.3854 11.8646 10.2396 11.9219 10.0625 11.9219C9.88542 11.9219 9.73958 11.8646 9.625 11.75L8.75 10.8906ZM1.25 12.5C0.90625 12.5 0.612083 12.3777 0.3675 12.1331C0.122917 11.8885 0.000416667 11.5942 0 11.25V1.25C0 0.90625 0.1225 0.612083 0.3675 0.3675C0.6125 0.122917 0.906667 0.000416667 1.25 0H5.73438C5.90104 0 6.06 0.0312501 6.21125 0.0937501C6.3625 0.15625 6.49521 0.244792 6.60938 0.359375L9.64062 3.39062C9.75521 3.50521 9.84375 3.63812 9.90625 3.78937C9.96875 3.94062 10 4.09937 10 4.26562V5.96875C10 6.09375 9.95042 6.19271 9.85125 6.26562C9.75208 6.33854 9.64021 6.35937 9.51562 6.32812C8.90104 6.19271 8.29167 6.21354 7.6875 6.39062C7.08333 6.56771 6.55208 6.88542 6.09375 7.34375C5.76042 7.67708 5.49479 8.07021 5.29688 8.52312C5.09896 8.97604 5 9.46333 5 9.985C5 10.2871 5.03646 10.5892 5.10938 10.8912C5.18229 11.1933 5.29167 11.4796 5.4375 11.75C5.53125 11.9271 5.53646 12.0965 5.45312 12.2581C5.36979 12.4198 5.23958 12.5004 5.0625 12.5H1.25Z" fill="black"/>
                            </svg>
                            </button>
                            <button onclick="tambahStock(${item.id})" class="px-2 py-4">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.5 6.5H10V7.5H7.5V10H6.5V7.5H4V6.5H6.5V4H7.5V6.5ZM7 0C7.64583 0 8.26562 0.0833333 8.85938 0.25C9.45312 0.416667 10.0104 0.651042 10.5312 0.953125C11.0521 1.25521 11.5234 1.61979 11.9453 2.04688C12.3672 2.47396 12.7318 2.94531 13.0391 3.46094C13.3464 3.97656 13.5833 4.53385 13.75 5.13281C13.9167 5.73177 14 6.35417 14 7C14 7.64583 13.9167 8.26562 13.75 8.85938C13.5833 9.45312 13.349 10.0104 13.0469 10.5312C12.7448 11.0521 12.3802 11.5234 11.9531 11.9453C11.526 12.3672 11.0547 12.7318 10.5391 13.0391C10.0234 13.3464 9.46615 13.5833 8.86719 13.75C8.26823 13.9167 7.64583 14 7 14C6.35417 14 5.73438 13.9167 5.14062 13.75C4.54688 13.5833 3.98958 13.349 3.46875 13.0469C2.94792 12.7448 2.47656 12.3802 2.05469 11.9531C1.63281 11.526 1.26823 11.0547 0.960938 10.5391C0.653646 10.0234 0.416667 9.46615 0.25 8.86719C0.0833333 8.26823 0 7.64583 0 7C0 6.35417 0.0833333 5.73438 0.25 5.14062C0.416667 4.54688 0.651042 3.98958 0.953125 3.46875C1.25521 2.94792 1.61979 2.47656 2.04688 2.05469C2.47396 1.63281 2.94531 1.26823 3.46094 0.960938C3.97656 0.653646 4.53385 0.416667 5.13281 0.25C5.73177 0.0833333 6.35417 0 7 0ZM7 13C7.55208 13 8.08333 12.9297 8.59375 12.7891C9.10417 12.6484 9.58073 12.4453 10.0234 12.1797C10.4661 11.9141 10.8724 11.6016 11.2422 11.2422C11.612 10.8828 11.9245 10.4792 12.1797 10.0312C12.4349 9.58333 12.6354 9.10417 12.7812 8.59375C12.9271 8.08333 13 7.55208 13 7C13 6.44792 12.9297 5.91667 12.7891 5.40625C12.6484 4.89583 12.4453 4.41927 12.1797 3.97656C11.9141 3.53385 11.6016 3.1276 11.2422 2.75781C10.8828 2.38802 10.4792 2.07552 10.0312 1.82031C9.58333 1.5651 9.10417 1.36458 8.59375 1.21875C8.08333 1.07292 7.55208 1 7 1C6.44792 1 5.91667 1.07031 5.40625 1.21094C4.89583 1.35156 4.41927 1.55469 3.97656 1.82031C3.53385 2.08594 3.1276 2.39844 2.75781 2.75781C2.38802 3.11719 2.07552 3.52083 1.82031 3.96875C1.5651 4.41667 1.36458 4.89583 1.21875 5.40625C1.07292 5.91667 1 6.44792 1 7C1 7.55208 1.07031 8.08333 1.21094 8.59375C1.35156 9.10417 1.55469 9.58073 1.82031 10.0234C2.08594 10.4661 2.39844 10.8724 2.75781 11.2422C3.11719 11.612 3.52083 11.9245 3.96875 12.1797C4.41667 12.4349 4.89583 12.6354 5.40625 12.7812C5.91667 12.9271 6.44792 13 7 13Z" fill="black"/>
                            </svg>
                            </button>
                        </td>
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

            function renderKategoriBarangs(data, selectedKategoriBarang) {
                const KategoriBarangSelect = document.getElementById("KategoriBarang");
                KategoriBarangSelect.innerHTML = '<option value="">All</option>' +
                    Array.from(new Set(data.data.map(item => item.kategori_barang))) // <- pakai kategori_barang
                    .map(kategori_barang => `<option value="${kategori_barang}" ${kategori_barang === selectedKategoriBarang ? "selected" : ""}>${kategori_barang}</option>`)
                    .join("");
            }


            document.getElementById("KategoriBarang")?.addEventListener("change", fetchData);

            function adjustKategoriBarang(amount) {
                const KategoriBarangElement = document.getElementById("KategoriBarang");
                let value = parseInt(KategoriBarangElement.value) || 0;
                value = Math.max(1, value + amount);
                KategoriBarangElement.value = value;
                fetchData();
            }
            fetchData();
        </script>
    </body>

    </html>

    </x-userPage>