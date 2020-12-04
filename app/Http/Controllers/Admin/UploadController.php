<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\MediaExtension;
use App\MediaOriginal;
use App\MediaTranslated;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Media originals model associated with the controller.
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $originals;

    /**
     * Create a new controller instance.
     *
     * @param Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function __construct(MediaOriginal $originals)
    {
        $this->originals = $originals;
    }

    /**
     * Get media originals order by created_at field desc.
     *
     * @return object
     */
    public function getMediaOriginals()
    {
        $folder = config('maravel.media_originals_folder');

        $entries = $this->originals->all()
                               ->sortByDesc('created_at')
                               ->keyBy('id')
                               ->toArray();

        foreach ($entries as $key => &$entry) {
            $entry['html'] = getThumbnailName($folder . '/' . $entry['filename'], $entry['mime_type'],$entry['filename']);
        }

        return $entries;
    }

    /**
     * Get media translateds order by created_at field desc.
     *
     * @return object
     */
    public function getMediaTranslateds()
    {
        $folder = config('maravel.media_translateds_folder');

        $entries = $this->originals->all()
                               ->sortByDesc('created_at')
                               ->keyBy('id')
                               ->toArray();

        foreach ($entries as $key => &$entry) {
            $entry['html'] = getThumbnailName($folder . '/' . $entry['filename'], $entry['mime_type'],$entry['filename']);
        }

        return $entries;
    }

    /**
     * Get media extensions.
     *
     * @return object
     */
    public function getMediaExtensions()
    {
        $extensions = MediaExtension::getExtensionsString();
        $extensions = explode(',', $extensions);

        $result = '';
        foreach ($extensions as $key => $extension) {
            $result .= '.' . $extension . ',';
        }

        return $result;
    }

    /**
     * Get media from html.
     *
     * @param integer $id
     * @return string
     */
    public function getMediaHtml(Request $request)
    {
        $entry = $this->originals->findOrFail($request->id);
        $name = $request->name;

        return view('admin.partials.medias.form-media', compact('entry', 'name'));
    }
}
