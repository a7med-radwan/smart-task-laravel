<?php

namespace App\Actions;

use Illuminate\Http\Request;

class FileUpload
{
    // We inject the current HTTP Request instance into this action class automatically via Laravel's service container.
    public function __construct(protected Request $request)
    {
        //
    }

    /**
     * Store the uploaded file to public storage.
     *
     * @param  string  $key  The name of the input field (e.g. 'avatar')
     * @param  string  $path  The folder name to store files inside (e.g. 'avatars')
     * @param  string  $disk  The target filesystem disk (e.g. 'public')
     * @return string|null The stored file path or null if no file was uploaded
     */
    public function handle(string $key, $path = '/', $disk = 'public'): ?string
    {
        // Retrieve the uploaded file object from the request.
        $file = $this->request->file($key);
        if (! $file) {
            return null;
        }

        // Store the file and return its generated relative file path string.
        return $file->store($path, $disk);
    }
}
