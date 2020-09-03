<?php

namespace App\Traits;

trait Uploadtrait {
    

    private function imageUpload($images, $imageColumn = null){
        
        $uploadImages = [];
        if(is_array($images)){
            foreach($images as $image){
                $uploadImages[] = [$imageColumn => $image->store('products' ,'public')];
            }
        } else {
            $uploadImages = $images->store('logo', 'public');
        }

        return $uploadImages;
    }
}