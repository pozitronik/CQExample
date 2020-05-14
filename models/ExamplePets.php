<?php
declare(strict_types = 1);

namespace app\modules\CQExample\models;

use app\modules\CQExample\CQExampleModule;
use pozitronik\helpers\ArrayHelper;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "example_pets".
 *
 * @property int $id
 * @property string $name
 * @property int $type
 *
 * @property ActiveQuery|ExampleRefPetsTypes $refType
 */
class ExamplePets extends ActiveRecord {

	/**
	 * {@inheritdoc}
	 */
	public static function tableName():string {
		return 'example_pets';
	}
	/**
	 * {@inheritDoc}
	 */
	public static function find() {
		return (ArrayHelper::getValue(ModuleStuff::params(CQExampleModule::class), 'enableQueryCache', true))?new CachedQuery(static::class):parent::find();
	}


	/**
	 * {@inheritdoc}
	 */
	public function rules():array {
		return [
			[['name', 'type'], 'required'],
			[['type'], 'integer'],
			[['name'], 'string', 'max' => 255],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels():array {
		return [
			'id' => 'ID',
			'name' => 'Name',
			'type' => 'Type',
			'refType' => 'Type'
		];
	}

	/**
	 * @return ExampleRefPetsTypes|ActiveQuery
	 */
	public function getRefType() {
		return $this->hasOne(ExampleRefPetsTypes::class, ['id' => 'type']);
	}

}
