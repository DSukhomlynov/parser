<?php

namespace app\models;

use DOMDocument;
use phpDocumentor\Reflection\Types\Null_;
use yii\db\ActiveRecord;

// подключаем Guzzle

class MyList extends ActiveRecord
{
    public static function tableName()
    {
         return 'pars';
    }

    public static function getAll()
    {
       $data = self::find()->all();
       return $data;
    }

    public static function getOne($id)
    {
        $data = self::find()->where(['id'=>$id])->one();
        return $data;
    }


    public static function getCurs($currency)
    {
        $xml = new DOMDocument();
        $url = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date('d.m.Y');


            @$xml->load($url);
            $root = $xml->documentElement;
            $items = $root->getElementsByTagName('Valute');

            foreach ($items as $item)
            {
                $code = $item->getElementsByTagName('CharCode')->item(0)->nodeValue;
                $curs = $item->getElementsByTagName('Value')->item(0)->nodeValue;
                if($code == $currency)
                {
                    $course = floatval(str_replace(',', '.', $curs));
                }
            }
        return $course;
    }

    public static function parsing($url)
    {
        function get_content($url)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $res = curl_exec($ch);
            curl_close($ch);
            return $res;
        }

        function parserAli($url)
        {
            $file = get_content($url);
            $doc = \phpQuery::newDocument($file);
            $product[0] = $doc->find('.product-name')->text(); //Продукт
            $product[1] = $doc->find('#magnifier');  //Изображение
            $product[2] = $doc->find('#j-sku-price')->text(); //Цена
            $product[3] = 0; //Доставка
            $product[4] = $doc->find('#j-sku-price span:eq(1)')->text(); //Мин и макс цена

            if (!empty($product[4])) {
                unset ($product[2]);
                $product[2] = $product[4];
            }
            $product[2] = str_replace(",", ".", $product[2]);
            $product[2]=preg_replace("/[^x\d|*\.]/","",$product[2]);

            return $product;
        }

        function parserEbay($url)
        {
            $file = get_content($url);
            $doc = \phpQuery::newDocument($file);
            $product[0] = $doc->find('#itemTitle')->text(); //Титл
            $product[1] = $doc->find('.img300 tr:eq(1)'); //Изображение
            $product[2] = $doc->find('#prcIsum')->text();//Валюта
            $product[3] = $doc->find('#fshippingCost')->text();//Доставка
            $product[4] = $doc->find('#convbinPrice')->text();//Валюта в баксах при иностранной
            $product[5] = $doc->find('#prcIsum_bidPrice')->text();//Валюта
            $product[4] = substr("$product[4]", 0, -20);

            if (empty($product[2]))
            {
                $product[2] = $product[5];
            }

            if (!empty($product[4]))
            {
                unset ($product[2]);
                $product[2] = $product[4];
            }

            $product[2] = substr("$product[2]",4);
            $product[3] = substr("$product[3]",8);

            $product[2]=strtr($product[2],array(','=>''));
            $result = 'Ebay';

            return $product;
        }

        $error[0] = 'Нет заголовка';
        $error[1] = 'Нет изображения';
        $error[2] = 'Нет цены';
        $error[3] = 'Нет цены доставки';

        if (stristr("$url", "ebay.com")) {
            $parserEbay = parserEbay($url);
            return $parserEbay;
        }
        if (stristr("$url", "aliexpress.com")) {
            $parserAli = parserAli($url);
            return $parserAli;
        }
        else
        {
            return $error;
        }
    }

}