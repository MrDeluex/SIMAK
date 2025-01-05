<!-- resources/views/datatable.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Custom DataTable</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div id="app">
        <h1>Data Table</h1>
        <div>
            Show 
            <select id="entries" onchange="fetchData()">
                <option value="5">5</option>
                <option value="10">10</option>
            </select>
            entries
        </div>
        <div>
            Search: <input type="text" id="search" onkeyup="fetchData()">
        </div>
        <div>
            Filter by Category: 
            <select id="category" onchange="fetchData()">
                <option value="">All</option>
                <!-- Tambahkan kategori dari backend -->
            </select>
        </div>
        
        <table id="dataTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                <!-- Rows will be populated dynamically -->
            </tbody>
        </table>
        <div id="pagination"></div>
    </div>
    <script>
        let currentPage = 1;

        async function fetchData() {
    const entries = document.getElementById("entries").value;
    const search = document.getElementById("search").value.toLowerCase();
    const category = document.getElementById("category").value;

    const response = await fetch('/data');
    const data = await response.json();

    // Filter berdasarkan kategori
    const filteredData = data.filter(item => 
        item.name.toLowerCase().includes(search) && 
        (category === '' || item.category === category)
    );

    const totalEntries = filteredData.length;
    const totalPages = Math.ceil(totalEntries / entries);

    const start = (currentPage - 1) * entries;
    const paginatedData = filteredData.slice(start, start + parseInt(entries));

    renderTable(paginatedData);
    renderPagination(totalPages);
    renderCategories(data);  // Render dropdown categories
}

function renderTable(data) {
    const tbody = document.querySelector("#dataTable tbody");
    tbody.innerHTML = "";
    data.forEach(item => {
        const row = `<tr>
            <td>${item.id}</td>
            <td>${item.name}</td>
            <td>${item.category}</td>
        </tr>`;
        tbody.innerHTML += row;
    });
}

function renderPagination(totalPages) {
    const paginationDiv = document.getElementById("pagination");
    paginationDiv.innerHTML = "";
    for (let i = 1; i <= totalPages; i++) {
        const button = document.createElement("button");
        button.textContent = i;
        button.disabled = i === currentPage;
        button.onclick = () => {
            currentPage = i;
            fetchData();
        };
        paginationDiv.appendChild(button);
    }
}

function renderCategories(data) {
    const categorySelect = document.getElementById("category");
    const categories = Array.from(new Set(data.map(item => item.category)));

    categorySelect.innerHTML = '<option value="">All</option>';  // Tambahkan opsi awal
    categories.forEach(cat => {
        const option = document.createElement("option");
        option.value = cat;
        option.textContent = cat;
        categorySelect.appendChild(option);
    });
}

fetchData();

    </script>
</body>
</html>
