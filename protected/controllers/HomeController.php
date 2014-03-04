<?php

class HomeController extends Controller
{
	public $layout='fb';

	public function actionIndex()
	{
		$this->pageTitle = 'おもしろ診断盛りだくさんの【ただいま診断中】';
		$criteria = new CDbCriteria();
		$criteria->condition = 'is_publish = 1';
		$criteria->order = 'id DESC';
		$dataProvider=new CActiveDataProvider('Questions',array(
			'criteria' => $criteria,
			'pagination'=>array(
	        'pageSize'=>10,
	        'pageVar' => 'page'
	    ),));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionFavorite()
	{
		$this->pageTitle = 'ランキング｜おもしろ診断盛りだくさんの【ただいま診断中】';
		$criteria = new CDbCriteria();
		$criteria->condition = 'is_publish = 1';
		$criteria->order = 'count DESC,id DESC';
		$dataProvider=new CActiveDataProvider('Questions',array(
			'criteria' => $criteria,
			'pagination'=>array(
	        'pageSize'=>10,
	        'pageVar' => 'page'
	    ),));
		$this->render('favorite',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionQuestion($id = null)
	{
		$model=Questions::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

		$this->pageTitle = '診断｜'.$model->title.'【ただいま診断中】';

		// Resgister open graph

		Yii::app()->clientScript->registerMetaTag($model->title, null, null, array('property' => 'og:title'));
		if (!$model->app_type)
			Yii::app()->clientScript->registerMetaTag($model->description, null, null, array('property' => 'og:description'));

		Yii::app()->clientScript->registerMetaTag($model->app->fb_app_id, null, null, array('property' => 'fb:app_id'));
		if (!empty($model->image)) {
			$img = Yii::app()->controller->createAbsoluteUrl("/") .  ImageHelper::thumb(600,450,'/uploads/' .$model->image);
	    	$img = str_replace('/index.php', '', $img);
			Yii::app()->clientScript->registerMetaTag($img, null, null, array('property' => 'og:image'));
		}

		$this->render('question' , array('model' => $model));
	}

	public function actionAnswer($id = null, $share = 1)
	{
		$model=Questions::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

		$this->pageTitle = '診断｜'.$model->title.'【ただいま診断中】';

		if (! $model->checkPermission($share)) {
			$this->redirect('/home/question?id='. $id);
		}

		$recommended = $model->getRecommended($model->id);


		$this->render('answer', array('model' => $model, 'share' => $share, 'recommended' => $recommended));
	}


	public function actionStore()
	{
		if (isset($_POST['ajax'])) {
			$name = "";

			if (isset($_POST['user']['name'])) {
				$name = $_POST['user']['name'];
			} else if (isset($_POST['user']['first_name']) && isset($_POST['user']['last_name']) ) {
				$name = $_POST['user']['first_name'] . ' ' . $_POST['user']['last_name'];
			}

			$fid = 0;
			if (isset($_POST['user']['id'])) {
				$fid = $_POST['user']['id'];
			}

			$email = "";

			if (isset($_POST['user']['email'])) {
				$email = $_POST['user']['email'];
			}

			$birthday = "";

			if (isset($_POST['user']['birthday'])) {
				$birthday = $_POST['user']['birthday'];
				$birthday = date('Y-m-d',strtotime($birthday));
			}

			$currentYear= date('Y');
			$bornYear= date('Y',strtotime($birthday));
			$age = $currentYear - $bornYear;

			$gender = "";

			if (isset($_POST['user']['gender'])) {
				$gender = $_POST['user']['gender'];
			}

			$location = "";

			if (isset($_POST['user']['location']['name'])) {
				$location = $_POST['user']['location']['name'];
			}

			$hometown = "";

			if (isset($_POST['user']['hometown']['name'])) {
				$hometown = $_POST['user']['hometown']['name'];
			}

			$relationship_status = "";

			if (isset($_POST['user']['relationship_status'])) {
				$relationship_status = $_POST['user']['relationship_status'];
			}

			$app_id = 0;

			if (isset($_POST['app_id'])) {
				$app_id = $_POST['app_id'];
			}


			$question_id = 0;

			if (isset($_POST['question_id'])) {
				$question_id = $_POST['question_id'];
				$modelQuestions =Questions::model()->findByPk($question_id);
				if($modelQuestions ===null )
					throw new CHttpException(404,'The requested page does not exist.');
				$modelQuestions->count +=1;

				// set count today and month

				$dayCache=Yii::app()->cache->get('date.question.' . $question_id);
				if($dayCache===false)
				{
				    Yii::app()->cache->set('date.question.' . $question_id, date('d-m-Y'));
				    Yii::app()->cache->set('month.question.' . $question_id, '1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0');
				    $modelQuestions->count_today = 1;
				    $modelQuestions->count_month = 1;
				}
				else
				{
					// Check is new day or current day
					if ($dayCache == date('d-m-Y')) {
						$modelQuestions->count_today += 1;

						$monthStr = Yii::app()->cache->get('month.question.' . $question_id);
						$monthArr = explode(',', $monthStr);
						$countAll = 0;
						foreach ( $monthArr  as $key => $counter) {
							$countAll += $counter;
						}

						$monthArr[count($monthArr) - 1] +=1;
						$monthStr = Yii::app()->cache->set('month.question.' . $question_id,implode(',', $monthArr));

				    	$modelQuestions->count_month = $countAll + 1;
					}
					else
					{
						Yii::app()->cache->set('date.question.' . $question_id, date('d-m-Y'));
						$modelQuestions->count_today = 1;

				    	$monthStr = Yii::app()->cache->get('month.question.' . $question_id);
						$monthArr = explode(',', $monthStr);
						$countAll = 0;

						$tmpArr = array();
						for ( $key = 1; $key < count($monthArr) ; $key++) {
							$countAll += $monthArr[$key - 1];
							$tmpArr[] = $monthArr[$key - 1];
						}

						$tmpArr[count($monthArr) - 1] =1;

						$monthStr = Yii::app()->cache->set('month.question.' . $question_id,implode(',', $tmpArr));

				    	$modelQuestions->count_month = $countAll + 1;
					}
				}

				if (!$modelQuestions->save()) {
					dump( $modelQuestions->getErrors() );
				}

			}

			if ($app_id && $fid && $question_id) {
				$exists = FacebookUsers::model()->exists('facebook_id = :fid and app_id = :app_id and question_id = :question_id',array(':fid' => $fid, ':app_id' => $app_id , ':question_id' => $question_id));

				if (!$exists) {
					$model=new FacebookUsers;
					$model->created = date('Y-m-d H:i:s');
				}
				else
				{
					$model = FacebookUsers::model()->find('facebook_id = :fid and app_id = :app_id and question_id = :question_id',array(':fid' => $fid, ':app_id' => $app_id , ':question_id' => $question_id));
				}

				if (isset($_POST['finish'])) {
					$model->finished = date('Y-m-d H:i:s');
				}

				$model->app_id = $app_id;
				$model->facebook_id = $fid;
				$model->question_id = $question_id;
				if (!empty($name))
					$model->name = $name;

				if (!empty($gender))
				$model->gender = $gender;

				if (!empty($birthday))
				$model->birthday = $birthday;

				if ($age)
				$model->age = $age;

				if (!empty($location))
				$model->location = $location;

				if (!empty($hometown))
				$model->hometown = $hometown;

				if (!empty($email))
				$model->email = $email;

				if (!empty($relationship_status))
				$model->relationship = $relationship_status;

				if (isset($_POST['share']) && $_POST['share'] ) {
					// $modelQuestions->currentResult = Yii::app()->session['currentResult'];
					// $modelQuestions->shareLink();
				}

				if ($model->validate()) {
					if ($model->save()) {
						jsonOut(array('fb' => $model->attributes , 'status' => 'success' ));
					} 
					else
					{
						jsonOut(array('fb' => $model->attributes , 'status' => 'fail' , 'error' => $model->getErrors()	));
					}
				}
				else
				{
					jsonOut(array('fb' => $model->attributes , 'status' => 'fail' , 'error' => $model->getErrors()	));
				}




			} else {
				jsonOut(array('status' => 'fail' , 'app_id' => $app_id, 'fid' => $fid	));
			}

		}
	}
}
