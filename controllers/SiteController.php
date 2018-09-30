<?php

namespace app\controllers;

use app\models\PrizeLimits;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays prizes.
     *
     * @return string
     */
    public function actionPrizes()
    {
       if (!Yii::$app->user->isGuest) {
           $userModel = Yii::$app->user->identity;

           return $this->render('prizes', ['user' => $userModel]);
       } else {
           throw new NotFoundHttpException;
       }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Calculate limits.
     *
     * @return int
     */
    public function actionCalculateLimits()
    {
        if (Yii::$app->request->isPost){
            $type = Yii::$app->request->post('type');
            if ((!is_null($type)) and (is_string(strip_tags($type)))){
                $limit = PrizeLimits::getLimit($type);
                if ($limit == 0){
                    $newLimit = Yii::$app->params[$type.'Limit'] - 1;
                } else {
                    $newLimit = $limit - 1;
                }
                PrizeLimits::updateLimit($type, $newLimit);
                return $newLimit;
            } else {
                return 0;
            }
        }
    }

    /**
     * Result prize page.
     *
     * @return string
     */
    public function actionResultPage()
    {
        if (Yii::$app->request->isPost){
            $type = Yii::$app->request->post('type');
            $image = Yii::$app->request->post('image');
            if (((!is_null($type)) and (is_string(strip_tags($type)))) and ((!is_null($image)) and (is_string(strip_tags($image))))){
                $session = Yii::$app->session;
                $result['message'] = 'Congratulations! You win! ';
                if ($type=='money'){
                    $money = rand(Yii::$app->params['moneyRange'][0], Yii::$app->params['moneyRange'][1]);
                    $result['message'] .= $money.'$ ';
                } elseif ($type=='bonus'){
                    $bonus = rand(Yii::$app->params['bonusRange'][0], Yii::$app->params['bonusRange'][1]);
                    $result['message'] .= $bonus.' bonus points. ';
                }
                $result['image'] = $image;
                $result['type'] = $type;
                switch ($type) {
                    case 'money':
                        $session->set('money', $money);
                        $result['url']='/site/money-result';
                        break;
                    case 'obj':
                        $session->set('obj', 'yes');
                        $result['url']='/site/obj-result';
                        break;
                    case 'bonus':
                        $session->set('bonus', $bonus);
                        $result['url']='/site/bonus-result';
                        break;
                    default:
                        $result['url']='/site/prizes';
                        break;
                }
                return $this->renderPartial('partial/_prizes_result', ['result' => $result]);
            } else {
                return null;
            }
        }
    }

    /**
     * Result bonus action.
     */
    public function actionBonusResult()
    {
        $session = Yii::$app->session;
        if ($session->has('bonus')){
            $balance = $session->get('bonus');
            User::updateBalance($balance);
            $session->remove('bonus');
        }
        return $this->redirect('/site/prizes');
    }

    /**
     * Result money page.
     */
    public function actionMoneyResult()
    {
        $session = Yii::$app->session;
        if ($session->has('money')){
            $money = $session->get('money');
            return $this->render('/site/money_result', ['money' => $money]);
        } else {
            return $this->redirect('/site/prizes');
        }
    }

    /**
     * Convert money to bonus points action.
     */
    public function actionConvert()
    {
        $session = Yii::$app->session;
        if ($session->has('money')){
            $money = $session->get('money');
            $balance = intval($money * Yii::$app->params['moneyConversionRatio']);
            User::updateBalance($balance);
            $session->remove('money');
            return $this->redirect('/site/prizes');
        } else {
            return $this->redirect('/site/prizes');
        }
    }

    /**
     * Transfer money page.
     */
    public function actionTransfer()
    {
        if (Yii::$app->request->isPost){
            return $this->render('/site/money_transfer_result');
        } else {
            $session = Yii::$app->session;
            if ($session->has('money')) {
                $money = $session->get('money');
                $session->remove('money');
                return $this->render('/site/money_transfer', ['money' => $money]);
            } else {
                return $this->redirect('/site/prizes');
            }
        }
    }

    /**
     * Object result page.
     */
    public function actionObjResult()
    {
        if (Yii::$app->request->isPost){
            return $this->render('/site/obj_transfer_result');
        } else {
            $session = Yii::$app->session;
            if ($session->has('obj')) {
                $session->remove('obj');
                return $this->render('/site/obj_result');
            } else {
                return $this->redirect('/site/prizes');
            }
        }
    }
}
