<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class UploadManager
{
    /**
     * Upload file in a specific path.
     *
     * @param  UploadedFile $file
     * @param  string $path
     * @return string
     */
    public function upload(UploadedFile $file, $path)
    {
        $filename = $this->createFilename($file);

        $result = $file->move($path, $filename);

        return $filename;
    }

    /**
     * Get file details
     *
     * @param  UploadedFile $file
     * @return array
     */
    public function getFileDetails(UploadedFile $file)
    {
        $path = $file->path();

        $extension = $file->getClientOriginalExtension();
        $mime_type = $file->getClientMimeType();
        $size = filesize($path);

        $data = [];
        if ($this->isImage($mime_type)) {
            list($width, $height) = getimagesize($path);
            $data = compact('width', 'height');
        }

        return array_merge(
            compact('extension', 'mime_type', 'size'),
            $data
        );
    }

    /**
     * Create unique filename.
     *
     * @param  UploadedFile $file
     * @return string
     */
    private function createFilename(UploadedFile $file)
    {
        $filename = str_slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $extension = $file->getClientOriginalExtension();

        return $filename . '-' . uniqid() . '.' . $extension;
    }

    /**
     * Is the mime type an image.
     *
     * @param  string  $mimeType
     * @return boolean
     */
    private function isImage($mimeType)
    {
        return starts_with($mimeType, 'image/');
    }
}
