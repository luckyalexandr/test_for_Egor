<?php

namespace frontend\controllers;

use frontend\forms\BookingForm;
use frontend\forms\ContentForm;
use frontend\forms\GeographyForm;
use frontend\forms\ManageBookingForm;
use frontend\forms\NotificationsForm;
use frontend\forms\ShoppingForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use frontend\services\BookingService;
use frontend\services\ContentService;
use frontend\services\GeographyService;
use frontend\services\ManageBookingService;
use frontend\services\NotificationsService;
use frontend\services\ShoppingService;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    private $content;
    private $notifications;
    private $manage;
    private $booking;
    private $shopping;
    private $geography;

    public function __construct($id, $module,
                                ContentService $content,
                                NotificationsService $notifications,
                                ManageBookingService $manage,
                                BookingService $booking,
                                ShoppingService $shopping,
                                GeographyService $geography,
                                $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->content = $content;
        $this->notifications = $notifications;
        $this->manage = $manage;
        $this->booking = $booking;
        $this->shopping = $shopping;
        $this->geography = $geography;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
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
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays about page.
     *
     * @return string|Response
     * @throws \Exception
     */
    public function actionAbout()
    {
        $form = new ManageBookingForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->manage->request($form);
                Yii::$app->session->setFlash('success', 'Success <br>' . $this->manage->request($form));
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'There was an error sending your request.');
            }
            return $this->refresh();
        }
        return $this->render('about', [
            'model' => $form,
        ]);
    }

    /**
     * Displays manage-booking page.
     *
     * @return string|Response
     * @throws \Exception
     */
    public function actionManageBooking()
    {
        $form = new ManageBookingForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->manage->request($form);
                Yii::$app->session->setFlash('success', 'Success <br>' . $this->manage->request($form));
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'There was an error sending your request.');
            }
            return $this->refresh();
        }
        return $this->render('manage-booking', [
            'model' => $form,
        ]);
    }

    /**
     * Displays booking page.
     *
     * @return string|Response
     * @throws \Exception
     */
    public function actionBooking()
    {
        $form = new BookingForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->booking->request($form);
                Yii::$app->session->setFlash('success', 'Success <br>' . $this->booking->request($form));
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'There was an error sending your request.');
            }
            return $this->refresh();
        }
        return $this->render('booking', [
            'model' => $form,
        ]);
    }

    /**
     * Displays shopping page.
     *
     * @return string|Response
     * @throws \Exception
     */
    public function actionShopping()
    {
        $form = new ShoppingForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->shopping->request($form);
                Yii::$app->session->setFlash('success', 'Success <br>' . $this->shopping->request($form));
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'There was an error sending your request.');
            }
            return $this->refresh();
        }
        return $this->render('shopping', [
            'model' => $form,
        ]);
    }

    /**
     * Displays geography page.
     *
     * @return string|Response
     * @throws \Exception
     */
    public function actionGeography()
    {
        $form = new GeographyForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->geography->request($form);
                Yii::$app->session->setFlash('success', 'Success <br>' . $this->geography->request($form));
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'There was an error sending your request.');
            }
            return $this->refresh();
        }
        return $this->render('geography', [
            'model' => $form,
        ]);
    }

    /**
     * Displays notifications page.
     *
     * @return string|Response
     * @throws \Exception
     */
    public function actionNotifications()
    {
        $form = new NotificationsForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->notifications->request($form);
                Yii::$app->session->setFlash('success', 'Success <br>' . $this->notifications->request($form));
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'There was an error sending your request.');
            }
            return $this->refresh();
        }
        return $this->render('notifications', [
            'model' => $form,
        ]);
    }

    /**
     * Displays content page.
     *
     * @return string|Response
     * @throws \Exception
     */
    public function actionContent()
    {
        $form = new ContentForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->content->request($form);
                Yii::$app->session->setFlash('success', 'Success <br>' . $this->content->request($form));
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'There was an error sending your request.');
            }
            return $this->refresh();
        }
        return $this->render('content', [
            'model' => $form,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }
}
