<x-layout.administrasiPage>

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
        <h1 class="text-2xl font-light mb-4 mt-10">DATA HARIAN</h1>

        <a href="/staffAdministrasi/harian/create">
            <button class="font-light w-68 py-1 bg-button-true text-white rounded-xl mb-6">TAMBAH DATA HARIAN</button>
        </a>

        <div id="app" class="py-8"
            style="box-shadow: 4px 0px 4px 0px rgba(0,0,0,0.25), -4px 0px 4px 0px rgba(0,0,0,0.25), 0px 4px 4px 0px rgba(0,0,0,0.25), 0px -4px 4px 0px rgba(0,0,0,0.25);">
            <div class="w-full flex sm:flex-wrap-reverse justify-between items-center mb-10 gap-5 px-3">
                <div class="sm:order-2">
                    <label for="entries" class="mr-2">Show</label>
                    <select id="entries" onchange="fetchData()" class="border border-gray-300 px-2 rounded">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                    </select>
                    <span class="ml-2">entries</span>
                </div>
                <div class="flex sm:order-3">
                    <div class="flex sm:w-full">
                        <label for="search" class="mr-2">Search:</label>
                        <input type="text" id="search" onkeyup="fetchData()"
                            class="border border-gray-300 px-1 rounded w-full">
                    </div>.
                </div>
                <div class="sm:order-1">
                    <div class="flex items-center gap-2">
                        <label for="">Tanggal :</label>
                        <input type="date" id="tanggal" class="border p-1 text-center" />
                    </div>
                </div>
            </div>


            <div class="w-full h-80 overflow-y-auto overflow-x-hidden">
                <table id="dataTable" class="min-w-full">
                    <thead class="bg-custom-1 text-white">
                        <tr>
                            <th style="width: 5%;" class="text-center">ID</th>
                            <th style="width: 30%;">Nama</th>
                            <th style="width: 15%;" class="text-center">Tanggal</th>
                            <th style="width: 25%;" class="text-center sm:hidden">Jumlah</th>
                            <th style="width: 15%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows will be populated dynamically -->
                    </tbody>
                </table>
            </div>

            <div class="w-full flex justify-between items-center px-2 sm:flex-col">
                <div id="entriesInfo" class="mt-2 text-gray-600 w-32 sm:w-auto">
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
                    const search = document.getElementById("search").value.toLowerCase();
                    const tanggalElement = document.getElementById("tanggal");
                    const tanggal = tanggalElement ? tanggalElement.value : "";

                    const response = await fetch('https://backend-simak.trihech.my.id/api/staff-administrasi/barang-harian', {
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + '{{ session("api_token") }}'
                        }
                    });
                    if (!response.ok) throw new Error("Failed to fetch data");

                    const data = await response.json();

                    const filteredData = data.data.filter(item =>
                        (item.staff_produksi?.user?.nama_lengkap.toLowerCase().includes(search) || search === "") &&
                        (tanggal === '' || item.tanggal == tanggal)
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

                    if (tanggalElement) rendertanggals(data, tanggal);
                } catch (error) {
                    console.error("Error fetching data:", error);
                }
            }

            async function viewDetail(id) {
                try {
                    const response = await fetch(`https://backend-simak.trihech.my.id/api/staff-administrasi/barang-harian/${id}`, {
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + '{{ session("api_token") }}'
                        }
                    });

                    if (!response.ok) throw new Error("Failed to fetch details");
                    const detailData = await response.json();
                    console.log(detailData);
                    const modalContent = document.getElementById("modalContent");
                    modalContent.innerHTML = `
            <div class="w-full flex justify-start items-center gap-3">
                <p class="w-auto">Nama :</p>
                <span class="flex-grow border-b border-black">${detailData.data.staff_produksi.nama}</span>
            </div>
            <div class="w-full flex justify-start items-center gap-3">
                <p class="w-auto">Barang :</p>
                <span class="flex-grow border-b border-black">${detailData.data.barang.nama}</span>
            </div>
            <div class="w-full flex justify-start items-center gap-3">
                <p class="w-auto">Tanggal :</p>
                <span class="flex-grow border-b border-black">${detailData.data.tanggal}</span>
            </div>
            <div class="w-full flex justify-start items-center gap-3">
                <p class="w-auto">Jumlah Dikerjakan :</p>
                <span class="flex-grow border-b border-black">${detailData.data.jumlah_dikerjakan || "No description available."}</span>
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
                const tbody = document.querySelector("#dataTable tbody");
                tbody.innerHTML = data.map((item, index) => `
                    <tr>
                        <td class="text-center">${index + 1}</td>
                        <td>${item.staff_produksi.nama}</td>
                        <td class="text-center">${item.tanggal}</td>
                        <td class="sm:hidden text-center">${item.jumlah_dikerjakan}</td>
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

            function rendertanggals(data, selectedtanggal) {
                const tanggalSelect = document.getElementById("tanggal");
                tanggalSelect.innerHTML = '<option value="">All</option>' +
                    Array.from(new Set(data.data.map(item => item.tanggal))) // <- pakai tanggal
                    .map(tanggal => `<option value="${tanggal}" ${tanggal === selectedtanggal ? "selected" : ""}>${tanggal}</option>`)
                    .join("");
            }


            document.getElementById("tanggal")?.addEventListener("change", fetchData);

            function adjusttanggal(amount) {
                const tanggalElement = document.getElementById("tanggal");
                let value = parseInt(tanggalElement.value) || 0;
                value = Math.max(1, value + amount);
                tanggalElement.value = value;
                fetchData();
            }

            document.getElementById("search")?.addEventListener("input", fetchData);
            fetchData();
        </script>

        <script>
            async function editItem(id) {
                try {
                    let response = await fetch(`https://backend-simak.trihech.my.id/api/staff-administrasi/barang-harian/${id}`, {
                        method: "GET",
                        headers: {
                            "Authorization": "Bearer " + '{{ session("api_token") }}'
                        }
                    });

                    console.log(response);

                    if (!response.ok) {
                        throw new Error("Gagal mengambil data.");
                    }

                    let harian = await response.json();

                    // Simpan data harian ke sessionStorage agar bisa digunakan di halaman edit
                    sessionStorage.setItem("editHarian", JSON.stringify(harian));

                    // Redirect ke halaman edit
                    window.location.href = `/staffAdministrasi/harian/edit`;
                } catch (error) {
                    alert(error.message);
                }
            }

            async function deleteItem(id) {
                // Menggunakan SweetAlert untuk konfirmasi penghapusan
                const confirmDeletion = await Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                });

                if (!confirmDeletion.isConfirmed) {
                    return; // Jika batal, tidak melakukan apapun
                }

                try {
                    let response = await fetch(`https://backend-simak.trihech.my.id/api/staff-administrasi/barang-harian/${id}`, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "Authorization": "Bearer " + '{{ session("api_token") }}'
                        }
                    });

                    if (!response.ok) {
                        throw new Error("Gagal menghapus data.");
                    }

                    // Menampilkan SweetAlert setelah data berhasil dihapus
                    Swal.fire({
                        title: 'Berhasil!',
                        text: "Data berhasil dihapus!",
                        icon: 'success',
                        confirmButtonText: 'Oke'
                    }).then(() => {
                        window.location.reload(); // Refresh halaman setelah penghapusan berhasil
                    });
                } catch (error) {
                    // Menampilkan SweetAlert jika terjadi error
                    Swal.fire({
                        title: 'Error!',
                        text: "Terjadi kesalahan: " + error.message,
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    });
                }
            }
        </script>
    </body>

    </html>

    </x-adminPage>