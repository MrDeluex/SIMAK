<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="api-token" content="{{ session('api_token') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo/logoBgWhite.png?v=1') }}">
    <title>{{ $title ?? 'SIMAK Admin' }}</title>
</head>

<body class="{{ $bodyClass ?? '' }}flex max-w-screen overflow-x-hidden pl-63 sm:pl-0">
    {{-- SIDEBAR --}}
    <section id="menu"
        class="z-50 bg-secondary-1 text-white w-63 h-screen fixed top-0 left-0 flex flex-col justify-start sm:-translate-x-full transition-transfom duration-300">
        <div class="bg-secondary-2 font-light flex flex-col justify-center items-center w-full h-53"
            style="box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);">
            <img class="w-24 mb-4" src="{{ asset('assets/img/logo/logoBgWhite.png') }}" alt="">
            <p>SISTEM MANAGEMEN</p>
            <div class="flex justify-between items-center w-full">
                <span class="w-18 h-1 bg-white"></span>
                KARYAWAN
                <span class="w-18 h-1 bg-white"></span>
            </div>
        </div>
        <div class="bg-secondary-2 w-full py-5 mt-12"
            style="box-shadow: 0 -4px 4px rgba(0, 0, 0, 0.25), 0 4px 4px rgba(0, 0, 0, 0.25);">
            <div class="w-full flex flex-col justify-start items-center gap-2">
                <a href="/admin/" class="w-full">
                    <div class="w-full h-10 px-3 flex justify-start items-center gap-6 hover:bg-secondary-1">
                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.25 15.0938H18.6875V18.6875H17.25V15.0938ZM14.375 11.5H15.8125V18.6875H14.375V11.5ZM7.90625 18.6875C6.95348 18.6864 6.04006 18.3074 5.36635 17.6337C4.69263 16.9599 4.31364 16.0465 4.3125 15.0938H5.75C5.75 15.5202 5.87646 15.9371 6.11339 16.2917C6.35033 16.6463 6.68709 16.9227 7.08109 17.0859C7.47509 17.2491 7.90864 17.2918 8.32691 17.2086C8.74518 17.1254 9.12939 16.92 9.43095 16.6184C9.73251 16.3169 9.93787 15.9327 10.0211 15.5144C10.1043 15.0961 10.0616 14.6626 9.89837 14.2686C9.73516 13.8746 9.45879 13.5378 9.1042 13.3009C8.7496 13.064 8.33272 12.9375 7.90625 12.9375V11.5C8.85937 11.5 9.77346 11.8786 10.4474 12.5526C11.1214 13.2265 11.5 14.1406 11.5 15.0938C11.5 16.0469 11.1214 16.961 10.4474 17.6349C9.77346 18.3089 8.85937 18.6875 7.90625 18.6875Z"
                                fill="white" />
                            <path
                                d="M20.125 1.4375H2.875C2.49375 1.4375 2.12812 1.58895 1.85853 1.85853C1.58895 2.12812 1.4375 2.49375 1.4375 2.875V20.125C1.4375 20.5062 1.58895 20.8719 1.85853 21.1415C2.12812 21.411 2.49375 21.5625 2.875 21.5625H20.125C20.5061 21.5619 20.8714 21.4103 21.1408 21.1408C21.4103 20.8714 21.5619 20.5061 21.5625 20.125V2.875C21.5625 2.49375 21.411 2.12812 21.1415 1.85853C20.8719 1.58895 20.5062 1.4375 20.125 1.4375ZM20.125 7.90625H10.0625V2.875H20.125V7.90625ZM8.625 2.875V7.90625H2.875V2.875H8.625ZM2.875 20.125V9.34375H20.125L20.1264 20.125H2.875Z"
                                fill="white" />
                        </svg>
                        <p>DASHBOARD</p>
                    </div>
                </a>
                <a href="/admin/users" class="w-full">
                    <div class="w-full h-10 px-3 flex justify-start items-center gap-6 hover:bg-secondary-1">
                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.4969 10.6632C9.61237 10.6632 8.74771 10.4009 8.01226 9.90949C7.27681 9.41808 6.70359 8.71961 6.3651 7.90242C6.02661 7.08523 5.93804 6.18601 6.1106 5.31849C6.28317 4.45096 6.7091 3.65409 7.33456 3.02864C7.96001 2.40318 8.75688 1.97725 9.62441 1.80468C10.4919 1.63212 11.3911 1.72069 12.2083 2.05918C13.0255 2.39767 13.724 2.97089 14.2154 3.70634C14.7068 4.44179 14.9691 5.30645 14.9691 6.19097C14.9691 7.37708 14.4979 8.51461 13.6592 9.35331C12.8205 10.192 11.683 10.6632 10.4969 10.6632ZM10.4969 3.04764C9.86509 3.04764 9.24748 3.23499 8.72216 3.586C8.19683 3.93701 7.78739 4.43592 7.54561 5.01962C7.30383 5.60333 7.24057 6.24563 7.36383 6.86529C7.48709 7.48495 7.79133 8.05415 8.23808 8.5009C8.68483 8.94765 9.25403 9.25189 9.87369 9.37515C10.4934 9.49841 11.1356 9.43515 11.7194 9.19337C12.3031 8.95159 12.802 8.54215 13.153 8.01682C13.504 7.4915 13.6913 6.87389 13.6913 6.24209C13.6913 5.82259 13.6087 5.40719 13.4482 5.01962C13.2876 4.63206 13.0523 4.2799 12.7557 3.98327C12.4591 3.68664 12.1069 3.45134 11.7194 3.2908C11.3318 3.13027 10.9164 3.04764 10.4969 3.04764ZM14.0555 11.4363C10.5981 10.6578 6.98098 11.0325 3.75662 12.5032C3.31316 12.715 2.93901 13.0485 2.67772 13.4647C2.41644 13.881 2.27879 14.3629 2.28078 14.8543V18.6557C2.28078 18.7396 2.29731 18.8227 2.32942 18.9002C2.36152 18.9777 2.40858 19.0481 2.46791 19.1075C2.52724 19.1668 2.59767 19.2138 2.67518 19.246C2.75269 19.2781 2.83577 19.2946 2.91967 19.2946C3.00357 19.2946 3.08665 19.2781 3.16416 19.246C3.24168 19.2138 3.31211 19.1668 3.37143 19.1075C3.43076 19.0481 3.47782 18.9777 3.50993 18.9002C3.54204 18.8227 3.55856 18.7396 3.55856 18.6557V14.8543C3.553 14.6056 3.62016 14.3607 3.75181 14.1496C3.88346 13.9385 4.07387 13.7704 4.29967 13.666C6.242 12.7689 8.35744 12.3087 10.4969 12.3179C11.6956 12.3165 12.8903 12.4581 14.0555 12.7396V11.4363ZM14.1449 17.5121H18.0677V18.4065H14.1449V17.5121Z" fill="white" />
                            <path d="M21.1919 13.7167H17.8888V14.9945H20.553V20.342H11.4999V14.9945H15.5249V15.2628C15.5249 15.4323 15.5923 15.5948 15.7121 15.7146C15.8319 15.8344 15.9944 15.9017 16.1638 15.9017C16.3333 15.9017 16.4958 15.8344 16.6156 15.7146C16.7354 15.5948 16.8027 15.4323 16.8027 15.2628V12.7776C16.8027 12.6081 16.7354 12.4456 16.6156 12.3258C16.4958 12.206 16.3333 12.1387 16.1638 12.1387C15.9944 12.1387 15.8319 12.206 15.7121 12.3258C15.5923 12.4456 15.5249 12.6081 15.5249 12.7776V13.7167H10.8611C10.6916 13.7167 10.5291 13.784 10.4093 13.9039C10.2895 14.0237 10.2222 14.1862 10.2222 14.3556V20.9809C10.2222 21.1503 10.2895 21.3128 10.4093 21.4327C10.5291 21.5525 10.6916 21.6198 10.8611 21.6198H21.1919C21.3613 21.6198 21.5238 21.5525 21.6437 21.4327C21.7635 21.3128 21.8308 21.1503 21.8308 20.9809V14.3556C21.8308 14.1862 21.7635 14.0237 21.6437 13.9039C21.5238 13.784 21.3613 13.7167 21.1919 13.7167Z" fill="white" />
                        </svg>
                        <p>DATA USER</p>
                    </div>
                </a>
                <a href="/admin/karyawan" class="w-full">
                    <div class="w-full h-10 px-3 flex justify-start items-center gap-6 hover:bg-secondary-1">
                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.4969 10.6632C9.61237 10.6632 8.74771 10.4009 8.01226 9.90949C7.27681 9.41808 6.70359 8.71961 6.3651 7.90242C6.02661 7.08523 5.93804 6.18601 6.1106 5.31849C6.28317 4.45096 6.7091 3.65409 7.33456 3.02864C7.96001 2.40318 8.75688 1.97725 9.62441 1.80468C10.4919 1.63212 11.3911 1.72069 12.2083 2.05918C13.0255 2.39767 13.724 2.97089 14.2154 3.70634C14.7068 4.44179 14.9691 5.30645 14.9691 6.19097C14.9691 7.37708 14.4979 8.51461 13.6592 9.35331C12.8205 10.192 11.683 10.6632 10.4969 10.6632ZM10.4969 3.04764C9.86509 3.04764 9.24748 3.23499 8.72216 3.586C8.19683 3.93701 7.78739 4.43592 7.54561 5.01962C7.30383 5.60333 7.24057 6.24563 7.36383 6.86529C7.48709 7.48495 7.79133 8.05415 8.23808 8.5009C8.68483 8.94765 9.25403 9.25189 9.87369 9.37515C10.4934 9.49841 11.1356 9.43515 11.7194 9.19337C12.3031 8.95159 12.802 8.54215 13.153 8.01682C13.504 7.4915 13.6913 6.87389 13.6913 6.24209C13.6913 5.82259 13.6087 5.40719 13.4482 5.01962C13.2876 4.63206 13.0523 4.2799 12.7557 3.98327C12.4591 3.68664 12.1069 3.45134 11.7194 3.2908C11.3318 3.13027 10.9164 3.04764 10.4969 3.04764ZM14.0555 11.4363C10.5981 10.6578 6.98098 11.0325 3.75662 12.5032C3.31316 12.715 2.93901 13.0485 2.67772 13.4647C2.41644 13.881 2.27879 14.3629 2.28078 14.8543V18.6557C2.28078 18.7396 2.29731 18.8227 2.32942 18.9002C2.36152 18.9777 2.40858 19.0481 2.46791 19.1075C2.52724 19.1668 2.59767 19.2138 2.67518 19.246C2.75269 19.2781 2.83577 19.2946 2.91967 19.2946C3.00357 19.2946 3.08665 19.2781 3.16416 19.246C3.24168 19.2138 3.31211 19.1668 3.37143 19.1075C3.43076 19.0481 3.47782 18.9777 3.50993 18.9002C3.54204 18.8227 3.55856 18.7396 3.55856 18.6557V14.8543C3.553 14.6056 3.62016 14.3607 3.75181 14.1496C3.88346 13.9385 4.07387 13.7704 4.29967 13.666C6.242 12.7689 8.35744 12.3087 10.4969 12.3179C11.6956 12.3165 12.8903 12.4581 14.0555 12.7396V11.4363ZM14.1449 17.5121H18.0677V18.4065H14.1449V17.5121Z" fill="white" />
                            <path d="M21.1919 13.7167H17.8888V14.9945H20.553V20.342H11.4999V14.9945H15.5249V15.2628C15.5249 15.4323 15.5923 15.5948 15.7121 15.7146C15.8319 15.8344 15.9944 15.9017 16.1638 15.9017C16.3333 15.9017 16.4958 15.8344 16.6156 15.7146C16.7354 15.5948 16.8027 15.4323 16.8027 15.2628V12.7776C16.8027 12.6081 16.7354 12.4456 16.6156 12.3258C16.4958 12.206 16.3333 12.1387 16.1638 12.1387C15.9944 12.1387 15.8319 12.206 15.7121 12.3258C15.5923 12.4456 15.5249 12.6081 15.5249 12.7776V13.7167H10.8611C10.6916 13.7167 10.5291 13.784 10.4093 13.9039C10.2895 14.0237 10.2222 14.1862 10.2222 14.3556V20.9809C10.2222 21.1503 10.2895 21.3128 10.4093 21.4327C10.5291 21.5525 10.6916 21.6198 10.8611 21.6198H21.1919C21.3613 21.6198 21.5238 21.5525 21.6437 21.4327C21.7635 21.3128 21.8308 21.1503 21.8308 20.9809V14.3556C21.8308 14.1862 21.7635 14.0237 21.6437 13.9039C21.5238 13.784 21.3613 13.7167 21.1919 13.7167Z" fill="white" />
                        </svg>
                        <p>DATA KARYAWAN</p>
                    </div>
                </a>
                <a href="/admin/upah" class="w-full">
                    <div class="w-full h-10 px-3 flex justify-start items-center gap-6 hover:bg-secondary-1">
                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.5 7.90625C10.7892 7.90625 10.0944 8.11702 9.50342 8.51191C8.91243 8.90679 8.45181 9.46806 8.17981 10.1247C7.9078 10.7814 7.83664 11.504 7.9753 12.2011C8.11397 12.8982 8.45624 13.5386 8.95883 14.0412C9.46143 14.5438 10.1018 14.886 10.7989 15.0247C11.496 15.1634 12.2186 15.0922 12.8753 14.8202C13.5319 14.5482 14.0932 14.0876 14.4881 13.4966C14.883 12.9056 15.0938 12.2108 15.0938 11.5C15.0938 10.5469 14.7151 9.63279 14.0412 8.95884C13.3672 8.28488 12.4531 7.90625 11.5 7.90625ZM11.5 13.6562C11.0735 13.6562 10.6566 13.5298 10.3021 13.2929C9.94746 13.0559 9.67109 12.7192 9.50788 12.3252C9.34468 11.9312 9.30198 11.4976 9.38518 11.0793C9.46838 10.6611 9.67374 10.2769 9.9753 9.9753C10.2769 9.67374 10.6611 9.46838 11.0793 9.38518C11.4976 9.30198 11.9312 9.34468 12.3252 9.50788C12.7192 9.67109 13.0559 9.94746 13.2929 10.3021C13.5298 10.6566 13.6562 11.0735 13.6562 11.5C13.6562 12.0719 13.4291 12.6203 13.0247 13.0247C12.6203 13.4291 12.0719 13.6562 11.5 13.6562ZM21.5625 5.03125H1.4375C1.24688 5.03125 1.06406 5.10698 0.929267 5.24177C0.794475 5.37656 0.71875 5.55938 0.71875 5.75V17.25C0.71875 17.4406 0.794475 17.6234 0.929267 17.7582C1.06406 17.893 1.24688 17.9688 1.4375 17.9688H21.5625C21.7531 17.9688 21.9359 17.893 22.0707 17.7582C22.2055 17.6234 22.2812 17.4406 22.2812 17.25V5.75C22.2812 5.55938 22.2055 5.37656 22.0707 5.24177C21.9359 5.10698 21.7531 5.03125 21.5625 5.03125ZM17.3982 16.5312H5.60176C5.36044 15.7151 4.91877 14.9723 4.31698 14.3705C3.71518 13.7687 2.97239 13.3271 2.15625 13.0857V9.91426C2.97239 9.67294 3.71518 9.23127 4.31698 8.62948C4.91877 8.02768 5.36044 7.28489 5.60176 6.46875H17.3982C17.6396 7.28489 18.0812 8.02768 18.683 8.62948C19.2848 9.23127 20.0276 9.67294 20.8438 9.91426V13.0857C20.0276 13.3271 19.2848 13.7687 18.683 14.3705C18.0812 14.9723 17.6396 15.7151 17.3982 16.5312ZM20.8438 8.38871C19.9816 8.01809 19.2944 7.33091 18.9238 6.46875H20.8438V8.38871ZM4.07621 6.46875C3.70559 7.33091 3.01841 8.01809 2.15625 8.38871V6.46875H4.07621ZM2.15625 14.6113C3.01841 14.9819 3.70559 15.6691 4.07621 16.5312H2.15625V14.6113ZM18.9238 16.5312C19.2944 15.6691 19.9816 14.9819 20.8438 14.6113V16.5312H18.9238Z" fill="#F7F7F7" />
                        </svg>
                        <p>DATA UPAH KARYAWAN</p>
                    </div>
                </a>
                <a href="/admin/harian" class="w-full">
                    <div class="w-full h-10 px-3 flex justify-start items-center gap-6 hover:bg-secondary-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.50009 3.5C5.94409 3.547 5.01709 3.72 4.37509 4.362C3.49609 5.242 3.49609 6.657 3.49609 9.488V15.994C3.49609 18.826 3.49609 20.241 4.37509 21.121C5.25309 22 6.66809 22 9.49609 22H14.4961C17.3251 22 18.7391 22 19.6171 21.12C20.4971 20.241 20.4971 18.826 20.4971 15.994V9.488C20.4971 6.658 20.4971 5.242 19.6171 4.362C18.9761 3.72 18.0481 3.547 16.4921 3.5" stroke="#FFFCFC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M13.5 11H17M7 12C7 12 7.5 12 8 13C8 13 9.588 10.5 11 10M13.5 17H17M8 17H9M7.496 3.75C7.496 2.784 8.28 2 9.246 2H14.746C15.2101 2 15.6552 2.18437 15.9834 2.51256C16.3116 2.84075 16.496 3.28587 16.496 3.75C16.496 4.21413 16.3116 4.65925 15.9834 4.98744C15.6552 5.31563 15.2101 5.5 14.746 5.5H9.246C8.78187 5.5 8.33675 5.31563 8.00856 4.98744C7.68037 4.65925 7.496 4.21413 7.496 3.75Z" stroke="#FFFCFC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p>DATA BARANG HARIAN</p>
                    </div>
                </a>
                <a href="/admin/barang" class="w-full">
                    <div class="w-full h-10 px-3 flex justify-start items-center gap-6 hover:bg-secondary-1">
                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.4998 1.19824C10.92 1.19824 10.3863 1.34199 9.80263 1.58349C9.23817 1.81733 8.58267 2.16137 7.76713 2.58974L5.7853 3.62953C4.78384 4.1547 3.98363 4.57541 3.36359 4.98845C2.72342 5.41683 2.22892 5.86724 1.86955 6.4777C1.51113 7.08624 1.35013 7.74558 1.2725 8.53045C1.19775 9.29233 1.19775 10.2286 1.19775 11.4074V11.5933C1.19775 12.772 1.19775 13.7083 1.2725 14.4702C1.35013 15.256 1.51209 15.9144 1.86955 16.5229C2.22892 17.1334 2.72246 17.5838 3.36455 18.0122C3.98267 18.4252 4.78384 18.8459 5.7853 19.3711L7.76713 20.4109C8.58267 20.8393 9.23817 21.1833 9.80263 21.4172C10.3872 21.6587 10.92 21.8024 11.4998 21.8024C12.0796 21.8024 12.6134 21.6587 13.197 21.4172C13.7615 21.1833 14.417 20.8393 15.2325 20.4109L17.2144 19.3721C18.2158 18.846 19.016 18.4252 19.6351 18.0122C20.2772 17.5838 20.7708 17.1334 21.1301 16.5229C21.4885 15.9144 21.6495 15.2551 21.7272 14.4702C21.8019 13.7083 21.8019 12.772 21.8019 11.5942V11.4064C21.8019 10.2286 21.8019 9.29233 21.7272 8.53045C21.6495 7.74462 21.4876 7.08624 21.1301 6.4777C20.7708 5.86724 20.2772 5.41683 19.6351 4.98845C19.017 4.57541 18.2158 4.1547 17.2144 3.62953L15.2325 2.58974C14.417 2.16137 13.7615 1.81733 13.197 1.58349C12.6125 1.34199 12.0796 1.19824 11.4998 1.19824ZM8.40442 3.87774C9.25734 3.4302 9.85534 3.11778 10.3518 2.9127C10.8348 2.71241 11.175 2.63574 11.4998 2.63574C11.8257 2.63574 12.1649 2.71241 12.6479 2.9127C13.1443 3.11778 13.7414 3.4302 14.5943 3.87774L16.511 4.88399C17.5555 5.4312 18.2887 5.81741 18.8378 6.18349C19.108 6.36462 19.3198 6.53233 19.4923 6.70099L16.3001 8.29662L8.1543 4.00903L8.40442 3.87774ZM6.65546 4.79583L6.48871 4.88399C5.44413 5.4312 4.711 5.81741 4.16284 6.18349C3.92911 6.33537 3.70999 6.50861 3.5083 6.70099L11.4998 10.6972L14.717 9.08724L6.85288 4.94916C6.77913 4.90919 6.71244 4.85739 6.65546 4.79583ZM2.81542 7.9612C2.7675 8.16628 2.73013 8.39916 2.7033 8.67037C2.63621 9.35462 2.63525 10.22 2.63525 11.4438V11.5559C2.63525 12.7807 2.63525 13.646 2.7033 14.3293C2.76942 14.9973 2.89496 15.4295 3.10867 15.7937C3.32142 16.155 3.62905 16.4607 4.16284 16.8172C4.711 17.1832 5.44413 17.5695 6.48871 18.1167L8.40538 19.1229C9.2583 19.5704 9.85534 19.8829 10.3518 20.0879C10.5076 20.1525 10.6508 20.2052 10.7811 20.2461V11.944L2.81542 7.9612ZM12.2186 20.2451C12.3489 20.2049 12.492 20.1525 12.6479 20.0879C13.1443 19.8829 13.7414 19.5704 14.5943 19.1229L16.511 18.1167C17.5555 17.5685 18.2887 17.1832 18.8378 16.8172C19.3706 16.4607 19.6783 16.155 19.892 15.7937C20.1057 15.4295 20.2303 14.9982 20.2964 14.3293C20.3635 13.646 20.3644 12.7807 20.3644 11.5569V11.4447C20.3644 10.22 20.3644 9.35462 20.2964 8.67133C20.2738 8.43283 20.2364 8.19598 20.1843 7.96216L17.0103 9.5482V12.4587C17.0103 12.6493 16.9345 12.8321 16.7997 12.9669C16.6649 13.1017 16.4821 13.1774 16.2915 13.1774C16.1009 13.1774 15.9181 13.1017 15.7833 12.9669C15.6485 12.8321 15.5728 12.6493 15.5728 12.4587V10.2679L12.2186 11.945V20.2451Z" fill="white" />
                        </svg>
                        <p>DATA BARANG</p>
                    </div>
                </a>
                <a href="/admin/kategori" class="w-full">
                    <div class="w-full h-10 px-3 flex justify-start items-center gap-6 hover:bg-secondary-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 11V2H11V11H2ZM2 13H11V22H2V13ZM13 2V11H22V2H13ZM13 22V13H22V22H13Z" fill="white" />
                        </svg>
                        <p>DATA KATEGORI</p>
                    </div>
                </a>
                <a href="/admin/activity" class="w-full">
                    <div class="w-full h-10 px-3 flex justify-start items-center gap-6 hover:bg-secondary-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 12H19.52C19.083 11.9991 18.6577 12.1413 18.3091 12.405C17.9606 12.6686 17.708 13.0392 17.59 13.46L15.24 21.82C15.2249 21.8719 15.1933 21.9175 15.15 21.95C15.1067 21.9825 15.0541 22 15 22C14.9459 22 14.8933 21.9825 14.85 21.95C14.8067 21.9175 14.7751 21.8719 14.76 21.82L9.24 2.18C9.22485 2.12807 9.19327 2.08246 9.15 2.05C9.10673 2.01754 9.05409 2 9 2C8.94591 2 8.89327 2.01754 8.85 2.05C8.80673 2.08246 8.77515 2.12807 8.76 2.18L6.41 10.54C6.29246 10.9592 6.04138 11.3285 5.69486 11.592C5.34835 11.8555 4.92532 11.9988 4.49 12H2" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p>ACTIVITY LOG</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="flex justify-center items-center w-full py-8">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M5 21C4.45 21 3.97933 20.8043 3.588 20.413C3.19667 20.0217 3.00067 19.5507 3 19V5C3 4.45 3.196 3.97933 3.588 3.588C3.98 3.19667 4.45067 3.00067 5 3H12V5H5V19H12V21H5ZM16 17L14.625 15.55L17.175 13H9V11H17.175L14.625 8.45L16 7L21 12L16 17Z"
                    fill="white" />
            </svg>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" id="logoutButton" class="">Log Out</button>
            </form>
        </div>
    </section>

    <section class="w-full">
        <nav id="navbar"
            class="z-40 w-full bg-white sm:fixed sm:top-0 h-15 px-10 sm:px-6 flex sm:justify-between justify-end items-center "
            style="box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);">
            <button id="menu-toggle" class="sm:block hidden focus:outline-none">
                <svg class="w-8 h-8" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.33334 6.5H21.6667M4.33334 10.8333H21.6667M4.33334 15.1667H21.6667M4.33334 19.5H21.6667"
                        stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <div class="flex justify-end items-center gap-3 h-full">
                <div class="flex flex-col justify-center items-center sm:items-end">
                    <h1 id="namaUserDisplay"></h1>
                    <p class="text-sm text-opacity-70" id="roleUserDisplay"></p>
                </div>
                <a href="/admin/profile">
                    <img class="aspect-1/1 w-11 bg-primary-1 rounded-full object-cover"
                        src="">
                </a>
            </div>
        </nav>

        <div class="w-full p-5 sm:mt-15 {{ $contentClass ?? '' }}">
            <h1 class="text-2xl font-light mb-4 mt-10">UPAH KARYAWAN</h1>

            <div class="w-full flex justify-between">
                <a href="/admin/upah/create">
                    <button class="font-light w-68 py-1 bg-button-true text-white rounded-xl mb-6">INPUT BARANG</button>
                </a>

                <button id="downloadAllPdfBtn" class="font-light w-50 py-1 bg-button-false text-white rounded-xl mb-6">Export Laporan</button>

            </div>

            <div id="app" class="py-8"
                style="box-shadow: 4px 0px 4px 0px rgba(0,0,0,0.25), -4px 0px 4px 0px rgba(0,0,0,0.25), 0px 4px 4px 0px rgba(0,0,0,0.25), 0px -4px 4px 0px rgba(0,0,0,0.25);">
                <div class="w-full flex sm:flex-wrap-reverse justify-between items-center mb-10 gap-5 px-3">
                    <div class="">
                        <label for="entries" class="mr-2">Show</label>
                        <select id="entries" onchange="fetchData()" class="border border-gray-300 px-2 rounded">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="100">100</option>
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
                        <thead class="bg-custom-1 text-white">
                            <tr>
                                <th style="width: 5%;" class="text-center">ID</th>
                                <th style="width: 35%;">Nama Karyawan</th>
                                <th style="width: 10%;" class="text-center">Minggu Ke</th>
                                <th style="width: 25%;" class="text-center sm:hidden">Total Upah</th>
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
        </div>

    </section>



    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('menu');
        const body = document.querySelector('body');

        menuToggle.addEventListener('click', () => {
            console.log("clicked");
            sidebar.classList.toggle('sm:-translate-x-full')
        });

        body.addEventListener('click', (e) => {
            if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                sidebar.classList.add('sm:-translate-x-full')
            }
        });

        sidebar.addEventListener('click', (e) => {
            e.stopPropagation();
        });


        let lastScrollY = window.scrollY;

        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');

            if (window.scrollY > lastScrollY) {
                navbar.classList.add('-translate-y-full');
            } else {
                navbar.classList.remove('-translate-y-full');
            }
            lastScrollY = window.scrollY;
        });
    </script>

</body>

</html>