<x-layout.adminPage contentClass="flex flex-col justify-between items-center gap-7">
    <div class="w-full flex sm:flex-wrap-reverse justify-between items-center">
        <div class="w-189 h-71 sm:h-auto border sm:py-10 px-10 sm:px-4 border-black rounded-xl flex sm:flex-wrap justify-between sm:justify-center items-center gap-8">
            <div class="w-57 h-57 bg-primary-3 rounded-full border-2 border-black"></div>
            <div class="flex-grow sm:w-full h-full flex flex-col justify-center items-center gap-6">
                <h1 class="text-2xl">YOUR PROFILE</h1>
                <div class="w-full flex flex-col gap-3">
                    <div class="w-full flex justify-start items-center gap-4">
                        <Label class="font-light w-auto">NAMA :</Label>
                        <input type="text" name="nama" class="flex-grow border-b border-black">
                    </div>
                    <div class="w-full flex justify-start items-center gap-4">
                        <Label class="font-light w-auto">EMAIL :</Label>
                        <input type="text" name="nama" class="flex-grow border-b border-black">
                    </div>
                    <div class="w-full flex justify-start items-center gap-4">
                        <Label class="font-light w-auto">ROLE :</Label>
                        <input type="text" name="nama" class="flex-grow border-b border-black">
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-grow flex items-center justify-center ">
            <img class="w-49 h-49 sm:mx-auto sm:my-24" src="{{ asset('assets/img/logo/logoBgWhite.png') }}" alt="">
        </div>
    </div>

    <div class="w-full h-76 border border-black rounded-xl flex flex-col justify-between items-center gap-10 py-6"
        style="box-shadow: 4px 4px 4px 0px rgba(0,0,0,0.25);">
        <h1 class="text-2xl">EDIT YOUR PASSWORD</h1>
        <form action="" class="w-full px-8 flex flex-col justify-center items-start gap-4">
            <div class="w-full flex sm:flex-col justify-start items-center sm:items-start gap-4">
                <Label class="font-light w-auto">Old Password <span class="sm:hidden">:</span></Label>
                <input type="text" name="oldPassword" class="flex-grow sm:w-full border border-black rounded-md">
            </div>
            <div class="w-full flex sm:flex-col justify-start items-center sm:items-start gap-4">
                <Label class="font-light w-auto">New Password <span class="sm:hidden">:</span></Label>
                <input type="text" name="oldPassword" class="flex-grow sm:w-full border border-black rounded-md">
            </div>
            <div class="w-full flex sm:flex-col justify-start items-center sm:items-start gap-4">
                <Label class="font-light w-auto">New Password Confirmation <span class="sm:hidden">:</span></Label>
                <input type="text" name="oldPassword" class="flex-grow sm:w-full border border-black rounded-md">
            </div>
        </form>
        <div>
            <a href="">
                <button class="font-light text-white text-2xl sm:text-base w-43 sm:w-36 h-10 sm:h-10 rounded-full bg-custom-1">BACK</button>
            </a>
            <a href="">
                <button class="font-light text-white text-2xl sm:text-base w-43 sm:w-36 h-10 sm:h-10 rounded-full bg-secondary-2">Confirm</button>
            </a>
        </div>
    </div>
</x-layout.adminPage>
