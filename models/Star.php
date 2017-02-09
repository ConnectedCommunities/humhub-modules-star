<?php
/**
 * Connected Communities Initiative
 * Copyright (C) 2016 Queensland University of Technology
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace humhub\modules\star\models;

use Yii;
use humhub\components\ActiveRecord;
use humhub\models\Setting;
use humhub\modules\content\components\ContentAddonActiveRecord;

/**
 * This is the model class for table "like".
 *
 * The followings are the available columns in table 'star':
 * @property integer $id
 * @property string $object_model
 * @property integer $object_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @package humhub.modules.star.models
 */
class Star extends ActiveRecord //ContentAddonActiveRecord
{

    /**
     * Class of widget to use to show starred item
     *
     * @var string StarredItem widget class
     */
    public $starredItemClass = "";


    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return 'star';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array(['object_model', 'object_id'], 'required'),
            array(['id', 'created_by', 'updated_by'], 'integer'),
            array(['updated_at', 'created_at'], 'safe')
        );
    }

    /**
     * Star Count for specifc model
     */
    public static function GetStars($objectModel, $objectId)
    {
        $cacheId = "stars_" . $objectModel . "_" . $objectId;
        $cacheValue = Yii::$app->cache->get($cacheId);

        if ($cacheValue === false) {
            $newCacheValue = Star::findAll(array('object_model' => $objectModel, 'object_id' => $objectId));
            return $newCacheValue;
        } else {
            return $cacheValue;
        }
    }

    /**
     * After Save, delete StarCount (Cache) for target object
     */
    public function afterSave($insert, $changedAttributes)
    {
        Yii::$app->cache->delete('stars_' . $this->object_model . "_" . $this->object_id);
        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * Before Delete, remove StarCount (Cache) of target object.
     * Remove activity
     */
    public function beforeDelete()
    {
        Yii::$app->cache->delete('stars_' . $this->object_model . "_" . $this->object_id);
        return parent::beforeDelete();
    }

    /**
     * Returns the assigned wall entry widget instance
     *
     * @return \humhub\modules\content\widgets\WallEntry
     */
    public function getStarredItemWidget($params = [])
    {
        if ($this->starredItemClass !== '') {
            $class = $this->starredItemClass;
            $widget = new $class;
            return $widget::widget($params);
        }

        return null;
    }

}
