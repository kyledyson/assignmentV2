<?php

namespace app\controllers;

use app\models\Category;
use app\models\Image;
use phpDocumentor\Reflection\Location;
use Yii;
use yii\helpers\Html;
use app\models\Item;
use app\models\ItemSearch;
use app\models\ItemQuery;
use app\models\Area;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


use app\components\helpers\AccessHelper;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{
    public $categories;
    public $locations;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'index', 'view', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                    ],
                    // access control 
                    // only authenticated users can access following actions
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
                // specifies exception to throw when any of rules above are breached
                'denyCallback' => function ($rule, $action) {
                    throw new ForbiddenHttpException('Please login or create an account to access this page.');
                }
            ],
        ];
    }

    public function init()
    {
        parent::init();
        $this->categories = ArrayHelper::map(Category::find()->all(), 'id', 'name');
        $this->locations = ArrayHelper::map(Area::find()->all(), 'id', 'county');

    }

    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $sort = $dataProvider->getSort();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $this->categories,
            'locations' => $this->locations,
            'sort' => $sort
        ]);
    }

    /**
     * Displays a single Item model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Item();
        $image = new Image();
        if (Yii::$app->request->isPost) {

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
//                var_dump($_POST);

                $image->imageFiles = UploadedFile::getInstances($image, 'imageFiles');
//                var_dump($image->validators);die;
                if (!$image->imageFiles){
                    $model->addError('imageFiles', 'Please add at least 1 image.');
                    $image->validate();
                }
//                var_dump($image->imageFiles);die;
                if ($image->upload($model)) {

                    // file is uploaded successfully
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'categories' => $this->categories,
            'locations' => $this->locations,
            'image' => $image

        ]);
    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \yii\web\HttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // checks if the current user is owner of item
        if (AccessHelper::hasAccessToPost($model)) {
            throw new \yii\web\HttpException(403, 'You do not have access to this post');
        }
        list($initialPreview, $initialPreviewConfig) = $this->getInitialPreview($model->id);
        $image = new Image();
        if (Yii::$app->request->isPost) {
            // gets images uploaded
            $image->imageFiles = UploadedFile::getInstancesByName('imageFiles');
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                if ($image->upload($model)) {
                    // file is uploaded successfully
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
            'categories' => $this->categories,
            'locations' => $this->locations,
            'initialPreview' => $initialPreview,
            'initialPreviewConfig' => $initialPreviewConfig

        ]);
    }

    private function getInitialPreview($id)
    {
        $images = Image::find()->where(['item_id' => $id])->all();
        $initialPreview = [];
        $initialPreviewConfig = [];
        foreach ($images as $key => $value) {
            array_push($initialPreview, '/uploads/' . $value->path);
            array_push($initialPreviewConfig, [
                'caption' => $value->path,
                'width' => '120px',
                'key' => $key,
            ]);
        }
        return [$initialPreview, $initialPreviewConfig];
    }

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        // checks if the current user is owner of item
        if (AccessHelper::hasAccessToPost($model)) {
            throw new \yii\web\HttpException(403, 'You do not have access to this post');
        }
        $model->delete();
        $this->redirect('index');
    }

    public function actionDeleteImage($id)
    {
        $deleteKey = Yii::$app->request->post('key');
        $model = $this->findModel($id);
        foreach ($model->images as $key => $value) {
            if ($key == $deleteKey) {
                $model->unlink('images', $value, true);
            }
        }
        return true;
    }

    public function actionYourItems()
    {
        $searchModel = new ItemSearch();

        $dataProvider = new ActiveDataProvider([
            'query' => Item::find()->owner(),
        ]);

        $sort = $dataProvider->getSort();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $this->categories,
            'locations' => $this->locations,
            'sort' => $sort
        ]);
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
