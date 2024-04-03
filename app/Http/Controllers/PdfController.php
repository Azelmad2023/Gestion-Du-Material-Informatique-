<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Facades\Auth;
use PDF;

class PdfController extends Controller
{
    public function generatePdf($etablissementId)
    {
        $etablissement = Etablissement::findOrFail($etablissementId);

        $pdf = PDF::loadView('pdf.materiel', ['etablissement' => $etablissement]);

        return $pdf->download('materiel_informatique.pdf');
    }

    // public function generateEtablissementPdf()
    // {
    //     // Retrieve data needed for the PDF (you may need to adjust this based on your application structure)
    //     $etablissementWithMateriel = Auth::guard('etablissement')->user()->load('materielInformatiques');

    //     // Generate PDF using the retrieved data
    //     $pdf = PDF::loadView('etablissement.pdf', compact('etablissementWithMateriel'));

    //     // Optionally, you can save the PDF or output it directly to the browser
    //     // Example of saving the PDF
    //     $pdf->save(storage_path('app/public/etablissement_pdf.pdf'));

    //     // Example of returning the PDF as a response to be opened in the browser
    //     return $pdf->stream('etablissement_pdf.pdf');
    // }

    public function generateEtablissementPdf()
    {
        // Retrieve data needed for the PDF (you may need to adjust this based on your application structure)
        $etablissementWithMateriel = Auth::guard('etablissement')->user()->load('materielInformatiques');

        // Generate PDF using the retrieved data
        $pdf = PDF::loadView('etablissement.pdf', compact('etablissementWithMateriel'));

        // Optionally, you can save the PDF or output it directly to the browser
        // Example of saving the PDF
        $pdf->save(storage_path('app/public/etablissement_pdf.pdf'));

        // Example of forcing the PDF to download
        return $pdf->download('etablissement_pdf.pdf');
    }
}
