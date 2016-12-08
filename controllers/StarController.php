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

use humhub\components\Controller;
use humhub\modules\content\components\ContentContainerController;
use Yii;
use humhub\modules\star\models\Star;
use yii\web\HttpException;

class StarController extends ContentContainerController
{

    /**
     * Class name of content model class
     *
     * @var string
     */
    public $contentModel;

    /**
     * Primary key of content model record
     *
     * @var int
     */
    public $contentId;


    /**
     * Handle initialisation.
     *
     * This module works globally and within a Space container
     * We do this so we can work around not having a content container.
     */
    public function init() {

        // Expect exception from Content Container on global index page
        try {
            parent::init();
        } catch(HttpException $e) {
            // Do nothing.
        }

    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        $modelClass = Yii::$app->request->get('contentModel');
        $pk = (int) Yii::$app->request->get('contentId');

        if ($modelClass == "" || $pk == "") {
            throw new HttpException(500, 'Model & ID parameter required!');
        }

        $target = $modelClass::findOne(['id' => $pk]);

        $this->contentModel = get_class($target);
        $this->contentId = $target->getPrimaryKey();

        return parent::beforeAction($action);
    }


    /**
     * Creates a new like
     */
    public function actionStar()
    {
        $this->forcePostRequest();

        $like = Star::findOne(['object_model' => $this->contentModel, 'object_id' => $this->contentId, 'created_by' => Yii::$app->user->id]);
        if ($like === null) {

            // Create Like Object
            $like = new Star();
            $like->object_model = $this->contentModel;
            $like->object_id = $this->contentId;
            $like->save();
        }

        return $this->actionShowLikes();
    }

    /**
     * Unlikes an item
     */
    public function actionUnstar()
    {
        $this->forcePostRequest();

        if (!Yii::$app->user->isGuest) {
            $like = Star::findOne(['object_model' => $this->contentModel, 'object_id' => $this->contentId, 'created_by' => Yii::$app->user->id]);
            if ($like !== null) {
                $like->delete();
            }
        }

        return $this->actionShowLikes();
    }

    /**
     * Returns an JSON with current like informations about a target
     */
    public function actionShowLikes()
    {
        Yii::$app->response->format = 'json';

        // Some Meta Infos
        $currentUserLiked = false;

        $likes = Star::GetStars($this->contentModel, $this->contentId);

        foreach ($likes as $like) {
            if ($like->user->id == Yii::$app->user->id) {
                $currentUserLiked = true;
            }
        }

        return [
            'currentUserLiked' => $currentUserLiked,
            'starCounter' => count($likes)
        ];
    }
    

}

