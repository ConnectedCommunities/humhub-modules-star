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

/**
 * @package humhub.modules.property.widgets
 * @author Ben
 */
class StarList extends \yii\base\Widget
{

    public function run()
    {


        $query = Star::find();
        $query->where(['created_by' => \Yii::$app->user->id]);
        $query->orderBy('created_at DESC');
        $query->limit(5);

        return $this->render('starList', array('userMessages' => $query->all()));

    }


}


