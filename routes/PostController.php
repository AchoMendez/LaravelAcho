<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    private $posts;

    public function __construct()
    {
        // Generar 50+ posts de blog con 7+ atributos cada uno
        $this->posts = $this->generarPosts();
    }

    /**
     * Mostrar lista de todos los posts
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => $this->posts,
            'titulo' => 'Blog - Todos los Posts'
        ]);
    }

    /**
     * Mostrar detalle de un post específico (ruta con parámetro)
     */
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

    /**
     * Mostrar posts por categoría (funcionalidad adicional)
     */
    public function porCategoria($categoria)
    {
        $postsFiltrados = collect($this->posts)->where('categoria', $categoria)->all();
        
        return view('posts.index', [
            'posts' => $postsFiltrados,
            'titulo' => 'Posts de ' . ucfirst($categoria)
        ]);
    }

    /**
     * Generar 50+ posts de ejemplo con 7+ atributos
     */
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
            'tecnologia' => [
                'Las últimas tendencias en tecnología 2024',
                'Inteligencia Artificial y su impacto',
                'Dispositivos móviles del futuro',
                'Ciberseguridad en la era digital'
            ],
            'diseño' => [
                'Principios del diseño moderno',
                'Tendencias de UI/UX este año',
                'Colores que dominan el diseño',
                'Tipografía y su importancia'
            ],
            'programacion' => [
                'Guía completa de Laravel',
                'JavaScript: conceptos avanzados',
                'Mejores prácticas en PHP',
                'Frameworks populares 2024'
            ],
            'marketing' => [
                'Estrategias de marketing digital',
                'SEO: optimización para buscadores',
                'Redes sociales para empresas',
                'Email marketing efectivo'
            ],
            'negocios' => [
                'Emprendimiento en la era digital',
                'Liderazgo empresarial moderno',
                'Finanzas para startups',
                'Productividad en el trabajo'
            ],
            'lifestyle' => [
                'Balance vida-trabajo',
                'Hábitos para el éxito',
                'Wellness y tecnología',
                'Tendencias de vida saludable'
            ]
        ];
        
        $titulosCategoria = $titulos[$categoria];
        $titulo = $titulosCategoria[($numero - 1) % count($titulosCategoria)];
        
        return $titulo . " #" . $numero;
    }

    private function generarResumen($categoria)
    {
        $resumenes = [
            'tecnologia' => 'Descubre las últimas innovaciones tecnológicas que están transformando nuestro mundo y cómo pueden impactar en tu vida diaria.',
            'diseño' => 'Explora las tendencias más actuales en diseño y aprende cómo aplicar estos conceptos en tus proyectos creativos.',
            'programacion' => 'Aprende las mejores técnicas de programación con ejemplos prácticos y consejos de expertos en desarrollo.',
            'marketing' => 'Conoce las estrategias más efectivas para hacer crecer tu negocio en el mundo digital actual.',
            'negocios' => 'Insights valiosos sobre emprendimiento, liderazgo y gestión empresarial para el éxito profesional.',
            'lifestyle' => 'Tips y consejos para mejorar tu calidad de vida y encontrar el equilibrio perfecto en tu día a día.'
        ];
        
        return $resumenes[$categoria];
    }

    private function generarContenido($categoria)
    {
        return "Este es un artículo completo sobre {$categoria} que proporciona información detallada y valiosa para nuestros lectores. 

El contenido ha sido cuidadosamente elaborado por expertos en la materia y ofrece perspectivas únicas y actualizadas sobre los temas más relevantes.

En este post encontrarás:
• Información actualizada y verificada
• Ejemplos prácticos y casos de uso
• Consejos aplicables en la vida real
• Referencias a recursos adicionales

Nuestro objetivo es brindarte el mejor contenido posible para que puedas aplicar estos conocimientos en tu desarrollo personal y profesional.

¡Esperamos que este artículo sea de gran utilidad para ti y no olvides compartirlo si te ha resultado interesante!";
    }
}