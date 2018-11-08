<?php
namespace frontend\controllers;


use common\models\Cities;
use common\models\Countries;

use common\models\States;
use common\models\Verify;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Location controller
 */
class LocationController extends Controller
{

    public $layout = "main";

    public function actionCountry()
    {
        $unique = Verify::userVerify();
        if(!$unique)
        {
            ///$this->redirect(Url::toRoute('site/verify'));
        };
        $model = Countries::find()->all();
        return $this->render('country', [
            'model' => $model,
        ]);
    }

    public function actionStates($id)
    {
        $model = States::find()->where(['country_id'=>$id])->all();
        $country = Countries::find()->where(['id'=>$id])->one();

        return $this->render('states', [
            'model' => $model,
            'country'=>$country
        ]);
    }

    public function actionCities($id,$countryId)
    {
        $model = Cities::find()->where(['state_id'=>$id])->all();
        $state = States::find()->where(['id'=>$id])->one();

        $country = Countries::find()->where(['id'=>$countryId])->one();

        return $this->render('cities', [
            'model' => $model,
            'state' => $state,
            'country'=>$country
        ]);
    }

    public function actionCountrym()
    {
        $this->layout = "mobile";
        $unique = Verify::userVerify();
        if(!$unique)
        {
            ///$this->redirect(Url::toRoute('site/verify'));
        };
        $model = Countries::find()->all();
        return $this->render('countrym', [
            'model' => $model,
        ]);
    }

    public function actionStatesm($id)
    {
        $this->layout = "mobile";
        $model = States::find()->where(['country_id'=>$id])->all();
        $country = Countries::find()->where(['id'=>$id])->one();

        return $this->render('statesm', [
            'model' => $model,
            'country'=>$country
        ]);
    }

    public function actionCitiesm($id,$countryId)
    {
        $this->layout = "mobile";
        $model = Cities::find()->where(['state_id'=>$id])->all();
        $state = States::find()->where(['id'=>$id])->one();

        $country = Countries::find()->where(['id'=>$countryId])->one();

        return $this->render('citiesm', [
            'model' => $model,
            'state' => $state,
            'country'=>$country
        ]);
    }


}
