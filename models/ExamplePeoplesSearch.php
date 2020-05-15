<?php
declare(strict_types = 1);

namespace app\modules\CQExample\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

/**
 * ExamplePeoplesSearch represents the model behind the search form of `app\modules\CQExample\models\ExamplePeoples`.
 */
class ExamplePeoplesSearch extends ExamplePeoples {
	public $petType;

	/**
	 * {@inheritdoc}
	 */
	public function rules():array {
		return [
			[['id', 'age'], 'integer'],
			[['name', 'petType'], 'safe'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function scenarios():array {
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params):ActiveDataProvider {
		$query = ExamplePeoples::find();
//		$query->joinWith('pets as pets');
		$query->joinWith([
			'pets as pets' => static function (ActiveQuery $query) {
				$query->with(['refType']);
			}
		]);
		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		// grid filtering conditions
		$query->andFilterWhere([
			'example_peoples.id' => $this->id,
			'example_peoples.age' => $this->age,
		]);

		$query->andFilterWhere(['in', 'pets.type', $this->petType]);

		$query->andFilterWhere(['like', 'example_peoples.name', $this->name]);

		return $dataProvider;
	}
}
