@extends('frontend.layouts.master')

@section('title', 'Home')

@section('css')
<style>
    .absolute img{
        height: 50px !important;
    }
    .absolute .text-xs{
        color: #fff !important;
    }
</style>
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
    <div class="relative">
        <h4 class="text-white text-center pt-5 text-sm font-semibold" style="font-size: 2rem;">
            {{ \App\Helpers\Helper::getCompanyName() }}
        </h4>
        <div
            class="absolute -left-[53%] -top-[620px] min-[370px]:-top-[650px] min-[380px]:-top-[680px] min-[400px]:-top-[720px] min-[420px]:-top-[750px]">
            <div
                class="flex justify-around items-center rounded-full relative rotate-0 circleSliders duration-700 max-[430px]:size-[209vw] size-[900px]">
                <a href=""
                    class="flex flex-col justify-center items-center text-center gap-3 absolute -left-[1%] bottom-[35%] rotate-[58deg]">
                    <img src="{{ asset('frontAssets/images/coins/bitcoin.png') }}" alt="BTC" class="" />
                    <p class="text-xs font-semibold dark:text-white">BTC</p>
                </a>
                <div
                    class="flex flex-col justify-center items-center text-center gap-3 absolute left-[2%] bottom-[24%] rotate-[58deg]">
                    <img src="{{ asset('frontAssets/images/coins/etherium.png') }}" alt="ETH" class="" />
                    <p class="text-xs font-semibold dark:text-white">ETH</p>
                </div>
                <div
                    class="flex flex-col justify-center items-center text-center gap-3 absolute left-[7%] bottom-[14.5%] rotate-[58deg]">
                    <img src="{{ asset('frontAssets/images/coins/solana.png') }}" alt="SOL" class="" />
                    <p class="text-xs font-semibold dark:text-white">
                        SOL
                    </p>
                </div>
                <div
                    class="flex flex-col justify-center items-center text-center gap-3 absolute left-[15.5%] bottom-[7.5%] rotate-[58deg]">
                    <img src="{{ asset('frontAssets/images/coins/binance-coin.png') }}" alt="" class="" />
                    <p class="text-xs font-semibold dark:text-white">
                        BNB
                    </p>
                </div>

                <div class="flex flex-col justify-center items-center text-center gap-3 absolute left-[29%] bottom-0">
                    <img src="{{ asset('frontAssets/images/coins/bitcoin.png') }}" alt="BTC" class="" />
                    <p class="text-xs font-semibold dark:text-white">BTC</p>
                </div>
                <div class="flex flex-col justify-center items-center text-center gap-3 absolute left-[39.5%] -bottom-[3%]">
                    <img src="{{ asset('frontAssets/images/coins/etherium.png') }}" alt="ETH" class="" />
                    <p class="text-xs font-semibold dark:text-white">ETH</p>
                </div>
                <div class="flex flex-col justify-center items-center text-center gap-3 absolute right-[40.5%] -bottom-[3%]">
                    <img src="{{ asset('frontAssets/images/coins/solana.png') }}" alt="SOL" class="" />
                    <p class="text-xs font-semibold dark:text-white">
                        SOL
                    </p>
                </div>
                <div class="flex flex-col justify-center items-center text-center gap-3 absolute right-[31%] bottom-0">
                    <img src="{{ asset('frontAssets/images/coins/binance-coin.png') }}" alt="BNB" class="" />
                    <p class="text-xs font-semibold dark:text-white">
                        BNB
                    </p>
                </div>

                <div class="flex flex-col justify-center items-center text-center gap-3 absolute right-[16.5%] bottom-[6.5%] rotate-[-58deg]">
                    <img src="{{ asset('frontAssets/images/coins/bitcoin.png') }}" alt="BTC" class="" />
                    <p class="text-xs font-semibold dark:text-white">BTC</p>
                </div>
                <div
                    class="flex flex-col justify-center items-center text-center gap-3 absolute right-[8%] bottom-[13%] rotate-[-58deg]">
                    <img src="{{ asset('frontAssets/images/coins/etherium.png') }}" alt="ETH" class="" />
                    <p class="text-xs font-semibold dark:text-white">ETH</p>
                </div>
                <div
                    class="flex flex-col justify-center items-center text-center gap-3 absolute right-[2%] bottom-[23.5%] rotate-[-58deg]">
                    <img src="{{ asset('frontAssets/images/coins/solana.png') }}" alt="SOL" class="" />
                    <p class="text-xs font-semibold dark:text-white">
                        SOL
                    </p>
                </div>
                <div
                    class="flex flex-col justify-center items-center text-center gap-3 absolute right-0 bottom-[34%] rotate-[-58deg]">
                    <img src="{{ asset('frontAssets/images/coins/binance-coin.png') }}" alt="" class="" />
                    <p class="text-xs font-semibold dark:text-white">BNB</p>
                </div>
            </div>
        </div>
        <div class="flex justify-start items-center gap-1 flex-col pt-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="202" height="202">
                <path
                    d="M76.388 165.94C75.9671 167.043 74.7305 167.599 73.6407 167.145C70.8225 165.972 68.0826 164.618 65.4379 163.094C64.4153 162.504 64.1052 161.184 64.7252 160.18V160.18C65.3453 159.175 66.6606 158.867 67.6844 159.454C70.0989 160.84 72.5974 162.074 75.1655 163.149C76.2544 163.605 76.8088 164.837 76.388 165.94V165.94Z"
                    fill="#141414" fill-opacity="0.16" id="itemLeft" />
                <path
                    d="M124.225 166.48C124.629 167.59 124.057 168.82 122.936 169.19C110.033 173.452 96.1783 173.936 83.0093 170.584C81.8653 170.293 81.2096 169.106 81.535 167.971V167.971C81.8604 166.836 83.0434 166.184 84.1878 166.473C96.4884 169.579 109.42 169.127 121.474 165.171C122.595 164.803 123.821 165.371 124.225 166.48V166.48Z"
                    fill="#FF710F" id="itemCenter" />

                <path
                    d="M141.502 157.326C142.203 158.276 142.002 159.617 141.031 160.288C138.52 162.024 135.9 163.597 133.187 164.996C132.138 165.537 130.86 165.084 130.35 164.02V164.02C129.84 162.955 130.291 161.682 131.339 161.139C133.811 159.858 136.2 158.424 138.493 156.845C139.465 156.176 140.802 156.376 141.502 157.326V157.326Z"
                    fill="#141414" fill-opacity="0.16" id="itemRight" />
            </svg>
        </div>
    </div>

    <div class="px-6">
        <div
            class="px-4 bg-p2 flex justify-between items-center rounded-2xl relative after:absolute after:h-full after:left-2 after:right-2 after:bg-p2 after:mt-6 after:opacity-30 after:rounded-2xl after:-z-10 before:absolute before:h-full before:bg-p2 before:mt-12 before:opacity-30 before:rounded-2xl before:-z-10 before:left-4 before:right-4">
            <div class="text-white font-semibold !leading-none pl-2">
                <p class="">Invite Friends</p>
                <p class="text-[36px] py-2 pl-2">$80</p>
                <p class="pl-7">Earn Up To</p>
            </div>
            <div class="">
                <img src="{{ asset('frontAssets/images/invite_illus.png') }}" alt="" />
            </div>
        </div>
    </div>

    <div class="pt-12 px-6">
        <div class="flex justify-between items-center">
            <div class="flex justify-start items-center gap-2">
                <i class="ph-fill text-xl ph-trophy text-p1"></i>
                <h3 class="text-xl font-semibold">Current Contest</h3>
            </div>
            <a href="./upcoming-contest.html" class="text-p1 font-semibold text-sm">See All</a>
        </div>
        <div class="pt-5">
            <a href="./quiz-details.html" class="rounded-2xl overflow-hidden shadow2 block">
                <div class="flex justify-between items-center py-3.5 px-5 bg-p2 bg-opacity-20 dark:bg-bgColor16">
                    <div class="flex justify-start items-center gap-3">
                        <p class="font-medium">Starting In</p>
                        <div class="flex justify-start items-center gap-1">
                            <p
                                class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                                05
                            </p>
                            <p class="text-p2 text-base font-semibold dark:text-white">
                                :
                            </p>
                            <p
                                class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                                14
                            </p>
                            <p class="text-p2 text-base font-semibold dark:text-white">
                                :
                            </p>
                            <p
                                class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                                20
                            </p>
                        </div>
                    </div>
                    <p class="text-xs text-p1">Read Instruction</p>
                </div>
                <div class="p-5 bg-white dark:bg-color10">
                    <div class="flex justify-start items-center gap-2">
                        <div class="py-1 px-2 text-white bg-p2 rounded-lg dark:bg-p1 dark:text-black">
                            <p class="font-semibold text-xs">19 Jun</p>
                            <p class="text-[10px]">04.32</p>
                        </div>
                        <div class="">
                            <p class="font-semibold text-sm">Browse By Category</p>
                            <p class="text-xs">Language - English , Hindi</p>
                        </div>
                    </div>
                    <div
                        class="flex justify-between items-center text-xs py-5 border-b border-dashed border-black border-opacity-10 dark:border-color24">
                        <div class="">
                            <p>Max Time</p>
                            <p class="font-semibold">5 min</p>
                        </div>
                        <div class="">
                            <p>Max Ques</p>
                            <p class="font-semibold">v</p>
                        </div>
                        <div class="">
                            <p>No of Contest</p>
                            <p class="font-semibold">1</p>
                        </div>
                    </div>
                    <div class="pt-5 flex justify-between items-center">
                        <div class="flex justify-start items-center gap-1">
                            <i class="ph ph-brain text-p2"></i>
                            <p class="text-xs">Trivia Quiz</p>
                        </div>
                        <div class="flex justify-start items-center gap-2">
                            <i class="ph ph-bell-ringing"></i>
                            <i class="ph ph-share-network"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="pt-12 pl-6">
        <div class="flex justify-between items-center pr-6">
            <div class="flex justify-start items-center gap-2">
                <i class="ph-fill text-xl ph-trophy text-p1"></i>
                <h3 class="text-xl font-semibold">Best Players</h3>
            </div>
            <a href="./players.html" class="text-p1 font-semibold text-sm">See All</a>
        </div>
        <div class="pt-5 swiper best-player-slider">
            <div class="swiper-wrapper">
                <div
                    class="p-4 rounded-xl border border-black border-opacity-10 bg-white shadow2 swiper-slide dark:bg-color9 dark:border-color24">
                    <div
                        class="flex justify-between items-center pb-3 border-b border-dashed border-black border-opacity-10">
                        <div
                            class="bg-p2 bg-opacity-10 border border-p2 border-opacity-20 py-1 px-3 flex justify-start items-center gap-1 rounded-full dark:bg-bgColor14 dark:border-bgColor16">
                            <i class="ph-fill ph-trophy text-p1"></i>
                            <p class="text-xs font-semibold text-p2 dark:text-white">
                                #1
                            </p>
                        </div>
                        <img src="{{ asset('frontAssets/images/Flags1.png') }}" alt="" />
                    </div>
                    <div class="flex flex-col justify-center items-center pt-4">
                        <div class="relative size-24 flex justify-center items-center">
                            <img src="{{ asset('frontAssets/images/user-img-1.png') }}" alt="" class="size-[68px] rounded-full" />
                            <img src="{{ asset('frontAssets/images/user-progress.svg') }}" alt="" class="absolute top-0 left-0" />
                            <img src="{{ asset('frontAssets/images/medal1.svg') }}" alt=""
                                class="absolute -bottom-1.5 left-9 size-7" />
                        </div>
                        <a href="./user-profile.html" class="text-xs font-semibold text-color8 dark:text-white pt-4">
                            ShadowStriker
                        </a>
                        <p class="text-color8 pt-1 pb-4 dark:text-white text-xs">
                            1060 XP
                        </p>
                        <button class="text-white text-xs bg-p2 py-1 px-4 rounded-full dark:bg-p1">
                            Follow
                        </button>
                    </div>
                </div>
                <div
                    class="p-4 rounded-xl border border-black border-opacity-10 bg-white shadow2 swiper-slide dark:bg-color9 dark:border-color24">
                    <div
                        class="flex justify-between items-center pb-3 border-b border-dashed border-black border-opacity-10">
                        <div
                            class="bg-p2 bg-opacity-10 border border-p2 border-opacity-20 py-1 px-3 flex justify-start items-center gap-1 rounded-full dark:bg-bgColor14 dark:border-bgColor16">
                            <i class="ph-fill ph-trophy text-p1"></i>
                            <p class="text-xs font-semibold text-p2 dark:text-white">
                                #2
                            </p>
                        </div>
                        <img src="{{ asset('frontAssets/images/Flags2.png') }}" alt="" />
                    </div>
                    <div class="flex flex-col justify-center items-center pt-4">
                        <div class="relative size-24 flex justify-center items-center">
                            <img src="{{ asset('frontAssets/images/user-img-2.png') }}" alt="" class="size-[68px] rounded-full" />
                            <img src="{{ asset('frontAssets/images/user-progress.svg') }}" alt="" class="absolute top-0 left-0" />
                            <img src="{{ asset('frontAssets/images/medal2.svg') }}" alt=""
                                class="absolute -bottom-1.5 left-9 size-7" />
                        </div>
                        <a href="./user-profile.html" class="text-xs font-semibold text-color8 dark:text-white pt-4">
                            BlazeKnight
                        </a>
                        <p class="text-color8 pt-1 pb-4 dark:text-white text-xs">
                            660 XP
                        </p>
                        <button class="text-white text-xs bg-p2 py-1 px-4 rounded-full dark:bg-p1">
                            Follow
                        </button>
                    </div>
                </div>
                <div
                    class="p-4 rounded-xl border border-black border-opacity-10 bg-white shadow2 swiper-slide dark:bg-color9 dark:border-color24">
                    <div
                        class="flex justify-between items-center pb-3 border-b border-dashed border-black border-opacity-10">
                        <div
                            class="bg-p2 bg-opacity-10 border border-p2 border-opacity-20 py-1 px-3 flex justify-start items-center gap-1 rounded-full dark:bg-bgColor14 dark:border-bgColor16">
                            <i class="ph-fill ph-trophy text-p1"></i>
                            <p class="text-xs font-semibold text-p2 dark:text-white">
                                #3
                            </p>
                        </div>
                        <img src="{{ asset('frontAssets/images/GB.png') }}" alt="" />
                    </div>
                    <div class="flex flex-col justify-center items-center pt-4">
                        <div class="relative size-24 flex justify-center items-center">
                            <img src="{{ asset('frontAssets/images/user-img-3.png') }}" alt="" class="size-[68px] rounded-full" />
                            <img src="{{ asset('frontAssets/images/user-progress.svg') }}" alt="" class="absolute top-0 left-0" />
                            <img src="{{ asset('frontAssets/images/medal3.svg') }}" alt=""
                                class="absolute -bottom-1.5 left-9 size-7" />
                        </div>
                        <a href="./user-profile.html" class="text-xs font-semibold text-color8 dark:text-white pt-4">
                            ShadowStriker
                        </a>
                        <p class="text-color8 pt-1 pb-4 dark:text-white text-xs">
                            2060 XP
                        </p>
                        <button class="text-white text-xs bg-p2 py-1 px-4 rounded-full dark:bg-p1">
                            Follow
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-12 pl-6">
        <div class="flex justify-between items-center pr-6">
            <div class="flex justify-start items-center gap-2">
                <h3 class="text-xl font-semibold">Upcoming Contest</h3>
            </div>
            <a href="./upcoming-contest.html" class="text-p1 font-semibold text-sm">See All</a>
        </div>
        <div class="pt-5 swiper upcoming-contest-slider">
            <div class="swiper-wrapper">
                <a href="./quiz-details.html"
                    class="rounded-2xl overflow-hidden shadow2 swiper-slide border border-color21">
                    <div class="p-5 bg-white dark:bg-color10">
                        <div class="flex justify-between items-center">
                            <div class="flex justify-start items-center gap-2">
                                <div class="py-1 px-2 text-white bg-p2 rounded-lg dark:bg-p1 dark:text-black">
                                    <p class="font-semibold text-xs">19 Jun</p>
                                    <p class="text-[10px]">04.32</p>
                                </div>
                                <div class="">
                                    <p class="font-semibold text-xs">
                                        English Language Quiz
                                    </p>
                                    <p class="text-xs">Language - English</p>
                                </div>
                            </div>
                            <div class="flex justify-start items-center gap-1">
                                <p
                                    class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                                    05
                                </p>
                                <p class="text-p2 text-base font-semibold dark:text-p1">
                                    :
                                </p>
                                <p
                                    class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                                    14
                                </p>
                                <p class="text-p2 text-base font-semibold dark:text-p1">
                                    :
                                </p>
                                <p
                                    class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                                    20
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center text-xs pt-5">
                            <div class="flex gap-2">
                                <p>Max Time</p>
                                <p class="font-semibold">- 5 min</p>
                            </div>
                            <div class="flex gap-3">
                                <p>Max Ques</p>
                                <p class="font-semibold">- 20</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center gap-2 text-xs py-3 text-nowrap">
                            <p>30 left</p>
                            <div
                                class="relative bg-p2 dark:bg-p1 dark:bg-opacity-10 bg-opacity-10 h-1 w-full rounded-full after:absolute after:h-1 after:w-[40%] after:bg-p2 after:dark:bg-p1 after:rounded-full">
                            </div>
                            <p>100 spots</p>
                        </div>
                        <div
                            class="border-b border-dashed border-black dark:border-color24 border-opacity-10 pb-5 flex justify-between items-center text-xs">
                            <div class="flex justify-start items-center gap-2">
                                <div class="text-white flex justify-center items-center p-2 bg-p1 rounded-full">
                                    <i class="ph ph-trophy"></i>
                                </div>
                                <div class="">
                                    <p>Price Pool</p>
                                    <p class="font-semibold">$100</p>
                                </div>
                            </div>
                            <div class="flex justify-start items-center gap-2">
                                <button class="text-white text-xs bg-p2 py-1 px-4 rounded-full dark:bg-p1">
                                    Join Now
                                </button>
                                <div class="">
                                    <p>Entry</p>
                                    <p class="font-semibold">$2.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="pt-5 flex justify-between items-center">
                            <div class="flex justify-start items-center gap-1">
                                <i class="ph ph-brain text-p2"></i>
                                <p class="text-xs">Trivia Quiz</p>
                            </div>
                            <div class="flex justify-start items-center gap-2">
                                <i class="ph ph-bell-ringing"></i>
                                <i class="ph ph-share-network"></i>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="./quiz-details.html"
                    class="rounded-2xl overflow-hidden shadow2 swiper-slide border border-color21">
                    <div class="p-5 bg-white dark:bg-color10">
                        <div class="flex justify-between items-center">
                            <div class="flex justify-start items-center gap-2">
                                <div class="py-1 px-2 text-white bg-p2 rounded-lg dark:bg-p1 dark:text-black">
                                    <p class="font-semibold text-xs">20 Jun</p>
                                    <p class="text-[10px]">05.25</p>
                                </div>
                                <div class="">
                                    <p class="font-semibold text-xs">China Language Quiz</p>
                                    <p class="text-xs">Language - English</p>
                                </div>
                            </div>
                            <div class="flex justify-start items-center gap-1">
                                <p
                                    class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                                    03
                                </p>
                                <p class="text-p2 text-base font-semibold dark:text-p1">
                                    :
                                </p>
                                <p
                                    class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                                    12
                                </p>
                                <p class="text-p2 text-base font-semibold dark:text-p1">
                                    :
                                </p>
                                <p
                                    class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                                    16
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center text-xs pt-5">
                            <div class="flex gap-2">
                                <p>Max Time</p>
                                <p class="font-semibold">- 5 min</p>
                            </div>
                            <div class="flex gap-3">
                                <p>Max Ques</p>
                                <p class="font-semibold">- 20</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center gap-2 text-xs py-3 text-nowrap">
                            <p>45 left</p>
                            <div
                                class="relative bg-p2 dark:bg-p1 dark:bg-opacity-10 bg-opacity-10 h-1 w-full rounded-full after:absolute after:h-1 after:w-[20%] after:bg-p2 after:dark:bg-p1 after:rounded-full">
                            </div>
                            <p>100 spots</p>
                        </div>
                        <div
                            class="border-b border-dashed border-black dark:border-color24 border-opacity-10 pb-5 flex justify-between items-center text-xs">
                            <div class="flex justify-start items-center gap-2">
                                <div class="text-white flex justify-center items-center p-2 bg-p1 rounded-full">
                                    <i class="ph ph-trophy"></i>
                                </div>
                                <div class="">
                                    <p>Price Pool</p>
                                    <p class="font-semibold">$100</p>
                                </div>
                            </div>
                            <div class="flex justify-start items-center gap-2">
                                <button class="text-white text-xs bg-p2 py-1 px-4 rounded-full dark:bg-p1">
                                    Join Now
                                </button>
                                <div class="">
                                    <p>Entry</p>
                                    <p class="font-semibold">$5.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="pt-5 flex justify-between items-center">
                            <div class="flex justify-start items-center gap-1">
                                <i class="ph ph-brain text-p2"></i>
                                <p class="text-xs">Language Quiz</p>
                            </div>
                            <div class="flex justify-start items-center gap-2">
                                <i class="ph ph-bell-ringing"></i>
                                <i class="ph ph-share-network"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{ asset('frontAssets/js/plugins/circle-slider.js') }}"></script>
@endsection
