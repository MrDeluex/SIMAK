<x-layout.adminPage contentClass="flex flex-col justify-start items-center">
    <h1 class="text-2xl font-reguler mb-10">Edit Kategori Barang</h1>
    <form action="" class="w-full" id="editForm">
        <div class="w-full p-10 flex flex-col justify-start items-start gap-8"
            style="box-shadow: 4px 0px 4px 0px rgba(0,0,0,0.25), -4px 0px 4px 0px rgba(0,0,0,0.25), 0px 4px 4px 0px rgba(0,0,0,0.25), 0px -4px 4px 0px rgba(0,0,0,0.25);">
            <input type="text" class="hidden" id="kategori_id">
            <!-- Nama Kategori -->
            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="text" placeholder="Nama Kategori" id="nama" name="nama"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label for=""
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Nama Kategori
                    </label>
                </div>
            </div>

            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="text" placeholder="Deskripsi" id="deskripsi" name="deskripsi"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label for=""
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Deskripsi
                    </label>
                </div>
            </div>

            <div class="w-full flex justify-between items-center">
                <a href="/admin/kategori"><button type="button" class="px-10 py-1 rounded bg-button-false text-white">Kembali</button></a>
                <button type="submit" class="px-10 py-1 rounded bg-button-true text-white">Update</button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let kategori = JSON.parse(sessionStorage.getItem("editKategori"));
            console.log(kategori);

            if (kategori) {
                document.getElementById("kategori_id").value = kategori.data.id;
                document.getElementById("nama").value = kategori.data.nama;
                document.getElementById("deskripsi").value = kategori.data.deskripsi;
            } else {
                alert("Data kategori tidak ditemukan!");
                window.location.href = "/admin/kategori"; // Redirect jika tidak ada data
            }

            document.getElementById("editForm").addEventListener("submit", async function(e) {
                e.preventDefault();

                let kategoriId = document.getElementById("kategori_id").value;
                let nama = document.getElementById("nama").value;
                let deskripsi = document.getElementById("deskripsi").value;

                let data = {
                    nama: nama,
                    deskripsi: deskripsi
                };

                try {
                    let response = await fetch(`http://localhost:8080/api/admin/kategori/${kategoriId}`, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "Authorization": "Bearer " + '{{ session("api_token") }}'
                        },
                        body: JSON.stringify(data)
                    });

                    let result = await response.json();


                    if (response.ok) {
                        // Menampilkan SweetAlert untuk keberhasilan pembaruan kategori
                        Swal.fire({
                            title: 'Berhasil!',
                            text: "Kategori berhasil diperbarui!",
                            icon: 'success',
                            confirmButtonText: 'Oke'
                        }).then(() => {
                            // Redirect ke halaman kategori setelah pop-up ditutup
                            window.location.href = "/admin/kategori";
                        });
                    } else {
                        // Menampilkan SweetAlert jika gagal memperbarui kategori
                        Swal.fire({
                            title: 'Gagal!',
                            text: "Gagal memperbarui kategori: " + (result.message || "Terjadi kesalahan"),
                            icon: 'error',
                            confirmButtonText: 'Tutup'
                        });
                    }
                } catch (error) {
                    // Menampilkan SweetAlert jika terjadi kesalahan dalam request
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