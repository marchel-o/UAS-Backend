<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQ;

class FAQController extends Controller
{
    public function index() {
        $faqs = FAQ::latest()->get();
        return view('faqs.index', compact('faqs'));
    }

    public function create() {
        if(auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('faqs.create');
    }

    public function store(Request $request) {
        if(auth()->user()->role !== 'admin') {
            abort(403);
        }

        FAQ::create([
            'question' => $request->question,
            'answer'=> $request->answer,
        ]);
        return redirect()->route('faqs.index');
    }

    public function destroy(FAQ $faq) {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $faq->delete();
        
        return redirect()->route('faqs.index');
    }
}
