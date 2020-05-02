<?php

use App\Provider;

namespace App\Services;

class ProviderOrArticle {
    public function getProviders(){
        $providers = \App\Provider::all()->pluck('name', 'id');
        return $this->providers = $providers;
    }
   
}