<x-layout.adminPage contentClass="flex flex-col justify-start items-center">
    <h1 class="text-2xl font-reguler mb-10">Tambah Stock Barang</h1>
    <form action="" class="w-full" id="editForm">
        <div class="w-full p-10 flex flex-col justify-start items-start gap-8"
            style="box-shadow: 4px 0px 4px 0px rgba(0,0,0,0.25), -4px 0px 4px 0px rgba(0,0,0,0.25), 0px 4px 4px 0px rgba(0,0,0,0.25), 0px -4px 4px 0px rgba(0,0,0,0.25);">

            <div class="flex sm:flex-col justify-between w-full gap-10">

                <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                    <div class="relative w-full">
                        <input type="text" placeholder="Nama Barang" id="nama" name="nama"
                            class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent"
                            disabled />
                        <label for=""
                            class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                            style="top: 0; left: 0;">
                            Nama Barang
                        </label>
                    </div>
                </div>

                <div class="w-80 sm:w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                    <div class="relative w-full">
                        <input type="number" placeholder="Deskripsi" id="stock" name="stock"
                            class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                        <label for=""
                            class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                            style="top: 0; left: 0;">
                            Jumlah Stock
                        </label>
                    </div>
                    <p class="tracking-wider">KODI</p>
                </div>

            </div>

            <div class="w-full flex justify-between items-center">
                <button type="button" class="px-10 py-1 rounded bg-button-false text-white" onclick="window.location.href='/admin/users'">Kembali</button>
                <button type="submit" class="px-10 py-1 rounded bg-button-true text-white">Update</button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let stock = JSON.parse(sessionStorage.getItem("tambahStock"));
            console.log(stock);

            id = stock.data.id
            if (stock) {
                document.getElementById("nama").value = stock.data.nama;
            } else {
                alert("Data barang tidak ditemukan!");
                window.location.href = "/admin/barang"; // Redirect jika tidak ada data
            }

            document.getElementById("editForm").addEventListener("submit", async function(e) {
                e.preventDefault();
                let stok = document.getElementById("stock").value;
                console.log(id);


                let data = {
                    stok: stok
                };

                try {
                    let response = await fetch(`http://localhost:8080/api/admin/stock/${id}`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Authorization": "Bearer " + '{{ session("api_token") }}'
                        },
                        body: JSON.stringify(data)
                    });

                    let result = await response.json();


                    if (response.ok) {
                        // Menampilkan SweetAlert untuk berhasil menambah stok
                        Swal.fire({
                            title: 'Berhasil!',
                            text: "Stock berhasil ditambah",
                            icon: 'success',
                            confirmButtonText: 'Oke'
                        }).then(() => {
                            // Redirect setelah SweetAlert ditutup
                            window.location.href = "/admin/barang";
                        });
                    } else {
                        // Menampilkan SweetAlert jika gagal menambah stok
                        Swal.fire({
                            title: 'Gagal!',
                            text: "Gagal memperbarui kategori: " + (result.message || "Terjadi kesalahan"),
                            icon: 'error',
                            confirmButtonText: 'Tutup'
                        });
                    }
                } catch (error) {
                    // Menampilkan SweetAlert jika terjadi kesalahan
                    Swal.fire({
                        title: 'Error!',
                        text: "Terjadi kesalahan: " + error.message,
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    });
                }
            });
        });
    </script>


</x-layout.adminPage>