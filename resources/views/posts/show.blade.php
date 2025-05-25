@extends('layouts.app')

@section('title', $post['titulo'] . ' - BlogLaravel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Breadcrumb mejorado -->
    <div class="container mx-auto px-4 py-8">
        <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-8">
            <a href="{{ route('posts.index') }}" class="hover:text-blue-600 transition-colors flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v3H8V5z"></path>
                </svg>
                Blog
            </a>
            <span>→</span>
            <a href="{{ route('posts.categoria', $post['categoria']) }}" class="hover:text-blue-600 transition-colors">
                {{ ucfirst($post['categoria']) }}
            </a>
            <span>→</span>
            <span class="text-gray-800 font-medium">Artículo</span>
        </nav>

        <!-- Botón de regreso  -->
        <div class="mb-8">
            <a href="{{ route('posts.index') }}" 
               class="inline-flex items-center bg-white hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-xl border border-gray-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                ← Volver a todos los posts
            </a>
        </div>
    </div>

    <!-- Hero del artículo -->
    <div class="relative">
        <!-- Imagen de fondo  -->
        <div class="h-96 bg-cover bg-center relative" style="background-image: url('{{ $post['imagen'] }}');">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
            
            <!-- Contenido del hero -->
            <div class="container mx-auto px-4 relative z-10 h-full flex items-end pb-12">
                <div class="text-white max-w-4xl">
                    <!-- Categoria y tiempo -->
                    <div class="flex items-center space-x-4 mb-4">
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
                        <span class="{{ $categoryColors[$post['categoria']] ?? 'bg-gray-500' }} text-white px-4 py-2 rounded-full text-sm font-bold backdrop-blur-sm bg-opacity-90">
                            {{ $categoryIcons[$post['categoria']] ?? '📝' }} {{ ucfirst($post['categoria']) }}
                        </span>
                        <span class="bg-white bg-opacity-20 text-white px-4 py-2 rounded-full text-sm font-medium backdrop-blur-sm">
                            ⏱️ {{ $post['tiempo_lectura'] }} de lectura
                        </span>
                    </div>
                    
                    <!-- Título principal -->
                    <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">
                        {{ $post['titulo'] }}
                    </h1>
                    
                    <!-- Meta información -->
                    <div class="flex flex-wrap items-center gap-6 text-sm">
                        <div class="flex items-center space-x-2">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold">{{ substr($post['autor'], 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold">{{ $post['autor'] }}</p>
                                <p class="text-gray-300 text-xs">{{ $post['fecha_publicacion'] }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <span class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ number_format($post['vistas']) }}</span>
                            </span>
                            <span class="flex items-center space-x-1">
                                <svg class="w-4 h-4 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $post['likes'] }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido del artículo -->
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Resumen destacado -->
            <div class="bg-gradient-to-r from-blue-50 to-purple-50 border-l-4 border-blue-500 p-6 rounded-r-xl mb-12 shadow-lg">
                <h3 class="font-bold text-lg text-gray-800 mb-3 flex items-center">
                    <span class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">💡</span>
                    Resumen del artículo
                </h3>
                <p class="text-gray-700 text-lg leading-relaxed italic">{{ $post['resumen'] }}</p>
            </div>

            <!-- Contenido principal -->
            <article class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8 md:p-12">
                    <div class="prose prose-lg max-w-none">
                        <div class="text-gray-800 leading-relaxed text-lg space-y-6">
                            {!! nl2br(e($post['contenido'])) !!}
                        </div>
                    </div>

                    <!-- Separador decorativo -->
                    <div class="flex items-center justify-center my-12">
                        <div class="flex space-x-2">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-pink-500 rounded-full"></div>
                        </div>
                    </div>

                    <!-- Tags del artículo -->
                    <div class="bg-gray-50 rounded-xl p-6 mb-8">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                            <span class="w-8 h-8 bg-purple-500 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">🏷️</span>
                            Tags relacionados
                        </h3>
                        <div class="flex flex-wrap gap-3">
                            @foreach($post['tags'] as $tag)
                            <span class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:from-blue-600 hover:to-purple-700 transition-all duration-300 cursor-pointer">
                                #{{ $tag }}
                            </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Información detallada -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 mb-8">
                        <h3 class="font-bold text-gray-800 mb-6 flex items-center">
                            <span class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">📊</span>
                            Detalles del post
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-center space-x-3">
                                    <span class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center font-bold">
                                        #{{ $post['id'] }}
                                    </span>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide">ID del Post</p>
                                        <p class="font-semibold text-gray-800">Post #{{ $post['id'] }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-center space-x-3">
                                    <span class="w-10 h-10 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center font-bold">
                                        {{ $categoryIcons[$post['categoria']] ?? '📝' }}
                                    </span>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide">Categoría</p>
                                        <p class="font-semibold text-gray-800">{{ ucfirst($post['categoria']) }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-center space-x-3">
                                    <span class="w-10 h-10 bg-green-100 text-green-600 rounded-lg flex items-center justify-center font-bold">
                                        👤
                                    </span>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide">Autor</p>
                                        <p class="font-semibold text-gray-800">{{ $post['autor'] }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-center space-x-3">
                                    <span class="w-10 h-10 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center font-bold">
                                        📅
                                    </span>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide">Fecha</p>
                                        <p class="font-semibold text-gray-800">{{ $post['fecha_publicacion'] }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-center space-x-3">
                                    <span class="w-10 h-10 bg-red-100 text-red-600 rounded-lg flex items-center justify-center font-bold">
                                        ⏱️
                                    </span>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide">Lectura</p>
                                        <p class="font-semibold text-gray-800">{{ $post['tiempo_lectura'] }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-center space-x-3">
                                    <span class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center font-bold">
                                        📈
                                    </span>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide">Engagement</p>
                                        <p class="font-semibold text-gray-800">{{ $post['vistas'] }}V / {{ $post['likes'] }}L</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones del post -->
                    <div class="border-t border-gray-200 pt-8">
                        <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                            <button class="flex items-center bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                </svg>
                                Me gusta ({{ $post['likes'] }})
                            </button>
                            
                            <button class="flex items-center bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                                Compartir
                            </button>

                            <a href="{{ route('posts.categoria', $post['categoria']) }}" 
                               class="flex items-center bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 011-1h1a2 2 0 011 1v1m-4 0h4m0 0v1"></path>
                                </svg>
                                Más de {{ ucfirst($post['categoria']) }}
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>

    <!-- Posts relacionados -->
    <div class="bg-gray-50 py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Te podría interesar</h2>
                    <p class="text-gray-600">Descubre más contenido relacionado con este tema</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @for($i = 1; $i <= 3; $i++)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <img src="https://picsum.photos/400/200?random={{ $post['id'] + $i }}" alt="Post relacionado" class="w-full h-40 object-cover">
                        <div class="p-6">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold mb-3 inline-block">
                                {{ ucfirst($post['categoria']) }}
                            </span>
                            <h4 class="font-bold text-lg text-gray-800 mb-3">Otro artículo interesante sobre {{ $post['categoria'] }}</h4>
                            <p class="text-gray-600 text-sm mb-4">Breve descripción del post relacionado que te ayudará a profundizar en el tema.</p>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm inline-flex items-center">
                                Leer más 
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection