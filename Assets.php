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

namespace humhub\modules\star;

use yii\web\AssetBundle;

class Assets extends AssetBundle
{

    public $forceCopy = true;

    public $js = [
        'js/star.js',
    ];

    public function init()
    {
        $assetPrefix = \Yii::$app->assetManager->publish(dirname(__FILE__) . '/assets', array('forceCopy' => true));
        $this->sourcePath = dirname(__FILE__) . '/assets';
        parent::init();
    }
}