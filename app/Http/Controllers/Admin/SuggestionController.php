<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\SuggestionRepositoryInterface;

class SuggestionController extends Controller
{
    protected $suggestionRepository;

    public function __construct(SuggestionRepositoryInterface $suggestionRepository)
    {
        $this->suggestionRepository = $suggestionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suggestions = $this->suggestionRepository->getAllSort('id', 'desc', true);

        return view('admin.suggestion.index', compact('suggestions'));
    }
}
