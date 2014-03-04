<?php

/**
 * This is the model class for table "facebook_users".
 *
 * The followings are the available columns in table 'facebook_users':
 * @property string $id
 * @property string $facebook_id
 * @property string $name
 * @property string $email
 * @property string $gender
 * @property string $relationship
 * @property string $age
 * @property string $birthday
 * @property string $hometown
 * @property string $location
 * @property string $created
 * @property string $finished
 * @property string $app_id
 * @property string $question_id
 *
 * The followings are the available model relations:
 * @property Questions $question
 */
class FacebookUsers extends CActiveRecord
{

	public $dateFrom = ''; 

 	public $dateTo = '';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'facebook_users';
	}

	public function behaviors()
	{
	   return array(
	      'dateRangeSearch'=>array(
	         'class'=>'application.components.behaviors.EDateRangeSearchBehavior',
	         'dateInput' => '%Y-%m-%d'
	      ),
	   );
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question_id', 'required'),
			array('facebook_id, name, hometown, location, app_id', 'length', 'max'=>255),
			array('email, relationship', 'length', 'max'=>45),
			array('gender', 'length', 'max'=>10),
			array('age', 'length', 'max'=>5),
			array('question_id', 'length', 'max'=>11),
			array('birthday, created, finished', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, facebook_id, name, email, gender, relationship, age, birthday, hometown, location, dateFrom, dateTo, created, finished, app_id, question_id', 'safe', 'on'=>'search'),
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
			'question' => array(self::BELONGS_TO, 'Questions', 'question_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'facebook_id' => 'Facebook',
			'name' => 'Name',
			'email' => 'Email',
			'gender' => 'Gender',
			'relationship' => 'Relationship',
			'age' => 'Age',
			'birthday' => 'Birthday',
			'hometown' => 'Hometown',
			'location' => 'Location',
			'created' => 'Created',
			'finished' => 'Finished',
			'app_id' => 'App',
			'question_id' => 'Question',
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
		$criteria->compare('facebook_id',$this->facebook_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('relationship',$this->relationship,true);
		$criteria->compare('age',$this->age,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('hometown',$this->hometown,true);
		$criteria->compare('location',$this->location,true);

		$criteria->compare('finished',$this->finished,true);

		if ( !empty($this->dateFrom) || !empty($this->dateTo)) {
			$criteria->mergeWith($this->dateRangeSearchCriteria('created', array( $this->dateFrom, $this->dateTo) ));  
		} else {
			$criteria->compare('created',$this->created,true);
		}

		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('question_id',$this->question_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FacebookUsers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
