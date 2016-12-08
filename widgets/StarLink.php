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
     * Executes the widget.
     */
    public function run()
    {
        $currentUserStarred = false;

        $stars = Star::GetStars($this->object->className(), $this->object->id);
        foreach ($stars as $star) {
            if ($star->user->id == Yii::$app->user->id) {
                $currentUserStarred= true;
            }
        }

        return $this->render('starLink', array(
            'object' => $this->object,
            'stars' => $stars,
            'currentUserStarred' => $currentUserStarred,
            'id' => $this->object->getUniqueId(),
            'starUrl' => Url::to(['/star/star/star', 'contentModel' => $this->object->className(), 'contentId' => $this->object->id]),
            'unstarUrl' => Url::to(['/star/star/unstar', 'contentModel' => $this->object->className(), 'contentId' => $this->object->id]),
            'userListUrl' => Url::to(['/like/like/user-list', 'contentModel' => $this->object->className(), 'contentId' => $this->object->getPrimaryKey()]),
            'title' => $this->generateLikeTitleText($currentUserStarred, $stars)
        ));
    }

    private function generateLikeTitleText($currentUserLiked, $likes)
    {
        $userlist = ""; // variable for users output
        $maxUser = 5; // limit for rendered users inside the tooltip
        // if the current user also likes
        if ($currentUserLiked == true) {
            // if only one user likes
            if (count($likes) == 1) {
                // output, if the current user is the only one
                $userlist = Yii::t('LikeModule.widgets_views_likeLink', 'You like this.');
            } else {
                // output, if more users like this
                $userlist .= Yii::t('LikeModule.widgets_views_likeLink', 'You'). "\n";
            }
        }

        for ($i = 0; $i < count($likes); $i++) {

            // if only one user likes
            if (count($likes) == 1) {
                // check, if you liked
                if ($likes[$i]->user->guid != Yii::$app->user->guid) {
                    // output, if an other user liked
                    $userlist .= Html::encode($likes[$i]->user->displayName) . Yii::t('LikeModule.widgets_views_likeLink', ' likes this.');
                }
            } else {

                // check, if you liked
                if ($likes[$i]->user->guid != Yii::$app->user->guid) {
                    // output, if an other user liked
                    $userlist .= Html::encode($likes[$i]->user->displayName). "\n";
                }

                // check if exists more user as limited
                if ($i == $maxUser) {
                    // output with the number of not rendered users
                    $userlist .= Yii::t('LikeModule.widgets_views_likeLink', 'and {count} more like this.', array('{count}' => (intval(count($likes) - $maxUser))));

                    // stop the loop
                    break;
                }
            }
        }

        return $userlist;
    }

}

?>