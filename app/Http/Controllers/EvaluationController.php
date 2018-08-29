<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Artwork;
use App\Category;
use App\Contest;
use App\Question;
use App\Role;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function create(Contest $contest, Category $category)
    {
        $roles = Role::all();

        return view('evaluations.create', compact('category', 'roles'));

        dd($category);
    }

    public function save(Request $request, Category $category)
    {
        $q = new Question();
        $q->category_id = $category->id;
        $q->questions = json_encode($request->all());
        $q->save();

        return 'true';
    }

    public function show(Contest $selectedContest)
    {
        return view('evaluations.show', compact('selectedContest'));
    }

    public function make(Contest $contest, Category $category)
    {
        return view('evaluations.make', compact('category', 'contest'));
    }

    public function post(Artwork $artwork, Request $request)
    {
        $answer = Answer::firstOrNew(['user_id'=>auth()->user()->id, 'artwork_id'=>$artwork->id]);

        $answers = $request->all();
        $answer->answers = json_encode($answers);
        $Allthemes = json_decode($artwork->category->questions->questions);
        $themes = $Allthemes->subjectsEs;
        $FinalQuestions = [];
        foreach ($themes as $theme) {
            foreach ($theme->questions as $question) {
                array_push($FinalQuestions, ['id'=>$question->id, 'percentage'=>$theme->percentage, 'role'=>$theme->role]);
            }
        }
        $puntuacionNormal = 0;
        $puntuacionDipro = 0;

        foreach ($answers as $answer_id => $answer_val) {
            $foundedQuestion = array_search($answer_id, array_column($FinalQuestions, 'id'));
            if ($FinalQuestions[$foundedQuestion]['role'] == 'Judge') {
                $puntuacionNormal += $answer_val * $FinalQuestions[$foundedQuestion]['percentage'];
            } else {
                $puntuacionDipro += $answer_val * $FinalQuestions[$foundedQuestion]['percentage'];
            }
        }
        $answer->judges_points = $puntuacionNormal;
        $answer->judges_dipro_points = $puntuacionDipro;
        $answer->save();

        return $answer;
    }

    //
}
