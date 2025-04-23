<x-layout.userPage bodyClass="max-w-screen">
    <h1 class="w-full text-2xl font-light ml-2 sm:ml-0 mb-5 text-center">DASHBOARD</h1>
    <p class="hidden sm:block text-white text-center sm:text-xs bg-secondary-2 border border-black rounded-lg px-8 py-1 sm:px-0 sm:w-full sm:mb-8">SELAMAT DATANG "Username", ANDA LOGIN SEBAGAI "Role"</p>
    <div class="w-full h-71 sm:h-auto border-2 border-black rounded-xl flex sm:flex-wrap justify-between sm:justify-center mb-10 sm:py-8 sm:gap-8" style="box-shadow: 4px 4px 1px 0px rgba(0,0,0,0.25);">
        <div class="w-86 h-full flex justify-center items-center">
            <img src="{{ session('user')['foto_profile'] ? session('user')['foto_profile'] : asset('storage/profile_photos/default.jpg') }}" alt="" class="size-57 bg-primary-3 rounded-full object-cover object-center border-2 border-black">
        </div>
        <div class="h-full flex flex-grow flex-col justify-center items-center gap-8 sm:px-4">
            <h1 class="text-2xl">YOUR PROFILE</h1>
            <div class="w-full flex flex-col gap-3 pr-12">
                <div class="w-full flex justify-start items-center gap-4">
                    <Label class="font-light w-auto">NAMA :</Label>
                    <input type="text" name="nama" class="flex-grow border-b border-black" value="{{ session('user')['nama_lengkap'] }}" disabled>
                </div>
                <div class="w-full flex justify-start items-center gap-4">
                    <Label class="font-light w-auto">EMAIL :</Label>
                    <input type="text" name="nama" class="flex-grow border-b border-black" value="{{ session('user')['email'] }}" disabled>
                </div>
                <div class="w-full flex justify-start items-center gap-4">
                    <Label class="font-light w-auto">ROLE :</Label>
                    <input type="text" name="nama" class="flex-grow border-b border-black" value="{{ session('user')['role'] == 'StaffProduksi' ? 'Staff Produksi' : session('user')['role'] }}" disabled>

                </div>
            </div>
            <a href="staffProduksi/profile" class="w-full flex justify-start sm:justify-center"><button
                    class="w-53 h-8 rounded-full text-center font-light bg-secondary-2 text-white">Edit Your
                    Password</button></a>
        </div>
    </div>
    <div class="w-full flex items-center justify-between gap-6">
        <div class="py-14 px-8 pl-14 sm:py-12 sm:px-22 gap-14 sm:gap-8 flex sm:w-full sm:flex-wrap justify-between sm:justify-center items-center border border-black rounded-xl"
            style="box-shadow: 4px 4px 1px 0px rgba(0,0,0,0.25);">
            <img class="w-42 h-42" src="{{ asset('assets/img/logo/logoBgWhite.png') }}" alt="">
            <p class="w-86 font-light text-justify sm:text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
                eiusmod tempor incididunt ut</p>
        </div>
    </div>

</x-layout.userPage>