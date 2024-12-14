<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Dress;

class UploadController extends Controller
{

    public function index()
    {
        $files = Storage::disk('s3')->files('files');


        $data = [];
        foreach($files as $file) {
            // dump($file);
            $dressDetails = Dress::where('file_path', basename($file))->first();
            $data[] = [
                'url' => 'https://gayaniawsbucket.s3.us-east-2.amazonaws.com/files/',
                'name' => basename($file),
                'downloadUrl' => url('/download/'.base64_encode($file)),
                'removeUrl' => url('/remove/'.base64_encode($file)),
                'id' => $dressDetails['id'],
                'type' => $dressDetails['type'],
                'price' => $dressDetails['price'],
                'material' => $dressDetails['material'],
                'quantity' => $dressDetails['quantity'],
            ];
        }

        return view('upload', ['files' => $data]);
    }

//     public function index()
// {
//     $dresses = Dress::all();

//     $files = $dresses->map(function ($dress) {
//         return [
//             'url' => 'https://gayaniawsbucket.s3.us-east-2.amazonaws.com/' . $dress->file_path,
//             'name' => basename($dress->file_path),
//             'downloadUrl' => url('/download/' . base64_encode($dress->file_path)),
//             'removeUrl' => url('/remove/' . base64_encode($dress->file_path)),
//             'type' => $dress->type,
//             'price' => $dress->price,
//             'size' => $dress->size,
//             'material' => $dress->material,
//             'quantity' => $dress->quantity,
//         ];
//     });

//     return view('upload', ['files' => $files]);
// }



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

    public function destroy($file)
    {
        $file = base64_decode($file);
        Storage::disk('s3')->delete($file);
        return back()->withSuccess('File was deleted successfully');
    }

//    public function download($file)
//    {
//        $file = base64_decode($file);
//        $name = basename($file);
//        Storage::disk('s3')->download($file, $name);
//        return back()->withSuccess('File downloaded successfully');
//    }

    public function download($file)
    {
//        $booking_attachment = $this->bookingAttachmentRepo->find($document_id);
//        $fileName = $booking_attachment->file_name;
//        $booking_id = $booking_attachment->booking_id;
//
//        $saveFilename = explode("DATA_SEPARATOR", $file);

        $file = base64_decode($file);
        $name = basename($file);
        Storage::disk('s3')->download($file, $name);
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename=' . $name[1],
        ];
            return Storage::disk('s3')->download($file, $name[1], $headers);
    }

    public function saveItem(Request $request)
    {
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = time() . $file->getClientOriginalName();
            $filePath = 'files/' . $name;
    
            // Upload file to S3
            Storage::disk('s3')->put($filePath, file_get_contents($file));
    
            // Save record in the database
            Dress::create([
                'type' => $request->input('type'),
                'price' => $request->input('price'),
                'size' => $request->input('size'),
                'material' => $request->input('material'),
                'quantity' => $request->input('quantity'),
                'file_path' => $filePath,
            ]);
    
            return back()->withSuccess('File and data uploaded successfully');
        }
    
        return back()->withErrors('Failed to upload file');
    }

}
