<?php
declare(strict_types = 1);

namespace app\modules\CQExample\models;

use app\modules\CQExample\CQExampleModule;
use pozitronik\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "example_rel_people_pets".
 *
 * @property int $id
 * @property int $human_id
 * @property int $pet_id
 */
class ExampleRelPeoplePets extends ActiveRecord {

	/**
	 * {@inheritdoc}
	 */
	public static function tableName():string {
		return 'example_rel_people_pets';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules():array {
		return [
			[['human_id', 'pet_id'], 'required'],
			[['human_id', 'pet_id'], 'integer'],
			[['human_id', 'pet_id'], 'unique', 'targetAttribute' => ['human_id', 'pet_id']],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels():array {
		return [
			'id' => 'ID',
			'human_id' => 'Human ID',
			'pet_id' => 'Pet ID',
		];
	}

	/**
	 * {@inheritDoc}
	 */
	public static function find() {
		return (ArrayHelper::getValue(ModuleStuff::params(CQExampleModule::class), 'enableQueryCache', true))?new CachedQuery(static::class):parent::find();
	}

}
