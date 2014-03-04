<?php

/**
 * This is the model class for table "questions".
 *
 * The followings are the available columns in table 'questions':
 * @property string $id
 * @property integer $app_type
 * @property string $app_id
 * @property string $title
 * @property string $description
 * @property string $scenario
 * @property string $contents
 * @property string $anwser_result
 * @property string $permissions
 * @property string $fb_page_id
 * @property string $fb_page_url
 *
 * The followings are the available model relations:
 * @property Answers[] $answers
 * @property Apps $app
 */
class Questions extends CActiveRecord
{

 	public $currentResult = "";

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'questions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_id, anwser_result,intro', 'required'),
			array('image', 'file', 'types'=>'jpg, gif, png' ,'allowEmpty'=>true, 'on'=>'insert,update'),
			array('app_type', 'numerical', 'integerOnly'=>true),
			array('app_id,count,count_today,count_month', 'length', 'max'=>11),
			array('title, description,contents, scenario, permissions, fb_page_id, fb_page_url, fb_page_title', 'length', 'max'=>255),
			array('is_publish', 'boolean'),
			array('count_today', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, app_type, app_id, title, description, scenario, contents,intro, anwser_result, permissions, fb_page_id, fb_page_url', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'answers' => array(self::HAS_MANY, 'Answers', 'question_id'),
			'app' => array(self::BELONGS_TO, 'Apps', 'app_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'image' => 'Facebook wall image',
			'app_type' => 'App Type',
			'app_id' => 'App',
			'title' => 'Title',
			'description' => 'Description',
			'scenario' => 'Scenario',
			'contents' => 'Contents',
			'anwser_result' => 'Anwser Result',
			'permissions' => 'Permissions',
			'fb_page_id' => 'Fb Page ID',
			'fb_page_url' => 'Fb Page Url',
			'fb_page_title' => 'Fb Page ',
			'count' => 'Counter',
			'intro' => 'Introduction',
			'is_publish' => 'Is Publish ?',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('app_type',$this->app_type);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('scenario',$this->scenario,true);
		$criteria->compare('contents',$this->contents,true);
		$criteria->compare('intro',$this->intro,true);
		$criteria->compare('anwser_result',$this->anwser_result,true);
		$criteria->compare('permissions',$this->permissions,true);
		$criteria->compare('fb_page_id',$this->fb_page_id,true);
		$criteria->compare('fb_page_url',$this->fb_page_url,true);
		$criteria->compare('fb_page_',$this->fb_page_title,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Questions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function shareLink()
	{
		require_once 'facebook-php-sdk/src/facebook.php';

		$facebook = new Facebook(array(
		  'appId'  =>  $this->app->fb_app_id,
		  'secret' => $this->app->fb_app_key,
		));

		// Get User ID
		$fid = $facebook->getUser();
		if ($fid) {

		try {
			$shortenUrl = Yii::app()->bitly->shorten( Yii::app()->controller->createAbsoluteUrl('/home/question?id='. $this->id) )->getResponseData();
			if (isset($shortenUrl['status_code']) && $shortenUrl['status_code'] == 200) {
				$url = $shortenUrl['data']['url'];
				$message = "[USER]さんが \r\n【[TITLE]】で遊びました。\r\n\r\n 続きはこちら \r\n [URL] \r\n\r\n";

				$user_profile = $facebook->api('/me?locale=ja_JP','GET');

		         if (!$this->app_type)
		         {
		         	$message .= "[USER]さんの結果はこちらです。\r\n\r\n-----------------------------------------\r\n" . $this->currentResult . "\r\n-----------------------------------------\r\n\r\nみんなも遊んでみてね☆\r\n [URL]" ; 
		         }

		        $message = str_replace('[USER]', $user_profile['name'], $message);
				$message = str_replace('[TITLE]', $this->title, $message);
				$message = str_replace('[URL]', $url, $message);
				if (empty($this->image)) {
					$img = '';
				}
				else
		        $img = Yii::app()->controller->createAbsoluteUrl("/") .  ImageHelper::thumb(600,450,'/uploads/' .$this->image);
		    	$img = str_replace('/index.php', '', $img);
		    	// process strip tags
		    	// Allow <br> and <br/>
				$message = strip_tags($message, '<br><br/>');
				$message = str_replace('<br>', "\r\n", $message);
				$message = str_replace('<br/>', "\r\n", $message);
				$response = $facebook->api(
				    "/me/feed",
				    "POST",
				    array (
				    	'link' => $url,
				        'message' => $message,
				        'picture' => $img,
				        'name' => $this->title,
				        'description' => ' ' ,
				        'caption' => $this->description,
				    )
				);
			}


		  } catch (FacebookApiException $e) {
		    return false;
		  }

		}
		return true;

	}

	public function checkPermission($share = 1)
	{
		$isOk = false;

		require_once 'facebook-php-sdk/src/facebook.php';

		$facebook = new Facebook(array(
		  'appId'  =>  $this->app->fb_app_id,
		  'secret' => $this->app->fb_app_key,
		));

		// Get User ID
		$fid = $facebook->getUser();
		if ($fid) {

		  // Check current FB has in DB
		 // $exists = FacebookUsers::model()->exists('facebook_id = :fid and app_id = :app_id and question_id = :question_id',array(':fid' => $fid, ':app_id' => $this->app->fb_app_id , ':question_id' => $this->id));

		 // if (! $exists) {
		 // 	return $isOk;
		 // }

		 // Check has full permision for this question
		  try {
		  	$permissionsFb = $facebook->api('/me/permissions/');
		  	$checkArr = explode(',', $this->permissions);
		  	foreach ($checkArr as $key => $item) {
		  		if (!array_key_exists($item, $permissionsFb['data'][0])) {
		  			return false;
		  		}
		  	}

		  	// Check User have been like page
		  	$likeFanpageFb = $facebook->api(
			    "/{$fid}/likes/{$this->fb_page_id}"
			);
		  	$isFound = false;
		  	if (isset($likeFanpageFb['data']) && count($likeFanpageFb['data']))
			  	$isFound = true;

			if (!$isFound) {
				$isOk = false;
			}
			else
		  		$isOk = true;


		  	if ($isOk) {
		  		// publish to FB
	  			 if (!$this->app_type)
		         {
		         	$user_profile = $facebook->api('/me?locale=ja_JP','GET');

		         	$this->currentResult = $this->randomResult();
		         	$this->currentResult = str_replace('[USER]', $user_profile['name'], $this->currentResult);
		         	Yii::app()->session['currentResult'] = $this->currentResult ;

		         }
		  	}


		  } catch (FacebookApiException $e) {
		  	// dump($e);
		    return $isOk;
		  }
		} 

		return $isOk;
	}


	public function getRecommended($id = null,$limit = 3)
	{

		$criteria = new CDbCriteria();
		if ($id) {
			$criteria->condition = 'id != :id';
			$criteria->params = array(':id'=>$id);
		}

		$criteria->order = 'count DESC, id DESC';

		// return $this->findAll($criteria);
		return new CActiveDataProvider('Questions',array(
			'criteria' => $criteria,
			'pagination'=>array(
				'pageSize'=>$limit,
	    	)
		)
		);
	}

	public function randomResult()
	{
		$bbCodeArr = explode(',', strtoupper($this->scenario) );
		$tmpContent = $this->contents;
		$tmpResult = $this->anwser_result;
		foreach ($bbCodeArr as $key => $code) {
				if ($code == 'USER') {
					continue;
				}
			    preg_match_all('~\[\@'.$code.'\@\](.*?)\[/\@'.$code.'\@\]~s', $tmpResult,$matches);
			    if (isset($matches[1][0])) {
			    	$matches=explode("\n",trim($matches[1][0]));
			    	$tmpContent = str_replace('[' . $code . ']', trim($matches[array_rand($matches)]), $tmpContent);
			    }
			    else
			    {
			    	$tmpContent = str_replace('[' . $code . ']', 'N/A', $tmpContent);
			    }
		}
		return $tmpContent;
	}
}
