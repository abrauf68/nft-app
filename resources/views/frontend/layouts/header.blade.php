<div class="fixed bottom-0 left-0 right-0 z-40">
    <div class="container bg-p2 px-6 py-3 rounded-t-2xl flex justify-around items-center dark:bg-p1">
        <a href="{{ route('frontend.home') }}" class="flex justify-center items-center text-center flex-col gap-1">
            <div class="flex justify-center items-center p-3 rounded-full bg-p1 {{ request()->routeIs('frontend.home') ? 'dark:bg-p2' : 'dark:bg-color10' }}">
                <i class="ph ph-house text-xl !leading-none text-white"></i>
            </div>
            <p class="text-xs text-white font-semibold dark:text-color10">Home</p>
        </a>
        <a href="./library.html" class="flex justify-center items-center text-center flex-col gap-1">
            <div class="flex justify-center items-center p-3 rounded-full bg-white dark:bg-color10">
                <i class="ph ph-squares-four text-xl !leading-none dark:text-white"></i>
            </div>
            <p class="text-xs text-white font-semibold dark:text-color10">
                Library
            </p>
        </a>
        <a href="./earn-rewards.html" class="flex justify-center items-center text-center flex-col gap-1">
            <div class="flex justify-center items-center p-3 rounded-full bg-white dark:bg-color10">
                <i class="ph ph-users-three text-xl !leading-none dark:text-white"></i>
            </div>
            <p class="text-xs text-white font-semibold dark:text-color10">
                Share & Earn
            </p>
        </a>
        <a href="./chat.html" class="flex justify-center items-center text-center flex-col gap-1">
            <div class="flex justify-center items-center p-3 rounded-full bg-white dark:bg-color10">
                <i class="ph ph-users-three text-xl !leading-none dark:text-white"></i>
            </div>
            <p class="text-xs text-white font-semibold dark:text-color10">Chat</p>
        </a>
    </div>
</div>
