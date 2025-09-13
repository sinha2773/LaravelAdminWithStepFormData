<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserResponse;
use App\Models\ContentPage;

class HomeController extends Controller
{
    public function index()
    {
        return view('form');
    }
    
    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
        
        // Store user data in session for the question page
        session([
            'user_data' => $request->only(['name', 'phone', 'email'])
        ]);
        
        return redirect()->route('question');
    }
    
    public function question()
    {
        if (!session('user_data')) {
            return redirect()->route('home');
        }
        
        return view('question');
    }
    
    public function submitQuestion(Request $request)
    {
        $request->validate([
            'question_answer' => 'required|string'
        ]);
        
        if (!session('user_data')) {
            return redirect()->route('home');
        }
        
        // Save complete response to database
        $userData = session('user_data');
        $userData['question_answer'] = $request->question_answer;
        
        UserResponse::create($userData);
        
        // Clear session data
        session()->forget('user_data');
        
        // Redirect based on answer
        if ($request->question_answer === 'option1') {
            return redirect()->route('result', ['page' => 'page1']);
        } else {
            return redirect()->route('result', ['page' => 'page2']);
        }
    }
    
    public function result($page)
    {
        $contentPage = ContentPage::where('slug', $page)->first();
        
        if (!$contentPage) {
            abort(404);
        }
        
        return view('result', compact('contentPage'));
    }
}
