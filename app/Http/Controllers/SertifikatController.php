<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use setasign\Fpdi\Fpdi;

class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function process(Request $request)
    {
        // $nama = "M. Rosyid Ridho";
        // $course = 'Piano Basic';
        // $outputfile = public_path('sertifikat.pdf');
        // $this->fillPDF(public_path().'/sertifikat/sertifikat.pdf', $outputfile, $nama);

        // return response()->file($outputfile);

        // dd($request->all());

        $pdf = new Fpdi();

        $nama = Auth::user()->name;
        $course = $request->title_course;
        // $level = $request->level_course;
        // To add a page
        $pdf->AddPage();

        $pdf->AddFont('Comic','','COMIC.php');
        $pdf->AddFont('Boldy','','Boldy.php');

        // to set font. This is compulsory


        // set the source file
        // Below is the path of pdf in which you going to print details.
        //  Right now i had blank pdf
        $path = public_path("sertifikat.pdf");

        // Set path
        $pdf->setSourceFile($path);

        // import page 1
        // define page number
        // if you want to print detail in page to you have to write 2 instead of 1.
        // right now we have only one page pdf.

        $tplId = $pdf->importPage(1);
        // use the imported page and place it at point 10,10 with a width of 100 mm
        $pdf->useTemplate($tplId, null, null, null, 210, true);

        // Now this details we are going to print in pdf.
        // Horizontal and veritcal setXY


        // $pdf->SetXY(120, 90);
        // Details you want to print

        // Now let's change details an position
        // $pdf->Write(0.1, $nama);
        $pdf->SetFont('Boldy','','36');
        $pdf->SetY(80);
        $pdf->Cell(0, 20, $nama, 0, 1, 'C');

       // let's bring another below it

        // Second details
        $pdf->SetFont('comic','','16');
        $pdf->SetY(110);
        $pdf->Cell(0, 20, $course, 0, 1, 'C');

        // $pdf->SetXY(40, 60);
        // $pdf->Write(0.1,"Feel free to comment.");

        // Now this showing as preview in browser
// This is output
// let's check now by running project. But before that we have to add Route.

        // Because I is for preview for browser.
        return $pdf->Output('D', $nama.'-'.$course.'.pdf', true);

        // return redirect()->back();
    }
}
