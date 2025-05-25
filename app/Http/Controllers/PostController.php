<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    private $posts;

    public function __construct()
    {
        $this->posts = $this->generarPosts();
    }

    public function index()
    {
        return view('posts.index', [
            'posts' => $this->posts,
            'titulo' => 'Blog - Todos los Posts'
        ]);
    }

    public function show($id)
    {
        $post = collect($this->posts)->firstWhere('id', $id);
        
        if (!$post) {
            abort(404, 'Post no encontrado');
        }

        return view('posts.show', [
            'post' => $post,
            'titulo' => $post['titulo']
        ]);
    }

    public function porCategoria($categoria)
    {
        $postsFiltrados = collect($this->posts)->where('categoria', $categoria)->all();
        
        return view('posts.index', [
            'posts' => $postsFiltrados,
            'titulo' => 'Posts de ' . ucfirst($categoria)
        ]);
    }

    private function generarPosts()
    {
        $categorias = ['tecnologia', 'diseño', 'programacion', 'marketing', 'negocios', 'lifestyle'];
        $autores = ['Ana García', 'Carlos López', 'María Rodríguez', 'Juan Pérez', 'Sofia Martín', 'Diego Ruiz'];
        $tags = ['php', 'laravel', 'javascript', 'css', 'html', 'react', 'vue', 'nodejs', 'python', 'design'];
        
        $posts = [];
        
        for ($i = 1; $i <= 55; $i++) {
            $categoria = $categorias[array_rand($categorias)];
            $autor = $autores[array_rand($autores)];
            $numTags = rand(2, 4);
            $postTags = array_rand(array_flip($tags), $numTags);
            
            $posts[] = [
                'id' => $i,
                'titulo' => $this->generarTitulo($categoria, $i),
                'resumen' => $this->generarResumen($categoria),
                'contenido' => $this->generarContenido($categoria),
                'autor' => $autor,
                'categoria' => $categoria,
                'fecha_publicacion' => now()->subDays(rand(1, 365))->format('d/m/Y'),
                'tiempo_lectura' => rand(3, 15) . ' min',
                'imagen' => "https://picsum.photos/400/250?random={$i}",
                'tags' => is_array($postTags) ? $postTags : [$postTags],
                'vistas' => rand(50, 5000),
                'likes' => rand(5, 500)
            ];
        }
        
        return $posts;
    }

    private function generarTitulo($categoria, $numero)
    {
        $titulos = [
            'tecnologia' => ['Las últimas tendencias en tecnología 2024', 'Inteligencia Artificial y su impacto'],
            'diseño' => ['Principios del diseño moderno', 'Tendencias de UI/UX este año'],
            'programacion' => ['Guía completa de Laravel', 'JavaScript: conceptos avanzados'],
            'marketing' => ['Estrategias de marketing digital', 'SEO: optimización para buscadores'],
            'negocios' => ['Emprendimiento en la era digital', 'Liderazgo empresarial moderno'],
            'lifestyle' => ['Balance vida-trabajo', 'Hábitos para el éxito']
        ];
        
        $titulosCategoria = $titulos[$categoria];
        $titulo = $titulosCategoria[($numero - 1) % count($titulosCategoria)];
        
        return $titulo . " #" . $numero;
    }

    private function generarResumen($categoria)
    {
        $resumenes = [
            'tecnologia' => 'Descubre las últimas innovaciones tecnológicas que están transformando nuestro mundo.',
            'diseño' => 'Explora las tendencias más actuales en diseño y aprende cómo aplicar estos conceptos.',
            'programacion' => 'Aprende las mejores técnicas de programación con ejemplos prácticos.',
            'marketing' => 'Conoce las estrategias más efectivas para hacer crecer tu negocio.',
            'negocios' => 'Insights valiosos sobre emprendimiento y gestión empresarial.',
            'lifestyle' => 'Tips para mejorar tu calidad de vida y encontrar el equilibrio perfecto.'
        ];
        
        return $resumenes[$categoria];
    }

    private function generarContenido($categoria)
    {
        return "Este es un artículo completo sobre {$categoria} que proporciona información detallada y valiosa para nuestros lectores. El contenido ha sido elaborado por expertos y ofrece perspectivas únicas sobre los temas más relevantes.";
    }
}