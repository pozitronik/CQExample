<?php
declare(strict_types = 1);

namespace app\modules\CQExample\models;

use app\modules\CQExample\CQExampleModule;
use pozitronik\helpers\ArrayHelper;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "example_peoples".
 *
 * @property int $id
 * @property string $name
 * @property int $age
 *
 * @property ActiveQuery|ExampleRelPeoplePets[] $relPeoplePets
 * @property ActiveQuery|ExamplePets[] $pets
 */
class ExamplePeoples extends ActiveRecord {

	/**
	 * {@inheritdoc}
	 */
	public static function tableName():string {
		return 'example_peoples';
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
			[['name', 'age'], 'required'],
			[['age'], 'integer'],
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
			'age' => 'Age',
			'pets' => 'Pets'
		];
	}

	/**
	 * @return ExampleRelPeoplePets[]|ActiveQuery
	 */
	public function getRelPeoplePets() {
		return $this->hasMany(ExampleRelPeoplePets::class, ['human_id' => 'id']);
	}

	/**
	 * @return ExamplePets[]|ActiveQuery
	 */
	public function getPets() {
		return $this->hasMany(ExamplePets::class, ['id' => 'pet_id'])->via('relPeoplePets');
	}

}
