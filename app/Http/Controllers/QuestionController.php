<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\question;
use Excel;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $questions = Question::orderBy('id', 'DESC')->paginate(5);
        //$questions = question::All();
        //return view('question.index',compact('questions'));
        return view('question.index', compact('questions'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'details' => 'required',
        ]);

        $question = new Question;
        $question->name = $request->get('details');
        $question->save();

        return redirect()->route('question.index')->with('success', 'question created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        return view('question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        return view('question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'ship_name' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);

        $question = new Question;
        $question->name = $request->get('name');
        $question->ship_name = $request->get('ship_name');
        $question->from = date('Y-m-d', strtotime($request->get('from')));
        $question->to = date('Y-m-d', strtotime($request->get('to')));
        $question->uniq_id = $request->get('uniq_id');

        question::find($id)->update($question);
        return redirect()->route('question.index')->with('success', 'question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        question::find($id)->delete();
        return redirect()->route('question.index')->with('success', 'question deleted successfully');
    }

    /**
     * Display a listing of the resource as JSON.
     *
     * @return json
     */
    public function getquestions()
    {
        $questions = Question::All();
        return response()->json(['questions' => $questions], 200);
    }


    /*
    * Excersion
    */
    public function getExcersion($id)
    {
        return view('excursion.create', compact('id'));
    }

    /*
    * Guest
    */
    public function getGuest($id)
    {
        return view('guest.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage from API.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postquestion(Request $request)
    {
        $question = new Question;
        $question->name = $request->get('name');
        $question->ship_name = $request->get('ship_name');
        $question->from = date('Y-m-d', strtotime($request->get('from')));
        $question->to = date('Y-m-d', strtotime($request->get('to')));
        $question->uniq_id = $request->get('uniq_id');
        $question->save();

        return response()->json(['question' => $question], 201);
    }

    /**
     * Store a newly created resource in storage from API.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postquestions(Request $request)
    {
        $jsonData = $request->json()->all();
        $questions = [];
        foreach ($jsonData['questions'] as $question) {
            $questions[] = array(
                'name' => $question['name'],
                'ship_name' => $question['ship_name'],
                'from' => $question['from'],
                'to' => $question['to'],
                'uniq_id' => $question['uniq_id']
            );
        };

        question::insert($questions);
        return response()->json($questions, 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * Import file into database Code
     *
     * @var array
     */
    public function importExcel(Request $request)
    {
        if ($request->hasFile('import_file')) {
            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                foreach ($data->toArray() as $key => $value) {
                    if (!empty($value)) {
                        foreach ($value as $v) {
                            $insert[] = ['title' => $v['title'], 'description' => $v['description']];
                        }
                    }
                }

                if (!empty($insert)) {
                    echo $insert;
                    exit;
                    return back()->with('success', 'Insert Record successfully.');
                }
            }
        }
        return back()->with('error', 'Please Check your file, Something is wrong there.');
    }
}
