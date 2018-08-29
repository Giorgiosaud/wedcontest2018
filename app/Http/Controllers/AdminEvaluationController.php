<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contest;

class AdminEvaluationController extends Controller
{
    public function index(Contest $selectedContest)
    {
        return view('admin.evaluations.show', compact('selectedContest'));
    }

    public function show(Contest $contest, Category $category)
    {
        $artworks = $category->artworks()->whereState('translated')->with('answers', 'judgesSumPoints', 'judgesDiproSumPoints')->get();
        $questions = $category->questions->preguntas->subjectsEn;
        $q = [];
        foreach ($questions as $question) {
            $q = array_merge($q, $question->questions);
        }
        $questions = collect($q);

        return view('admin.evaluations.complex', compact('category', 'contest', 'artworks', 'questions'));
    }
}
