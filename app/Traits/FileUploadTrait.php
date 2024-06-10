<?php

namespace App\Traits;

use Illuminate\Http\Request;
use File;

trait FileUploadTrait
{
    /**
     * Handle the file upload process
     * 
     * @param Request $request The request containing the file
     * @param string $fileName The name of the file input field
     * @param string $dir The directory where the file should be uploaded
     * @param ?string $oldPath The path of the old file to be deleted (if any)
     * @return string|null The new file path or null if no file was uploaded
     */
    public function handleFileUpload(Request $request, string $fieldName, ?string $oldPath = null, string $dir = "uploads") : ?String
    {
        // Check request has file
        if(!$request->hasFile($fieldName)) {
            return null;
        }
        
        // Delete the existing image if exist
        if ($oldPath && File::exists(public_path($oldPath))) {
            File::delete(public_path($oldPath));
        }

        $file = $request->file($fieldName);
        $extension = $file->getClientOriginalExtension();
        $updatedFileName = \Str::random(30).".".$extension;
        $file->move(public_path($dir), $updatedFileName);
        $newFilePath = $dir."/".$updatedFileName;

        return $newFilePath;
    }
}