<?php

/**
 * This is the model class for table "InternalMailTemplate".
 *
 * The followings are the available columns in table 'InternalMailTemplate':
 * @property string $id
 * @property string $name
 * @property string $template
 * @property integer $status
 */
class InternalMailTemplate extends CActiveRecord {

    public static $statuses = array(
        0 => 'Inactive',
        1 => 'Active'
    );

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'InternalMailTemplate';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, template, status', 'required'),
            array('status', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 45),
            array('template', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, template, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'template' => 'Template',
            'status' => 'Status',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('template', $this->template, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return InternalMailTemplate the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getStatusText() {
        return isset($this->status) ? self::$statuses[$this->status] : null;
    }

    public function findByName($name) {
        if (!empty($name)) {
            return self::model()->findByAttributes(array('name' => $name));
        }
        return false;
    }

}
