<!DOCTYPE html>
<html lang="id" class="dark"> {{-- #GPT5: tambahkan class="dark" agar Tailwind tahu default dark mode --}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Sepatu Basket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // #GPT5: aktifkan dark mode berbasis class
        tailwind.config = {
            darkMode: 'class'
        };
    </script>
</head>
<body class="bg-black text-white font-sans dark:bg-black dark:text-white transition-colors duration-300">

      {{-- #GPT5: Navbar dengan tombol toggle dark/light --}}
    <header class="fixed top-0 left-0 w-full bg-black dark:bg-black border-b border-gray-700 z-50 transition-colors duration-300">
        <div class="max-w-6xl mx-auto flex items-center justify-between px-6 py-4">
            <h1 class="text-xl font-bold tracking-wide">BASENESS HOOPS</h1>
            <nav class="flex items-center space-x-6 text-sm">
                <a href="#sneakers" class="hover:text-gray-300 transition">Sneakers</a>
                <a href="#basket" class="hover:text-gray-300 transition">Basket</a>
                <a href="#running" class="hover:text-gray-300 transition">Running</a>
                <a href="#contact" class="hover:text-gray-300 transition">Kontak</a>

                {{-- #GPT5: tombol toggle mode --}}
                <button id="modeToggle" class="ml-4 bg-gray-800 dark:bg-gray-200 text-white dark:text-black px-3 py-1 rounded-lg text-xs transition">
                    ☀️ Light
                </button>
            </nav>
        </div>
    </header>

    <main class="pt-24 bg-white text-black dark:bg-black dark:text-white transition-colors duration-300">
        @yield('content')
    </main>

    <script>
        const toggle = document.getElementById('modeToggle');
        const html = document.documentElement;

        // ambil preferensi user dari localStorage
        if (localStorage.getItem('theme') === 'light') {
            html.classList.remove('dark');
            toggle.textContent = '🌙 Dark';
            toggle.classList.replace('bg-gray-800', 'bg-gray-200');
            toggle.classList.replace('text-white', 'text-black');
        }

        toggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            toggle.textContent = isDark ? '☀️ Light' : '🌙 Dark';
            toggle.classList.toggle('bg-gray-200');
            toggle.classList.toggle('bg-gray-800');
            toggle.classList.toggle('text-black');
            toggle.classList.toggle('text-white');
        });
    </script>


    <!--FOOTER-->
    <footer class="mt-16 bg-gray-900 text-gray-400">
        <div class="max-w-6xl mx-auto px-6 py-8 grid md:grid-cols-3 gap-6">
            <div>
                <h2 class="text-white font-semibold mb-3">Tentang BALLSTEP</h2>
                <p class="text-sm">Toko sepatu yang berfokus pada performa dan gaya. Dari lapangan basket hingga jalanan kota.</p>
            </div>
            <div>
                <h2 class="text-white font-semibold mb-3">Kategori</h2>
                <ul class="space-y-2 text-sm">
                    <li><a href="#sneakers" class="hover:text-white">Sneakers</a></li>
                    <li><a href="#basket" class="hover:text-white">Basket</a></li>
                    <li><a href="#running" class="hover:text-white">Running</a></li>
                </ul>
            </div>
            <div id="contact">
                <h2 class="text-white font-semibold mb-3">Hubungi Kami</h2>
                <p class="text-sm">📞 WhatsApp: <a href="#" class="hover:text-white">+62 812 3456 7890</a></p>
                <p class="text-sm">📸 Instagram: <a href="#" class="hover:text-white">@ballstep.store</a></p>
            </div>
        </div>
        <div class="border-t border-gray-700 text-center py-4 text-xs text-gray-500">
            © 2025 BALLSTEP. All rights reserved.
        </div>
    </footer>

</body>
</html>
