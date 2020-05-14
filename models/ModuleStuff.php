<?php
declare(strict_types = 1);

namespace app\modules\CQExample\models;

use app\modules\dadata\Module;
use Throwable;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Class ModuleStuff
 * @package app\modules\CQExample\models
 */
class ModuleStuff {

	/**
	 * @param string $name - id плагина из web.php
	 * @param null|array $moduleConfigurationArray - конфиг плагина из web.php вида
	 * [
	 *        'class' => Module::class,
	 *        ...
	 * ]
	 * null - подтянуть конфиг автоматически
	 *
	 * @return null|Module|Component - загруженный экземпляр модуля
	 * @throws InvalidConfigException
	 * @throws Throwable
	 */
	private static function LoadModule(string $name, ?array $moduleConfigurationArray = null):?Component {
		$moduleConfigurationArray = $moduleConfigurationArray??ArrayHelper::getValue(Yii::$app->modules, $name, []);
		$module = Yii::createObject($moduleConfigurationArray, [$name]);
		if ($module instanceof Module) return $module;
		return null;
	}

	/**
	 * Возвращает список подключённых плагинов. Список можно задать в конфигурации, либо же вернутся все подходящие модули, подключённые в Web.php
	 * @return Module[] Массив подключённых плагинов
	 * @throws InvalidConfigException
	 * @throws Throwable
	 */
	public static function ListModules():array {
		$modules = [];
		foreach (Yii::$app->modules as $name => $module) {
			if (is_object($module)) {
				if ($module instanceof Module) $modules[$name] = $module;
			} else if (null !== $loadedModule = self::LoadModule($name, $module)) {
				$modules[$name] = $loadedModule;
			}
		}
		return $modules;
	}

	/**
	 * Возвращает плагин по его id
	 * @param string $moduleId
	 * @return Module|null
	 * @throws InvalidConfigException
	 * @throws Throwable
	 */
	public static function GetModuleById(string $moduleId):?Component {
		return ArrayHelper::getValue(self::ListModules(), $moduleId);
	}

	/**
	 * Возвращает плагин по его имени класса
	 * @param string $className
	 * @return Module|null
	 * @throws InvalidConfigException
	 * @throws Throwable
	 */
	public static function GetModuleByClassName(string $className):?Component {
		$config = array_filter(Yii::$app->modules, static function($element) use ($className) {
			if (is_array($element)) {
				return $className === ArrayHelper::getValue($element, 'class');
			}
			if (is_object($element)) {//module already loaded
				return $className === get_class($element);
			}
			return false;
		});
		if (null === $moduleName = ArrayHelper::getValue(array_keys($config), 0)) return null;
		if (is_object($config[$moduleName])) return $config[$moduleName];
		return self::LoadModule($moduleName, $config[$moduleName]);
	}

	/**
	 * Возвращает массив путей к контроллерам плагинов, например для построения навигации
	 * @return string[]
	 * @throws InvalidConfigException
	 * @throws Throwable
	 */
	public static function GetAllControllersPaths():array {
		$result = [];
		foreach (self::ListModules() as $module) {
			$result[$module->id] = $module->controllerPath;
		}
		return $result;
	}

	/**
	 * Вернёт набор параметров модуля по имени класса
	 * @param string $className
	 * @return array
	 * @throws InvalidConfigException
	 * @throws Throwable
	 */
	public static function params(string $className):array {
		if ((null !== $module = self::GetModuleByClassName($className))) {
			return $module->params;
		}
		return [];
	}

}