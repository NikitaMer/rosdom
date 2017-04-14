<?php

/**
 * This is the model class for table "projects".
 *
 * The followings are the available columns in table 'projects':
 * @property string $id
 * @property string $name
 * @property string $konkurents
 * @property string $des
 * @property string $book
 * @property string $mas_des
 * @property string $cd_des
 * @property double $o_pl
 * @property double $g_pl
 * @property string $mater
 * @property string $prev
 * @property double $pl_z
 * @property string $add_info
 * @property string $important
 * @property string $o2c
 * @property string $is_new
 * @property string $fs
 * @property integer $v
 * @property integer $h
 * @property string $sflag
 * @property string $cd
 * @property string $dt
 * @property double $pr0
 * @property double $pr1
 * @property double $pr2
 * @property double $pr3
 * @property double $pr4
 * @property double $pr0_cd
 * @property double $pr1_cd
 * @property double $pr2_cd
 * @property double $pr3_cd
 * @property double $pr4_cd
 * @property double $pr0_arch
 * @property double $pr1_arch
 * @property double $pr2_arch
 * @property double $pr3_arch
 * @property double $pr4_arch
 * @property integer $arch
 * @property integer $forum
 * @property string $archname
 * @property string $dillername
 * @property string $request
 * @property string $mas_request
 * @property string $cd_request
 * @property string $cz_request
 * @property string $pk_request
 * @property string $cz_des
 * @property string $pk_des
 * @property string $flores
 * @property string $site
 * @property string $konkurents2
 * @property integer $masterov_links
 * @property string $lastedit
 * @property string $lastcomment
 * @property string $mas_lastcomment
 * @property string $cd_lastcomment
 * @property string $archlink
 * @property string $comments_count
 * @property string $sver
 * @property string $sverdate
 * @property string $score
 * @property integer $creator
 * @property string $rosdom_title
 * @property string $rosdom_h1
 * @property string $rosdom_description
  * @property string $rosdom_des
 */
