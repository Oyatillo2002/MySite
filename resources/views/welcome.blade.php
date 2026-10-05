<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oyatillo | Backend Developer</title>
    
    <!-- 1. Tailwind va JS ni yuklash -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Marquee animatsiyasi */
        .marquee-container { overflow: hidden; white-space: nowrap; }
        .marquee-content { display: inline-block; animation: marquee 20s linear infinite; }
        @keyframes marquee { 
            0% { transform: translateX(0); } 
            100% { transform: translateX(-50%); } 
        }
        .marquee-content:hover { animation-play-state: paused; }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 font-sans antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-gray-900/90 backdrop-blur-md border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
            <a href="/" class="text-xl font-bold text-indigo-400 hover:text-indigo-300 transition">Oyatillo<span class="text-white">.dev</span></a>
            
            <div class="flex gap-4 items-center">
                <a href="#projects" class="hover:text-indigo-400 text-sm font-medium transition">Projects</a>
                
                <!-- Resume tugmasi (Agar route mavjud bo'lsa) -->
                {{-- Eslatma: Agar resume route yo'q bo'lsa, buni comment qilib qo'ying --}}
                <a href="{{ route('resume.download') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition shadow-lg">
                    Download CV
                </a>
            </div>
        </div>
    </nav>

    <main class="pt-24 pb-10 min-h-screen">
        
        <!-- Hero Section -->
        <section id="about" class="py-20 md:py-32 flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-white mb-4">
                Hi, I'm <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-600">Oyatillo</span>
            </h1>
            <p class="mt-4 text-xl md:text-2xl text-gray-400 max-w-3xl leading-relaxed">
                Backend Developer specializing in <strong>Laravel</strong>, <strong>Go</strong>, and <strong>Python</strong>. 
                I build scalable APIs, automate complex workflows, and solve algorithmic challenges efficiently.
            </p>
            
            <div class="mt-10 flex gap-4 flex-wrap justify-center">
                <a href="#projects" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold transition shadow-lg transform hover:-translate-y-1">
                    View My Work
                </a>
                <a href="mailto:your@email.com" class="px-8 py-3 bg-gray-800 hover:bg-gray-700 text-white rounded-lg font-semibold transition border border-gray-700">
                    Contact Me
                </a>
            </div>
        </section>

        <!-- Tech Stack Marquee -->
        <section class="py-10 bg-gray-800/30 border-y border-gray-700 overflow-hidden">
            <div class="marquee-container">
                <div class="marquee-content flex gap-8 text-gray-400 font-mono text-lg uppercase tracking-wider">
                    <!-- Database'dagi skill'larni chiqaramiz -->
                    @foreach($skills as $skill)
                        <span>{{ $skill->name }}</span>
                        <span class="text-indigo-500">•</span>
                    @endforeach
                    
                    <!-- Takrorlanish (silliq harakat uchun) -->
                    @foreach($skills as $skill)
                        <span>{{ $skill->name }}</span>
                        <span class="text-indigo-500">•</span>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Featured Projects Grid -->
        <section id="projects" class="py-20 px-4 max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Featured Projects</h2>
                <p class="text-gray-400">Here are some of the things I've built recently.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($featuredProjects as $project)
                    <div class="group relative bg-gray-800 rounded-xl overflow-hidden border border-gray-700 hover:border-indigo-500 transition duration-300 shadow-xl hover:shadow-2xl flex flex-col">
                        
                        <!-- Placeholder Image/Header -->
                        <div class="h-48 bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center group-hover:opacity-90 transition">
                             <span class="text-6xl opacity-10 font-black text-white">{{ substr($project->title, 0, 1) }}</span>
                        </div>

                        <div class="p-6 flex-grow flex flex-col">
                            <h3 class="text-xl font-bold text-white group-hover:text-indigo-400 transition line-clamp-1 mb-2">{{ $project->title }}</h3>
                            
                            <p class="text-gray-400 text-sm line-clamp-3 mb-4 flex-grow">{{ $project->description }}</p>
                            
                            <!-- Technologies Badges -->
                            <div class="flex flex-wrap gap-2 mb-6">
                                @if(is_array(json_decode($project->technologies)))
                                    @foreach(json_decode($project->technologies) as $tech)
                                        <span class="text-xs bg-gray-700 text-gray-300 px-2 py-1 rounded border border-gray-600">{{ $tech }}</span>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Links Footer -->
                            <div class="flex gap-4 pt-4 border-t border-gray-700 mt-auto">
                                @if($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" class="text-gray-400 hover:text-white flex items-center gap-1 text-sm font-medium transition">
                                        GitHub Code →
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10 text-gray-500">
                        No featured projects yet. Add them via Admin Panel!
                    </div>
                @endforelse
            </div>
        </section>

    </main>

    <footer class="border-t border-gray-800 py-8 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} Oyatillo. Built with Laravel, Docker & Tailwind CSS.
    </footer>

</body>
</html>