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
        <h1 class="text-2xl font-light mb-4 mt-10">DATA USERS</h1>

        <a href="/admin/users/create">
            <button class="font-light flex items-center justify-start px-4 gap-2 w-56 py-1 bg-button-true text-white rounded-xl mb-6">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.5 7.5H11V8.5H8.5V11H7.5V8.5H5V7.5H7.5V5H8.5V7.5ZM8 1C8.64583 1 9.26562 1.08333 9.85938 1.25C10.4531 1.41667 11.0104 1.65104 11.5312 1.95312C12.0521 2.25521 12.5234 2.61979 12.9453 3.04688C13.3672 3.47396 13.7318 3.94531 14.0391 4.46094C14.3464 4.97656 14.5833 5.53385 14.75 6.13281C14.9167 6.73177 15 7.35417 15 8C15 8.64583 14.9167 9.26562 14.75 9.85938C14.5833 10.4531 14.349 11.0104 14.0469 11.5312C13.7448 12.0521 13.3802 12.5234 12.9531 12.9453C12.526 13.3672 12.0547 13.7318 11.5391 14.0391C11.0234 14.3464 10.4661 14.5833 9.86719 14.75C9.26823 14.9167 8.64583 15 8 15C7.35417 15 6.73438 14.9167 6.14062 14.75C5.54688 14.5833 4.98958 14.349 4.46875 14.0469C3.94792 13.7448 3.47656 13.3802 3.05469 12.9531C2.63281 12.526 2.26823 12.0547 1.96094 11.5391C1.65365 11.0234 1.41667 10.4661 1.25 9.86719C1.08333 9.26823 1 8.64583 1 8C1 7.35417 1.08333 6.73438 1.25 6.14062C1.41667 5.54688 1.65104 4.98958 1.95312 4.46875C2.25521 3.94792 2.61979 3.47656 3.04688 3.05469C3.47396 2.63281 3.94531 2.26823 4.46094 1.96094C4.97656 1.65365 5.53385 1.41667 6.13281 1.25C6.73177 1.08333 7.35417 1 8 1ZM8 14C8.55208 14 9.08333 13.9297 9.59375 13.7891C10.1042 13.6484 10.5807 13.4453 11.0234 13.1797C11.4661 12.9141 11.8724 12.6016 12.2422 12.2422C12.612 11.8828 12.9245 11.4792 13.1797 11.0312C13.4349 10.5833 13.6354 10.1042 13.7812 9.59375C13.9271 9.08333 14 8.55208 14 8C14 7.44792 13.9297 6.91667 13.7891 6.40625C13.6484 5.89583 13.4453 5.41927 13.1797 4.97656C12.9141 4.53385 12.6016 4.1276 12.2422 3.75781C11.8828 3.38802 11.4792 3.07552 11.0312 2.82031C10.5833 2.5651 10.1042 2.36458 9.59375 2.21875C9.08333 2.07292 8.55208 2 8 2C7.44792 2 6.91667 2.07031 6.40625 2.21094C5.89583 2.35156 5.41927 2.55469 4.97656 2.82031C4.53385 3.08594 4.1276 3.39844 3.75781 3.75781C3.38802 4.11719 3.07552 4.52083 2.82031 4.96875C2.5651 5.41667 2.36458 5.89583 2.21875 6.40625C2.07292 6.91667 2 7.44792 2 8C2 8.55208 2.07031 9.08333 2.21094 9.59375C2.35156 10.1042 2.55469 10.5807 2.82031 11.0234C3.08594 11.4661 3.39844 11.8724 3.75781 12.2422C4.11719 12.612 4.52083 12.9245 4.96875 13.1797C5.41667 13.4349 5.89583 13.6354 6.40625 13.7812C6.91667 13.9271 7.44792 14 8 14Z" fill="white" />
                </svg>
                <span>Tambah User</span>
            </button>
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
                    <thead class="bg-custom-1 text-white">
                        <tr>
                            <th style="width: 5%;" class="text-center">ID</th>
                            <th style="width: 25%;">Nama</th>
                            <th style="width: 25%;" class="sm:hidden">Email</th>
                            <th style="width: 20%;" class="sm:hidden">Role</th>
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
            let currentPage = 1;

            async function fetchData() {
                try {
                    const entries = parseInt(document.getElementById("entries").value);
                    const search = document.getElementById("search").value.toLowerCase();
                    const roleElement = document.getElementById("role");
                    const role = roleElement ? roleElement.value : "";

                    const response = await fetch('https://backend-simak.trihech.my.id/api/admin/users', {
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + '{{ session("api_token") }}'
                        }
                    });
                    if (!response.ok) throw new Error("Failed to fetch data");

                    const data = await response.json();


                    const filteredData = data.data.filter(item =>
                        item.role.toLowerCase().includes(search) &&
                        (role === '' || item.role === role)
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

                    if (roleElement) renderRoles(data, role);
                } catch (error) {
                    console.error("Error fetching data:", error);
                }
            }

            async function viewDetail(id) {
                try {
                    const response = await fetch(`https://backend-simak.trihech.my.id/api/admin/users/${id}`, {
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
                <p class="w-auto">Nama Lengkap :</p>
                <span class="flex-grow border-b border-black">${detailData.nama_lengkap}</span>
            </div>
            <div class="w-full flex justify-start items-center gap-3">
                <p class="w-auto">Role :</p>
                <span class="flex-grow border-b border-black">${detailData.role}</span>
            </div>
            <div class="w-full flex justify-start items-center gap-3">
                <p class="w-auto">Email :</p>
                <span class="flex-grow border-b border-black">${detailData.email || "No description available."}</span>
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
            <td>${item.nama_lengkap}</td>
            <td class="sm:hidden">${item.email}</td>
            <td class="sm:hidden">${item.role}</td>
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

            function renderRoles(data, selectedRole) {
                const roleSelect = document.getElementById("role");
                roleSelect.innerHTML = '<option value="">All</option>' +
                    Array.from(new Set(data.map(item => item.role)))
                    .map(role => `<option value="${role}" ${role === selectedRole ? "selected" : ""}>${role}</option>`)
                    .join("");
            }

            document.getElementById("role")?.addEventListener("change", fetchData);
            document.getElementById("search")?.addEventListener("input", fetchData);
            fetchData();
        </script>

        <script>
            async function editItem(id) {
                try {
                    let response = await fetch(`https://backend-simak.trihech.my.id/api/admin/users/${id}`, {
                        method: "GET",
                        headers: {
                            "Content-Type": "application/json",
                            "Authorization": "Bearer " + '{{ session("api_token") }}'
                        }
                    });

                    if (!response.ok) {
                        throw new Error("Gagal mengambil data user.");
                    }

                    let user = await response.json();

                    // Simpan data user ke sessionStorage agar bisa digunakan di halaman edit
                    sessionStorage.setItem("editUser", JSON.stringify(user));

                    // Redirect ke halaman edit
                    window.location.href = `/admin/users/edit`;
                } catch (error) {
                    alert(error.message);
                }
            }
        </script>

        <script>
            async function deleteItem(id) {
                // Konfirmasi dengan SweetAlert
                const result = await Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus, proses ini tidak bisa dibatalkan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                });

                if (!result.isConfirmed) {
                    return; // Jika tidak dikonfirmasi, proses di-stop
                }

                try {
                    let response = await fetch(`https://backend-simak.trihech.my.id/api/admin/users/${id}`, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "Authorization": "Bearer " + '{{ session("api_token") }}'
                        }
                    });

                    if (!response.ok) {
                        throw new Error("Gagal menghapus user.");
                    }

                    // Menampilkan SweetAlert untuk keberhasilan
                    Swal.fire({
                        title: 'Berhasil!',
                        text: "User berhasil dihapus!",
                        icon: 'success',
                        confirmButtonText: 'Oke'
                    }).then(() => {
                        window.location.reload(); // Refresh halaman setelah menghapus
                    });
                } catch (error) {
                    // Menampilkan SweetAlert jika terjadi kesalahan
                    Swal.fire({
                        title: 'Terjadi Kesalahan!',
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