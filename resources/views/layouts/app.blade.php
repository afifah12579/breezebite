<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BreezeBite App</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-indigo-950 flex justify-center items-center min-h-screen overflow-hidden">
    
    <div class="w-full max-w-md h-[92vh] bg-white shadow-2xl relative flex flex-col overflow-hidden rounded-3xl border border-slate-100">
    
    <div class="flex-1 overflow-y-auto custom-scrollbar">
        @yield('content')
    </div>

</div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
    </style>
</body>
</html>