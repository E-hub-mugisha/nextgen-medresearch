<?php

namespace App\Http\Controllers;

use App\Models\MentorQuestion;
use App\Models\MentorAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorQnAController extends Controller
{
    // Public: ask a question
    public function askForm() {
        return view('mentor_qna.ask');
    }

    public function storeQuestion(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'question' => 'required|string',
        ]);

        MentorQuestion::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'question' => $request->question,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your question has been submitted!');
    }

    // Public: view all answered questions
    public function index() {
        $questions = MentorQuestion::with('answers', 'user')
            ->where('status', 'answered')
            ->latest()
            ->paginate(10);

        return view('front.mentor_qna', compact('questions'));
    }

    // Admin / Mentor: answer question
    public function answerForm(MentorQuestion $question) {
        return view('mentor_qna.answer', compact('question'));
    }

    public function storeAnswer(Request $request, MentorQuestion $question) {
        $request->validate(['answer' => 'required|string']);

        $question->answers()->create([
            'mentor_id' => Auth::id(),
            'answer' => $request->answer
        ]);

        $question->update(['status' => 'answered']);

        return redirect()->route('mentor_qna.admin_index')->with('success', 'Answer submitted.');
    }

    // Admin: list all questions
    public function adminIndex() {
        $questions = MentorQuestion::with('answers', 'user')->latest()->paginate(15);
        return view('mentor_qna.admin_index', compact('questions'));
    }

    // Admin: archive
    public function archive(MentorQuestion $question) {
        $question->update(['status' => 'archived']);
        return back()->with('success', 'Question archived.');
    }
}