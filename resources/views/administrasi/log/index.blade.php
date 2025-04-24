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

        <script>
            async function fetchLogs() {
                try {
                    const response = await fetch('http://localhost:8080/api/admin/logs', {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + '{{ session("api_token") }}'
                        },
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();
                    console.log(data); // atau render ke DOM
                } catch (error) {
                    console.error('Gagal fetch logs:', error);
                }
            }

            // Jalankan saat halaman siap
            document.addEventListener('DOMContentLoaded', fetchLogs);
        </script>


    </body>

    </html>

    </x-adminPage>