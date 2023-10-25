@if (Session::has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-[#011147] dark:text-green-400" role="alert">
            <span class="font-medium"><strong>Success !</strong> {{ session('success') }}</span>
        </div>
@elseif (Session::has('error'))
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-[#011147] dark:text-red-400" role="alert">
        <span class="font-medium"><strong>Error !</strong> {{ session('error') }}</span>
    </div>
@elseif (Session::has('warning'))
    <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-[#011147] dark:text-yellow-400" role="alert">
        <span class="font-medium"><strong>Warning !</strong> {{ session('warning') }}</span>
    </div>
@elseif (Session::has('info'))
    <div class="p-4 mb-4 text-sm text-white-800 rounded-lg bg-[#011147] dark:text-white" role="alert">
        <span class="font-medium"><strong>Info !</strong> {{ session('info') }}</span>
    </div>



@endif
