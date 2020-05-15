<?php
declare(strict_types = 1);

namespace app\modules\CQExample\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * Class CachedQuery
 */
class CachedQuery extends ActiveQuery {

	/**
	 * {@inheritDoc}
	 */
	public function one($db = null) {
		$cacheName = $this->createCommand()->rawSql;
		return Yii::$app->cache->getOrSet("{$cacheName}::one", function() use ($db) {
			return parent::one($db);
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function all($db = null) {
		$cacheName = $this->createCommand()->rawSql;
		return Yii::$app->cache->getOrSet("{$cacheName}::all", function() use ($db) {
			return parent::all($db);
		});
	}
}