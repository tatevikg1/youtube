<?php
namespace backend\controllers;

use yii\web\Controller;


/**
 * Hello controller
 */
class HelloController extends Controller
{
    /**
     * {@inheritdoc}
     */

     public function actionIndex()
     {
        return $this->render('index'); 
     }
   
}
