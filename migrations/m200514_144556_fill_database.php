<?php
declare(strict_types = 1);
use app\modules\CQExample\models\ExamplePeoples;
use app\modules\CQExample\models\ExamplePets;
use app\modules\CQExample\models\ExampleRelPeoplePets;
use app\modules\CQExample\models\Utils;
use yii\db\Migration;

/**
 * Class m200514_144556_fill_database
 */
class m200514_144556_fill_database extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {
		$this->createTable('example_peoples', [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'age' => $this->integer()->notNull()
		]);

		for ($i = 0; $i < 100; $i++) {
			(new ExamplePeoples([
				'name' => Utils::random_str(random_int(5, 15), 'KOBZUN BARMYDIX VIWAT'),
				'age' => random_int(0, 100)
			]))->save();
		}

		$this->createTable('example_pets', [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'type' => $this->integer()->notNull()
		]);

		for ($i = 0; $i < 200; $i++) {
			(new ExamplePets([
				'name' => Utils::random_str(random_int(5, 10), 'PISA-LOVU TEODYN JET'),
				'type' => random_int(1, 4)
			]))->save();
		}

		$this->createTable('example_ref_pets_types', [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull()
		]);

		$this->insert('example_ref_pets_types', ['name' => 'Кот']);
		$this->insert('example_ref_pets_types', ['name' => 'Пёс']);
		$this->insert('example_ref_pets_types', ['name' => 'Ёж']);
		$this->insert('example_ref_pets_types', ['name' => 'Червь']);

		$this->createTable('example_rel_people_pets', [
			'id' => $this->primaryKey(),
			'human_id' => $this->integer()->notNull(),
			'pet_id' => $this->integer()->notNull()
		]);

		$this->createIndex('human_id_pet_id', 'example_rel_people_pets', ['human_id', 'pet_id'], true);

		for ($i = 0; $i < 100; $i++) {
			(new ExampleRelPeoplePets([
				'human_id' => $i,
				'pet_id' => random_int(1, 100)
			]))->save();
		}
		for ($i = 0; $i < 100; $i++) {
			(new ExampleRelPeoplePets([
				'human_id' => $i,
				'pet_id' => random_int(101, 200)
			]))->save();
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropTable('example_peoples');
		$this->dropTable('example_pets');
		$this->dropTable('example_ref_pets_types');
		$this->dropTable('example_rel_people_pets');
	}

}
