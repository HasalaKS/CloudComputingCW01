<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{

    public function index()
    {
        $files = Storage::disk('s3')->files('files');

        $data = [];
        foreach($files as $file) {
            $data[] = [
                'name' => basename($file),
                'downloadUrl' => url('/download/'.base64_encode($file)),
                'removeUrl' => url('/remove/'.base64_encode($file)),
            ];
        }

        return view('upload', ['files' => $data]);
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

}
