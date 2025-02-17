<?php 

namespace App\Services;

use App\Models\All\TmpImage;

class DocumentUploadService {


    public function handleDocumentUpload($model, $documents, $collection, $action)
    {
        $document_filename = [];
        $uploaded_documents = [];

            $action == "update" ?  $model->clearMediaCollection($collection) : "";

            foreach($documents as $doc):  // loop array of documents

                $document_filename[]= $doc;

                // 
               $uploaded_documents[] = $model
                                    ->addMedia(storage_path('/app/public/tmp/'. $doc))
                                    ->toMediaCollection($collection)
                                    ->getUrl(); // move the document from the storage disk to the new media disk

            endforeach;


            TmpImage::whereIn('filename', $document_filename)->delete(); // get the tmp documents from the db & remove it

            return $uploaded_documents;

    }
}