<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog Laravel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .bg-pattern {
            background-image: 
                radial-gradient(circle at 25px 25px, rgba(255,255,255,0.2) 2px, transparent 0),
                radial-gradient(circle at 75px 75px, rgba(255,255,255,0.1) 2px, transparent 0);
            background-size: 100px 100px;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .category-chip {
            transition: all 0.3s ease;
        }
        
        .category-chip:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header mejorado -->
    <header class="gradient-bg bg-pattern shadow-2xl sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <!-- Logo mejorado -->
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-Black">BlogLaravel</h1>
                        <p class="text-xs text-Black text-opacity-80">Descubre, aprende, inspírate</p>
                    </div>
                </div>
                
                <!-- Navigation mejorada -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('posts.index') }}" 
                       class="text-Black hover:text-opacity-80 transition duration-300 font-medium px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-10">
                        Inicio
                    </a>
                    
                    <!-- Dropdown de categorías -->
                    <div class="relative group">
                        <button class="text-Black hover:text-opacity-80 transition duration-300 font-medium px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-10 flex items-center">
                            Categorías
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-56 glass-effect rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                            <div class="py-3">
                                @foreach([
                                    'tecnologia' => ['🔧', 'Tecnología'],
                                    'diseño' => ['🎨', 'Diseño'],
                                    'programacion' => ['💻', 'Programación'],
                                    'marketing' => ['📈', 'Marketing'],
                                    'negocios' => ['💼', 'Negocios'],
                                    'lifestyle' => ['🌟', 'Lifestyle']
                                ] as $categoria => $data)
                                <a href="{{ route('posts.categoria', $categoria) }}" 
                                   class="flex items-center px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 transition duration-200">
                                    <span class="text-lg mr-3">{{ $data[0] }}</span>
                                    <span class="font-medium">{{ $data[1] }}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-Black p-2 rounded-lg hover:bg-white hover:bg-opacity-10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile menu -->
            <div id="mobile-menu" class="md:hidden mt-4 hidden">
                <div class="glass-effect rounded-xl p-4 space-y-2">
                    <a href="{{ route('posts.index') }}" class="block text-gray-700 font-medium py-2 px-3 rounded-lg hover:bg-gray-100">
                        🏠 Inicio
                    </a>
                    @foreach([
                        'tecnologia' => ['🔧', 'Tecnología'],
                        'diseño' => ['🎨', 'Diseño'],
                        'programacion' => ['💻', 'Programación'],
                        'marketing' => ['📈', 'Marketing'],
                        'negocios' => ['💼', 'Negocios'],
                        'lifestyle' => ['🌟', 'Lifestyle']
                    ] as $categoria => $data)
                    <a href="{{ route('posts.categoria', $categoria) }}" 
                       class="block text-gray-700 py-2 px-3 rounded-lg hover:bg-gray-100">
                        {{ $data[0] }} {{ $data[1] }}
                    </a>
                    @endforeach
                </div>
            </div>
        </nav>
    </header>
    
    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>
    
    <!-- Footer mejorado -->
    <footer class="bg-gray-900 text-white py-16 mt-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 gradient-bg rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold">BlogLaravel</h3>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed max-w-md">
                        Tu fuente de información sobre tecnología, diseño, programación y mucho más. 
                        Contenido de calidad para profesionales y entusiastas del mundo digital.
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold mb-4 text-lg">Enlaces</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('posts.index') }}" class="text-gray-300 hover:text-white transition duration-300 flex items-center">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                            Todos los Posts
                        </a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300 flex items-center">
                            <span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>
                            Acerca de
                        </a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300 flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>
                            Contacto
                        </a></li>
                    </ul>
                </div>
                
                <!-- Stats -->
                <div>
                    <h4 class="font-semibold mb-4 text-lg">Estadísticas</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-300">Posts:</span>
                            <span class="font-bold text-blue-400">55+</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-300">Categorías:</span>
                            <span class="font-bold text-purple-400">6</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-300">Autores:</span>
                            <span class="font-bold text-green-400">6</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-12 pt-8 text-center">
                <p class="text-gray-400 text-sm">
                    © {{ date('Y') }} BlogLaravel. Proyecto académico desarrollado con ❤️ usando Laravel Framework.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);

        // Observe all cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach(card => observer.observe(card));
        });
    </script>
</body>
</html>