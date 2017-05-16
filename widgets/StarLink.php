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

namespace humhub\modules\star\widgets;

use humhub\modules\star\models\Star;
use Yii;
use humhub\modules\like\models\Like;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * This widget is used to show a star link.
 */
class StarLink extends \yii\base\Widget
{

    /**
     * The Object to be starred
     *
     * @var type
     */
    public $object;

    /**
     * Class to be applied to the "star" button
     *
     * @var string
     */
    public $btnClass = 'btn-default';

    /**
     * Text to show when clicking will star.
     *
     * @var string
     */
    public $btnStarText = "<i class=\"fa fa-heart\"></i>";

    /**
     * Text to show when clicking will unstar
     *
     * @var string
     */
    public $btnUnstarText = "<i style=\"color: red;\" class=\"fa fa-heart\"></i>";


    /**
     * Executes the widget.
     */
    public function run()
    {
        $currentUserStarred = false;

        $stars = Star::GetStars($this->object->className(), $this->object->getPrimaryKey());
        foreach ($stars as $star) {
            if ($star->created_by == Yii::$app->user->id) {
                $currentUserStarred = true;
            }
        }

        return $this->render('starLink', array(
            'object' => $this->object,
            'stars' => $stars,
            'currentUserStarred' => $currentUserStarred,
            'id' => $this->object->getPrimaryKey(),
            'btnClass' => $this->btnClass,
            'btnStarText' => $this->btnStarText,
            'btnUnstarText' => $this->btnUnstarText,
            'starUrl' => Url::to(['/star/star/star', 'contentModel' => $this->object->className(), 'contentId' => $this->object->getPrimaryKey()]),
            'unstarUrl' => Url::to(['/star/star/unstar', 'contentModel' => $this->object->className(), 'contentId' => $this->object->getPrimaryKey()]),
            'userListUrl' => Url::to(['/like/like/user-list', 'contentModel' => $this->object->className(), 'contentId' => $this->object->getPrimaryKey()]),
        ));
    }

}

?>