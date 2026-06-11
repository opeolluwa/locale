<?php

namespace app\controllers;

use app\models\Country;
use yii\web\Response;



///Two actions are now available:

// actionGetAll — GET /index.php?r=country/get-all — returns all countries
// actionGet — GET /index.php?r=country/get&id=<identifier> — returns a single
class CountryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $countries = Country::find()->all();

        return [
            'status' => 'success',
            'data' => $countries,
        ];
    }

    public function actionGetAll()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $countries = Country::find()->all();

        return [
            'status' => 'success',
            'data' => $countries,
        ];
    }

    public function actionGet($id)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $country = Country::findOne(['identifier' => $id]);

        if ($country === null) {
            \Yii::$app->response->statusCode = 404;
            return ['status' => 'error', 'message' => 'Country not found'];
        }

        return [
            'status' => 'success',
            'data' => $country,
        ];
    }
}
