<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\Dress;

class ReportController extends Controller
{
    public function downloadReport(Request $request)
    {
        // Validate the input dates
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Retrieve data from the 'dress' table based on the date range
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $data = Dress::select('id', 'type', 'price', 'material', 'file_path', 'quantity', 'created_at')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        if($data->isEmpty()){
            return redirect()->back()->with('info', 'The selected date range has no data.');
        }
        // Prepare CSV headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="report.csv"',
        ];

        // Convert data to CSV format
        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            $fileUrl = 'https://gayaniawsbucket.s3.us-east-2.amazonaws.com/files/';
            // Add CSV headers (column names)
            fputcsv($file, ['ID', 'Type', 'Price', 'Material', 'Image Url', 'Quantity', 'Created At']);

            // Add rows to the CSV
            foreach ($data as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->type,
                    $row->price,
                    $row->material,
                    $fileUrl . $row->file_path,
                    $row->quantity,
                    $row->created_at,
                ]);
            }

            fclose($file);
        };

        // Return the CSV file as a response
        return Response::stream($callback, 200, $headers);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|max:2048'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = time() . $file->getClientOriginalName();
            $filePath = 'files/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
        }

        Dress::create([
            'type' => $request->input('type'),
            'price' => $request->input('price'),
            'size' => $request->input('size'),
            'material' => $request->input('material'),
            'quantity' => $request->input('quantity'),
            'file_path' => $name,
        ]);
        return back()->withSuccess('File uploaded successfully');
    }
}
