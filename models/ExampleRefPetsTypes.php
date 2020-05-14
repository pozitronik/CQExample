<?php
declare(strict_types = 1);

namespace app\modules\CQExample\models;

use app\modules\CQExample\CQExampleModule;
use pozitronik\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "example_ref_pets_types".
 *
 * @property int $id
 * @property string $name
 */
class ExampleRefPetsTypes extends ActiveRecord {

	/**
	 * {@inheritdoc}
	 */
	public static function tableName():string {
		return 'example_ref_pets_types';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules():array {
		return [
			[['name'], 'required'],
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
		];
	}

	/**
	 * {@inheritDoc}
	 */
	public static function find() {
		return (ArrayHelper::getValue(ModuleStuff::params(CQExampleModule::class), 'enableQueryCache', true))?new CachedQuery(static::class):parent::find();
	}
}
