<?php

namespace Ceek;

/* TINKER COMMAND

$c = new Ceek\CodeImporter

*/

use Sellout\Promo;
use Sellout\PromoCode;

class CodeImporter
{

    protected $dir = '/sites/sellout.dev/codes/';

    public function __construct()
    {
        $files = $this->_getFiles();
        $files = $this->_removeCrap($files);
        $promo = $this->_getPromo();
        $codes = $this->_addCodesToPromo($files, $promo);
    }
    private function _parseFile($file)
    {
        $csv = array_map('str_getcsv', file($this->dir . $file));
        return $csv;
    }
    private function _addCodesToPromo($files, Promo $promo)
    {
        foreach($files as $file)
        {
            $codes = $this->_parseFile($file);
            foreach($codes as $code)
            {
                if(strlen($code[0]) > 10 && strlen($code[0] < 20))
                {
                    $promoCode = new PromoCode;
                    $promoCode->code = $code[0];
                    $promoCode->promo_id = $promo->id;
                    $promoCode->save();
                }
            }
        }
    }
    private function _getPromo()
    {
        $promo = Promo::find(1);
        if($promo === null)
        {
            $promo = new Promo;
            $promo->name = 'Megadeth: Dystopia Bundle';
            $promo->description = 'Megadeth: Dystopia Bundle Promotion';
            $promo->promo_cost = 0;
            $promo->starts = '1/22/16';
            $promo->expires = false;
            $promo->admin_invalidated = 0;
            $promo->catalog_id = 'Catalog-8e867501-b90b-463a-8a7f-18603e517566';
            $promo->save();
        }
        return $promo;
    }
    private function _removeCrap($files)
    {
        foreach($files as $k => $file)
        {
            if(substr($file, -4) !== '.csv') unset($files[$k]);
        }
        return $files;
    }
    private function _getFiles()
    {
        return scandir($this->dir);
    }

}
