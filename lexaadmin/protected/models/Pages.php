<?php

/**
 * This is the model class for table "pages".
 *
 * The followings are the available columns in table 'pages':
 * @property integer $id
 * @property string $name
 * @property string $menu
 * @property string $lastedit
 * @property string $keyw
 * @property string $des
 * @property string $dir
 * @property string $content
 * @property integer $parent
 * @property string $type
 * @property integer $num
 * @property string $title1
 * @property string $funcname
 * @property integer $site
 */
class Pages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent, num, site', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			array('menu, dir, funcname', 'length', 'max'=>255),
			array('type', 'length', 'max'=>1),
			array('lastedit, keyw, des, content, title1', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, menu, lastedit, keyw, des, dir, content, parent, type, num, title1, funcname, site', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'menu' => 'Menu',
			'lastedit' => 'Lastedit',
			'keyw' => 'Keyw',
			'des' => 'Des',
			'dir' => 'Dir',
			'content' => 'Content',
			'parent' => 'Parent',
			'type' => 'Type',
			'num' => 'Num',
			'title1' => 'Title1',
			'funcname' => 'Funcname',
			'site' => 'Site',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('menu',$this->menu,true);
		$criteria->compare('lastedit',$this->lastedit,true);
		$criteria->compare('keyw',$this->keyw,true);
		$criteria->compare('des',$this->des,true);
		$criteria->compare('dir',$this->dir,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('parent',$this->parent);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('num',$this->num);
		$criteria->compare('title1',$this->title1,true);
		$criteria->compare('funcname',$this->funcname,true);
		$criteria->compare('site',$this->site);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
