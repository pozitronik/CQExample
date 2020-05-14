<?php
declare(strict_types = 1);

namespace app\modules\CQExample\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Trait CachedRelations
 */
trait CachedRelations {

	/**
	 * {@inheritDoc}
	 */
	public function hasOne($class, $link) {
		$primaryKey = key($link);
		$foreignKey = $link[$primaryKey];
		$cacheName = "{$class}{$primaryKey}{$foreignKey}";
		/** @var ActiveRecord $this */
		return Yii::$app->cache->getOrSet("{$cacheName}({$this->primaryKey})::hasOne", function() use ($class, $link) {
			return $this->createRelationQuery($class, $link, false);
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function hasMany($class, $link) {
		$primaryKey = key($link);
		$foreignKey = $link[$primaryKey];
		$cacheName = "{$class}{$primaryKey}{$foreignKey}";
		/** @var ActiveRecord $this */
		return Yii::$app->cache->getOrSet("{$cacheName}({$this->primaryKey})::hasMany", function() use ($class, $link) {
			return $this->createRelationQuery($class, $link, true);
		});
	}
}

