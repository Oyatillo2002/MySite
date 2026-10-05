<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Bosh sahifani ko'rsatish.
     */
    public function index()
    {
        // Featured (top pick) loyihalarni olamiz (maksimum 3 ta)
        $featuredProjects = Project::where('is_featured', true)
                                   ->latest()
                                   ->take(3)
                                   ->get();

        // Barcha texnologiyalar ro'yxati (Marquee uchun)
        $skills = Skill::orderBy('name')->get();

        // Blade view'ga ma'lumotlarni uzatamiz
        return view('welcome', compact('featuredProjects', 'allProjects', 'skills'));
    }

    /**
     * Resume PDF ni yuklab berish.
     */
    public function downloadResume()
    {
        // Fayl public/storage/resume.pdf da saqlangan deb faraz qilamiz
        // Yoki to'g'ridan-to'g'ri public/resume.pdf dan
        $fileName = 'resume.pdf';
        
        // Tekshirish: Agar fayl mavjud bo'lsa
        if (!Storage::exists($fileName)) {
            // Alternativa: Public papkasidan tekshirish
            $filePath = public_path($fileName);
            if (!file_exists($filePath)) {
                abort(404, 'Resume not found');
            }
            return response()->download($filePath, 'Oyatillo_Resume.pdf');
        }

        return Storage::download($fileName, 'Oyatillo_Resume.pdf');
    }
}