<x-layout.administrasiPage contentClass="flex flex-col justify-start items-center">
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

    <h1 class="text-2xl font-reguler mb-10">Edit Barang</h1>
    <form action="" class="w-full" id="editForm">
        <div class="w-full p-10 flex flex-col justify-start items-start gap-8"
            style="box-shadow: 4px 0px 4px 0px rgba(0,0,0,0.25), -4px 0px 4px 0px rgba(0,0,0,0.25), 0px 4px 4px 0px rgba(0,0,0,0.25), 0px -4px 4px 0px rgba(0,0,0,0.25);">

            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="text" id="nama" name="nama"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500"
                        style="top: 0; left: 0;">
                        Nama Barang
                    </label>
                </div>
            </div>

            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="text" id="deskripsi" name="deskripsi"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500"
                        style="top: 0; left: 0;">
                        Deskripsi Barang
                    </label>
                </div>
            </div>

            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <select id="kategoriSelect" name="kategori_id"
                        class="form-select peer w-full bg-transparent focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250">
                        <option value="">Pilih Kategori</option>
                    </select>
                    <label class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500"
                        style="top: 0; left: 0;">
                        Pilih Kategori
                    </label>
                </div>
            </div>

            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="number" id="stock_awal" name="stock_awal"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500"
                        style="top: 0; left: 0;">
                        Stock Awal
                    </label>
                </div>
            </div>

            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="number" id="upah" name="upah"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500"
                        style="top: 0; left: 0;">
                        Upah Per Kodi
                    </label>
                </div>
            </div>

            <div class="w-full flex justify-between items-center">
                <button type="button" class="px-10 py-1 rounded bg-button-false text-white" onclick="window.location.href='/staffAdministrasi/barang'">Kembali</button>
                <button type="submit" class="px-10 py-1 rounded bg-button-true text-white">Tambah</button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", async function() {
            const form = document.getElementById("editForm");

            let barang = JSON.parse(sessionStorage.getItem("editBarang"));
            console.log(barang);

            id = barang.data.id
            if (barang) {
                document.getElementById("nama").value = barang.data.nama;
                document.getElementById("deskripsi").value = barang.data.deskripsi;
                document.getElementById("stock_awal").value = barang.data.stok;
                document.getElementById("upah").value = barang.data.upah;
                loadKategoriBarang(barang.data.id);
            } else {
                alert("Data barang tidak ditemukan!");
                window.location.href = "/staffAdministrasi/barang"; // Redirect jika tidak ada data
            }

            async function loadKategoriBarang(selectedId) {
                const kategoriSelect = document.getElementById("kategoriSelect");

                try {
                    const res = await fetch("http://localhost:8080/api/staff-administrasi/kategori/", {
                        headers: {
                            "Authorization": "Bearer {{ session('api_token') }}"
                        }
                    });
                    const data = await res.json();
                    kategoriSelect.innerHTML = '<option value="" disabled>Pilih Kategori</option>' +
                        data.data.map(barang => `<option value="${barang.id}" ${barang.id == selectedId ? "selected" : ""}>${barang.nama}</option>`).join("");
                } catch (error) {
                    console.error("Error fetching barang produksi:", error);
                }
            }

            form.addEventListener("submit", async function(event) {
                event.preventDefault();
                const formData = {
                    nama: document.getElementById("nama").value,
                    deskripsi: document.getElementById("deskripsi").value,
                    kategori_barang: kategoriSelect.value,
                    stock_awal: document.getElementById("stock_awal").value,
                    upah: document.getElementById("upah").value
                };

                console.log(formData);


                try {
                    const res = await fetch(`http://localhost:8080/api/staff-administrasi/barang/${id}`, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "Authorization": "Bearer {{ session('api_token') }}"
                        },
                        body: JSON.stringify(formData)
                    });
                    const result = await res.json();
                    if (res.ok) {
                        // Menampilkan SweetAlert untuk sukses
                        Swal.fire({
                            title: 'Berhasil!',
                            text: result.message,
                            icon: 'success',
                            confirmButtonText: 'Oke'
                        }).then(() => {
                            // Redirect setelah SweetAlert ditutup
                            window.location.href = "/staffAdministrasi/barang";
                        });
                    } else {
                        // Menampilkan SweetAlert jika gagal
                        Swal.fire({
                            title: 'Gagal!',
                            text: result.message || "Terjadi kesalahan",
                            icon: 'error',
                            confirmButtonText: 'Tutup'
                        });
                    }
                } catch (error) {
                    console.error("Error updating data:", error);
                    // Menampilkan SweetAlert jika terjadi error
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

</x-layout.administrasiPage>