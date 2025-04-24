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
    </style>

    <body>
        <h1 class="text-2xl font-light mb-4 mt-10">DATA KARYAWAN</h1>

        <a href="/admin/karyawan/create">
            <button class="font-light w-68 py-1 bg-secondary-2 text-white rounded-xl mb-6">TAMBAH KARYAWAN</button>
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

            <div class="w-full h-80 overflow-y-auto overflow-x-hidden">
                <table id="dataTable" class="min-w-full">
                    <thead class="bg-secondary-2 text-white">
                        <tr>
                            <th style="width: 5%;" class="text-center">ID</th>
                            <th style="width: 25%;">Nama</th>
                            <th style="width: 25%;" class="sm:hidden">Email</th>
                            <th style="width: 25%;" class="sm:hidden">Pekerjaan</th>
                            <th style="width: 20%;" class="text-center">Action</th>
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
            let currentPage = 1;

            async function fetchData() {
                try {
                    const entries = parseInt(document.getElementById("entries").value);
                    const search = document.getElementById("search").value.toLowerCase();
                    const pekerjaanElement = document.getElementById("pekerjaan");
                    const pekerjaan = pekerjaanElement ? pekerjaanElement.value : "";

                    const response = await fetch('http://localhost:8080/api/admin/staff-produksi', {
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + '{{ session("api_token") }}'
                        }
                    });
                    if (!response.ok) throw new Error("Failed to fetch data");

                    const data = await response.json();

                    const filteredData = data.data.filter(item =>
                        item.pekerjaan.toLowerCase().includes(search) &&
                        (pekerjaan === '' || item.pekerjaan === pekerjaan)
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

                    if (pekerjaanElement) renderpekerjaans(data, pekerjaan);
                } catch (error) {
                    console.error("Error fetching data:", error);
                }
            }

            async function viewDetail(id) {
                try {
                    const response = await fetch(`http://localhost:8080/api/admin/staff-produksi/${id}`, {
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
                <p class="w-auto">Nama Lengkap :</p>
                <span class="flex-grow border-b border-black">${detailData.data.nama}</span>
            </div>
            <div class="w-full flex justify-start items-center gap-3">
                <p class="w-auto">Tanggal Lahir :</p>
                <span class="flex-grow border-b border-black">${detailData.data.tanggal_lahir}</span>
            </div>
            </div>
            <div class="w-full flex justify-start items-center gap-3">
                <p class="w-auto">Alamat :</p>
                <span class="flex-grow border-b border-black">${detailData.data.alamat}</span>
            </div>
            </div>
            <div class="w-full flex justify-start items-center gap-3">
                <p class="w-auto">No Telfon :</p>
                <span class="flex-grow border-b border-black">${detailData.data.telepon}</span>
            </div>
            </div>
            <div class="w-full flex justify-start items-center gap-3">
                <p class="w-auto">Email :</p>
                <span class="flex-grow border-b border-black">${detailData.data.email}</span>
            </div>
            <div class="w-full flex justify-start items-center gap-3">
                <p class="w-auto">pekerjaan :</p>
                <span class="flex-grow border-b border-black">${detailData.data.pekerjaan}</span>
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
                tbody.innerHTML = data.map(item => `
        <tr>
            <td class="text-center">${item.id}</td>
            <td>${item.nama}</td>
            <td class="sm:hidden">${item.email}</td>
            <td class="sm:hidden">${item.pekerjaan}</td>
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

            function renderpekerjaans(data, selectedpekerjaan) {
                const pekerjaanSelect = document.getElementById("pekerjaan");
                pekerjaanSelect.innerHTML = '<option value="">All</option>' +
                    Array.from(new Set(data.map(item => item.pekerjaan)))
                    .map(pekerjaan => `<option value="${pekerjaan}" ${pekerjaan === selectedpekerjaan ? "selected" : ""}>${pekerjaan}</option>`)
                    .join("");
            }

            document.getElementById("pekerjaan")?.addEventListener("change", fetchData);
            document.getElementById("search")?.addEventListener("input", fetchData);
            fetchData();
        </script>

        <script>
            async function editItem(id) {
                try {
                    let response = await fetch(`http://localhost:8080/api/admin/staff-produksi/${id}`, {
                        method: "GET",
                        headers: {
                            "Content-Type": "application/json",
                            "Authorization": "Bearer " + '{{ session("api_token") }}'
                        }
                    });

                    if (!response.ok) {
                        throw new Error("Gagal mengambil data user.");
                    }

                    let karyawan = await response.json();

                    // Simpan data karyawan ke sessionStorage agar bisa digunakan di halaman edit
                    sessionStorage.setItem("editKaryawan", JSON.stringify(karyawan));

                    // Redirect ke halaman edit
                    window.location.href = `/admin/karyawan/edit`;
                } catch (error) {
                    alert(error.message);
                }
            }

            async function deleteItem(id) {
                if (!confirm("Apakah Anda yakin ingin menghapus user ini?")) {
                    return;
                }

                try {
                    let response = await fetch(`http://localhost:8080/api/admin/staff-produksi/${id}`, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "Authorization": "Bearer " + '{{ session("api_token") }}'
                        }
                    });

                    if (!response.ok) {
                        throw new Error("Gagal menghapus user.");
                    }

                    alert("User berhasil dihapus!");
                    window.location.reload(); // Refresh halaman setelah menghapus
                } catch (error) {
                    alert("Terjadi kesalahan: " + error.message);
                }
            }
        </script>

        
    </body>

    </html>

    </x-adminPage>