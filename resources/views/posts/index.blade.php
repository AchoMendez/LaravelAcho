@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative gradient-bg bg-pattern text-white py-20 -mt-6">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 animate-fade-in">{{ $titulo }}</h1>
        <p class="text-xl md:text-2xl text-black text-opacity-90 mb-8 max-w-3xl mx-auto animate-fade-in">
            Descubre los mejores artículos sobre tecnología, diseño, programación y mucho más
        </p>
        <div class="flex flex-wrap justify-center gap-4 animate-fade-in">
            <div class="bg-black bg-opacity-20 backdrop-blur-sm rounded-full px-6 py-3">
                <span class="font-semibold">📚 {{ count($posts) }} Posts</span>
            </div>
            <div class="bg-black bg-opacity-20 backdrop-blur-sm rounded-full px-6 py-3">
                <span class="font-semibold">🎯 6 Categorías</span>
            </div>
            <div class="bg-black bg-opacity-20 backdrop-blur-sm rounded-full px-6 py-3">
                <span class="font-semibold">✍️ 6 Autores</span>
            </div>
        </div>
    </div>
    
    <!-- Wave separator -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden">
        <svg class="relative block w-full h-12" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" fill="#f9fafb"></path>
        </svg>
    </div>
</div>

<!-- Filtros mejorados -->
<div class="container mx-auto px-4 -mt-6 relative z-10">
    <div class="bg-white rounded-2xl shadow-xl p-6 mb-12">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center">🔍 Filtrar por categoría</h3>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="{{ route('posts.index') }}" 
               class="category-chip bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white px-6 py-3 rounded-full font-medium transition-all duration-300 shadow-lg hover:shadow-xl">
                🏠 Todas las categorías
            </a>
            @foreach([
                'tecnologia' => ['🔧', 'from-blue-500 to-blue-600', 'hover:from-blue-600 hover:to-blue-700'],
                'diseño' => ['🎨', 'from-purple-500 to-purple-600', 'hover:from-purple-600 hover:to-purple-700'],
                'programacion' => ['💻', 'from-green-500 to-green-600', 'hover:from-green-600 hover:to-green-700'],
                'marketing' => ['📈', 'from-yellow-500 to-orange-500', 'hover:from-yellow-600 hover:to-orange-600'],
                'negocios' => ['💼', 'from-red-500 to-red-600', 'hover:from-red-600 hover:to-red-700'],
                'lifestyle' => ['🌟', 'from-pink-500 to-pink-600', 'hover:from-pink-600 hover:to-pink-700']
            ] as $cat => $data)
            <a href="{{ route('posts.categoria', $cat) }}" 
               class="category-chip bg-gradient-to-r {{ $data[1] }} {{ $data[2] }} text-white px-6 py-3 rounded-full font-medium transition-all duration-300 shadow-lg hover:shadow-xl">
                {{ $data[0] }} {{ ucfirst($cat) }}
            </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Grid de Posts mejorado -->
<div class="container mx-auto px-4 pb-20">
    @if(count($posts) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($posts as $index => $post)
            <article class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden group" style="animation-delay: {{ $index * 0.1 }}s">
                <!-- Imagen con overlay -->
                <div class="relative overflow-hidden">
                    <img src="{{ $post['imagen'] }}" 
                         alt="{{ $post['titulo'] }}" 
                         class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                    
                    <!-- Overlay gradiente -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                    
                    <!-- Categoria badge -->
                    <div class="absolute top-3 left-3">
                        @php
                            $categoryColors = [
                                'tecnologia' => 'bg-blue-500',
                                'diseño' => 'bg-purple-500',
                                'programacion' => 'bg-green-500',
                                'marketing' => 'bg-yellow-500',
                                'negocios' => 'bg-red-500',
                                'lifestyle' => 'bg-pink-500'
                            ];
                            $categoryIcons = [
                                'tecnologia' => '🔧',
                                'diseño' => '🎨',
                                'programacion' => '💻',
                                'marketing' => '📈',
                                'negocios' => '💼',
                                'lifestyle' => '🌟'
                            ];
                        @endphp
                        <span class="{{ $categoryColors[$post['categoria']] ?? 'bg-gray-500' }} text-Black text-xs font-bold px-3 py-1 rounded-full backdrop-blur-sm bg-opacity-90">
                            {{ $categoryIcons[$post['categoria']] ?? '📝' }} {{ ucfirst($post['categoria']) }}
                        </span>
                    </div>
                    
                    <!-- Tiempo de lectura -->
                    <div class="absolute top-3 right-3">
                        <span class="bg-black bg-opacity-60 text-white text-xs font-medium px-3 py-1 rounded-full backdrop-blur-sm">
                            ⏱️ {{ $post['tiempo_lectura'] }}
                        </span>
                    </div>
                    
                    <!-- Stats overlay -->
                    <div class="absolute bottom-3 right-3 flex space-x-2">
                        <span class="bg-white bg-opacity-20 text-white text-xs font-medium px-2 py-1 rounded-full backdrop-blur-sm">
                            👁️ {{ number_format($post['vistas']) }}
                        </span>
                        <span class="bg-white bg-opacity-20 text-white text-xs font-medium px-2 py-1 rounded-full backdrop-blur-sm">
                            ❤️ {{ $post['likes'] }}
                        </span>
                    </div>
                </div>

                <!-- Contenido del card -->
                <div class="p-6">
                    <h3 class="font-bold text-lg mb-3 text-gray-800 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300">
                        <a href="{{ route('posts.show', $post['id']) }}" class="hover:underline">
                            {{ $post['titulo'] }}
                        </a>
                    </h3>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">{{ $post['resumen'] }}</p>
                    
                    <!-- Autor y fecha -->
                    <div class="flex items-center justify-between text-xs text-gray-500 mb-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center space-x-2">
                            <div class="w-6 h-6 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                                <span class="text-white text-xs font-bold">{{ substr($post['autor'], 0, 1) }}</span>
                            </div>
                            <span class="font-medium">{{ $post['autor'] }}</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $post['fecha_publicacion'] }}</span>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(array_slice($post['tags'], 0, 3) as $tag)
                        <span class="bg-gray-100 text-gray-700 text-xs px-3 py-1 rounded-full font-medium hover:bg-gray-200 transition-colors">
                            #{{ $tag }}
                        </span>
                        @endforeach
                        @if(count($post['tags']) > 3)
                        <span class="text-gray-400 text-xs px-2 py-1">
                            +{{ count($post['tags']) - 3 }} más
                        </span>
                        @endif
                    </div>

                    <!-- Botón de acción mejorado -->
                    <a href="{{ route('posts.show', $post['id']) }}" 
                       class="block w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white text-center py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        📖 Leer artículo completo
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    @else
        <!-- Estado vacío mejorado -->
        <div class="text-center py-20">
            <div class="max-w-md mx-auto">
                <div class="w-24 h-24 bg-gradient-to-r from-gray-200 to-gray-300 rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-4xl">📭</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">No se encontraron posts</h3>
                <p class="text-gray-600 mb-6">No hay posts disponibles en esta categoría en este momento.</p>
                <a href="{{ route('posts.index') }}" 
                   class="inline-flex items-center bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-blue-600 hover:to-purple-700 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Ver todos los posts
                </a>
            </div>
        </div>
    @endif
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection