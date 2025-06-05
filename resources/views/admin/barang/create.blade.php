<x-layout.adminPage contentClass="flex flex-col justify-start items-center">
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

    <h1 class="text-2xl font-reguler mb-10">Tambah Barang</h1>
    <form action="" class="w-full" id="inputForm">
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
                    <select id="kategori_id" name="kategori_id"
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
                <button type="button" class="px-10 py-1 rounded bg-button-false text-white">Kembali</button>
                <button type="submit" class="px-10 py-1 rounded bg-button-true text-white">Tambah</button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", async function() {
            const form = document.getElementById("inputForm");
            const kategoriSelect = document.getElementById("kategori_id");

            async function loadKategori() {
                try {
                    const res = await fetch("http://localhost:8080/api/admin/kategori", {
                        headers: {
                            "Authorization": "Bearer {{ session('api_token') }}"
                        }
                    });
                    const data = await res.json();
                    kategoriSelect.innerHTML = '<option value="" selected disabled>Pilih Kategori</option>';

                    kategoriSelect.innerHTML += data.data.map(kategori =>
                        `<option value="${kategori.id}">${kategori.nama}</option>`
                    ).join("");
                } catch (error) {
                    console.error("Error fetching staff produksi:", error);
                }
            }

            loadKategori();

            // Handle form submit
            form.addEventListener("submit", async function(event) {
                event.preventDefault();

                const formData = {
                    nama: document.getElementById("nama").value,
                    deskripsi: document.getElementById("deskripsi").value,
                    kategori_barang: kategoriSelect.value,
                    stok_awal: document.getElementById("stock_awal").value,
                    upah: document.getElementById("upah").value
                };

                console.log(formData);

                try {
                    const res = await fetch("http://localhost:8080/api/admin/barang", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Authorization": "Bearer {{ session('api_token') }}"
                        },
                        body: JSON.stringify(formData)
                    });

                    if (res.ok) {
                        // Menampilkan SweetAlert jika data berhasil ditambahkan
                        Swal.fire({
                            title: 'Berhasil!',
                            text: res.message,
                            icon: 'success',
                            confirmButtonText: 'Oke'
                        }).then(() => {
                            // Redirect setelah pop-up ditutup
                            window.location.href = "/admin/barang";
                        });
                    } else {
                        // Menampilkan SweetAlert jika ada error
                        Swal.fire({
                            title: 'Gagal!',
                            text: res.message || "Terjadi kesalahan",
                            icon: 'error',
                            confirmButtonText: 'Tutup'
                        });
                    }
                } catch (error) {
                    console.error("Error submitting data:", error);
                    Swal.fire({
                        title: 'Error!',
                        text: "Terjadi kesalahan saat mengirim data.",
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    });
                }
            });
        });
    </script>

</x-layout.adminPage>