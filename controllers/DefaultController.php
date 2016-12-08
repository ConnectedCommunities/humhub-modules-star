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

namespace humhub\modules\star\controllers;

use humhub\modules\comment\models\Comment;
use humhub\modules\star\models\Star;

class DefaultController extends \yii\web\Controller
{

    /**
     * Renders the index view for the module
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', array('comment' => Comment::findOne(['id' => 1])));
    }


    /**
     * Overview of all stars
     * Used by MailNotificationWidget to display all recent messages
     */
    public function actionNotificationList()
    {
        $query = Star::find();
        $query->where(['created_by' => \Yii::$app->user->id]);
        $query->orderBy('created_at DESC');
        $query->limit(5);

        return $this->renderAjax('list', array('userMessages' => $query->all()));
    }


}

