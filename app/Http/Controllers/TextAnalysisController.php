<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextAnalysisController extends Controller
{
    public function index()
    {
        $title = 'Page Text Analysis';
        return view('frontend.page.TextAnalysis', compact('title'));
    }

    public function analyze(Request $request)
    {
        $title = 'Page Text Analysis';
        // Validasi input
        $request->validate([
            'input1' => 'required|string',
            'input2' => 'required|string',
        ]);

        $input1 = strtoupper($request->input1); // Ubah ke uppercase untuk case-insensitive
        $input2 = strtoupper($request->input2);

        // Ambil karakter unik dari input pertama
        $uniqueChars = count_chars($input1, 3); // Mengambil karakter unik dalam bentuk string
        $totalChars = strlen($uniqueChars);

        $matchedCount = 0;
        foreach (str_split($uniqueChars) as $char) {
            if (str_contains($input2, $char)) {
                $matchedCount++;
            }
        }

        // Hitung persentase
        $percentage = $totalChars > 0 ? ($matchedCount / $totalChars) * 100 : 0;

        return view('frontend.page.TextAnalysis', compact('title','input1', 'input2', 'percentage', 'matchedCount', 'totalChars'));
    }
}