class Projects extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'projects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dillername', 'required'),
			array('v, h, arch, forum, masterov_links, creator', 'numerical', 'integerOnly'=>true),
			array('o_pl, g_pl, pl_z, pr0, pr1, pr2, pr3, pr4, pr0_cd, pr1_cd, pr2_cd, pr3_cd, pr4_cd, pr0_arch, pr1_arch, pr2_arch, pr3_arch, pr4_arch', 'numerical'),
			array('id', 'length', 'max'=>9),
			array('name, konkurents, prev, archname, request, mas_request, cd_request, cz_request, pk_request, konkurents2, rosdom_title, rosdom_h1', 'length', 'max'=>255),
			array('o2c, is_new, sflag, cd, sver', 'length', 'max'=>1),
			array('fs', 'length', 'max'=>15),
			array('dt', 'length', 'max'=>20),
			array('dillername', 'length', 'max'=>6),
			array('flores', 'length', 'max'=>3),
			array('site', 'length', 'max'=>8),
			array('archlink', 'length', 'max'=>500),
			array('comments_count', 'length', 'max'=>5),
			array('score', 'length', 'max'=>18),
			array('des, book, mas_des, cd_des, mater, add_info, important, cz_des, pk_des, lastedit, lastcomment, mas_lastcomment, cd_lastcomment, sverdate, rosdom_description, rosdom_des', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, konkurents, des, book, mas_des, cd_des, o_pl, g_pl, mater, prev, pl_z, add_info, important, o2c, is_new, fs, v, h, sflag, cd, dt, pr0, pr1, pr2, pr3, pr4, pr0_cd, pr1_cd, pr2_cd, pr3_cd, pr4_cd, pr0_arch, pr1_arch, pr2_arch, pr3_arch, pr4_arch, arch, forum, archname, dillername, request, mas_request, cd_request, cz_request, pk_request, cz_des, pk_des, flores, site, konkurents2, masterov_links, lastedit, lastcomment, mas_lastcomment, cd_lastcomment, archlink, comments_count, sver, sverdate, score, creator, rosdom_title, rosdom_h1, rosdom_description, rosdom_des', 'safe', 'on'=>'search'),
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
			'konkurents' => 'Konkurents',
			'des' => 'Des',
			'book' => 'Book',
			'mas_des' => 'Mas Des',
			'cd_des' => 'Cd Des',
			'o_pl' => 'O Pl',
			'g_pl' => 'G Pl',
			'mater' => 'Mater',
			'prev' => 'Prev',
			'pl_z' => 'Pl Z',
			'add_info' => 'Add Info',
			'important' => 'Important',
			'o2c' => 'O2c',
			'is_new' => 'Is New',
			'fs' => 'Fs',
			'v' => 'V',
			'h' => 'H',
			'sflag' => 'Sflag',
			'cd' => 'Cd',
			'dt' => 'Dt',
			'pr0' => 'Pr0',
			'pr1' => 'Pr1',
			'pr2' => 'Pr2',
			'pr3' => 'Pr3',
			'pr4' => 'Pr4',
			'pr0_cd' => 'Pr0 Cd',
			'pr1_cd' => 'Pr1 Cd',
			'pr2_cd' => 'Pr2 Cd',
			'pr3_cd' => 'Pr3 Cd',
			'pr4_cd' => 'Pr4 Cd',
			'pr0_arch' => 'Pr0 Arch',
			'pr1_arch' => 'Pr1 Arch',
			'pr2_arch' => 'Pr2 Arch',
			'pr3_arch' => 'Pr3 Arch',
			'pr4_arch' => 'Pr4 Arch',
			'arch' => 'Arch',
			'forum' => 'Forum',
			'archname' => 'Archname',
			'dillername' => 'Dillername',
			'request' => 'Request',
			'mas_request' => 'Mas Request',
			'cd_request' => 'Cd Request',
			'cz_request' => 'Cz Request',
			'pk_request' => 'Pk Request',
			'cz_des' => 'Cz Des',
			'pk_des' => 'Pk Des',
			'flores' => 'Flores',
			'site' => 'Site',
			'konkurents2' => 'Konkurents2',
			'masterov_links' => 'Masterov Links',
			'lastedit' => 'Lastedit',
			'lastcomment' => 'Lastcomment',
			'mas_lastcomment' => 'Mas Lastcomment',
			'cd_lastcomment' => 'Cd Lastcomment',
			'archlink' => 'Archlink',
			'comments_count' => 'Comments Count',
			'sver' => 'Sver',
			'sverdate' => 'Sverdate',
			'score' => 'Score',
			'creator' => 'Creator',
			'rosdom_title' => 'Rosdom Title',
			'rosdom_h1' => 'Rosdom H1',
			'rosdom_description' => 'Rosdom Description',
			'rosdom_des' => 'Rosdom Des',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('konkurents',$this->konkurents,true);
		$criteria->compare('des',$this->des,true);
		$criteria->compare('book',$this->book,true);
		$criteria->compare('mas_des',$this->mas_des,true);
		$criteria->compare('cd_des',$this->cd_des,true);
		$criteria->compare('o_pl',$this->o_pl);
		$criteria->compare('g_pl',$this->g_pl);
		$criteria->compare('mater',$this->mater,true);
		$criteria->compare('prev',$this->prev,true);
		$criteria->compare('pl_z',$this->pl_z);
		$criteria->compare('add_info',$this->add_info,true);
		$criteria->compare('important',$this->important,true);
		$criteria->compare('o2c',$this->o2c,true);
		$criteria->compare('is_new',$this->is_new,true);
		$criteria->compare('fs',$this->fs,true);
		$criteria->compare('v',$this->v);
		$criteria->compare('h',$this->h);
		$criteria->compare('sflag',$this->sflag,true);
		$criteria->compare('cd',$this->cd,true);
		$criteria->compare('dt',$this->dt,true);
		$criteria->compare('pr0',$this->pr0);
		$criteria->compare('pr1',$this->pr1);
		$criteria->compare('pr2',$this->pr2);
		$criteria->compare('pr3',$this->pr3);
		$criteria->compare('pr4',$this->pr4);
		$criteria->compare('pr0_cd',$this->pr0_cd);
		$criteria->compare('pr1_cd',$this->pr1_cd);
		$criteria->compare('pr2_cd',$this->pr2_cd);
		$criteria->compare('pr3_cd',$this->pr3_cd);
		$criteria->compare('pr4_cd',$this->pr4_cd);
		$criteria->compare('pr0_arch',$this->pr0_arch);
		$criteria->compare('pr1_arch',$this->pr1_arch);
		$criteria->compare('pr2_arch',$this->pr2_arch);
		$criteria->compare('pr3_arch',$this->pr3_arch);
		$criteria->compare('pr4_arch',$this->pr4_arch);
		$criteria->compare('arch',$this->arch);
		$criteria->compare('forum',$this->forum);
		$criteria->compare('archname',$this->archname,true);
		$criteria->compare('dillername',$this->dillername,true);
		$criteria->compare('request',$this->request,true);
		$criteria->compare('mas_request',$this->mas_request,true);
		$criteria->compare('cd_request',$this->cd_request,true);
		$criteria->compare('cz_request',$this->cz_request,true);
		$criteria->compare('pk_request',$this->pk_request,true);
		$criteria->compare('cz_des',$this->cz_des,true);
		$criteria->compare('pk_des',$this->pk_des,true);
		$criteria->compare('flores',$this->flores,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('konkurents2',$this->konkurents2,true);
		$criteria->compare('masterov_links',$this->masterov_links);
		$criteria->compare('lastedit',$this->lastedit,true);
		$criteria->compare('lastcomment',$this->lastcomment,true);
		$criteria->compare('mas_lastcomment',$this->mas_lastcomment,true);
		$criteria->compare('cd_lastcomment',$this->cd_lastcomment,true);
		$criteria->compare('archlink',$this->archlink,true);
		$criteria->compare('comments_count',$this->comments_count,true);
		$criteria->compare('sver',$this->sver,true);
		$criteria->compare('sverdate',$this->sverdate,true);
		$criteria->compare('score',$this->score,true);
		$criteria->compare('creator',$this->creator);
		$criteria->compare('rosdom_title',$this->rosdom_title,true);
		$criteria->compare('rosdom_h1',$this->rosdom_h1,true);
		$criteria->compare('rosdom_description',$this->rosdom_description,true);
		$criteria->compare('rosdom_des',$this->rosdom_des,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Projects the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	protected function beforeFind() {
		$criteria = new CDbCriteria;
		$criteria->condition = "site like('_____1__') and ((sflag is null) or sflag<'1') and not(arch=139) and not(arch=137) and not(arch=141)";
		$this->dbCriteria->mergeWith($criteria);
		parent::beforeFind();
	}

}
