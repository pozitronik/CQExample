<?php
declare(strict_types = 1);

namespace app\modules\CQExample\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\Query;

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
			$row = Query::one($db);
			if (false !== $row) {
				$models = $this->populate([$row]);
				return reset($models)?:null;
			}
			return null;
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function all($db = null) {
		$cacheName = $this->createCommand()->rawSql;
		return Yii::$app->cache->getOrSet("{$cacheName}::all", function() use ($db) {
			return Query::all($db);
		});
	}
}