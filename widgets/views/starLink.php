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

use yii\helpers\Html;

humhub\modules\star\StarAsset::register($this);
?>

<span class="starLinkContainer" id="starLinkContainer_<?= $id ?>">


    <?php if (Yii::$app->user->isGuest): ?>
        <?php echo Html::a('<i class="fa fa-heart"></i>', Yii::$app->user->loginUrl, ['data-target' => '#globalModal']); ?>
    <?php else: ?>
        <a href="#" data-action-click="star.toggleLike" data-action-url="<?= $starUrl ?>" class="btn <?= $btnClass ?> like likeAnchor" style="<?= (!$currentUserStarred) ? '' : 'display:none'?>">
            <?php echo $btnStarText; ?>
        </a>

        <a href="#" data-action-click="star.toggleLike" data-action-url="<?= $unstarUrl ?>" class="btn <?= $btnClass ?>  unlike likeAnchor" style="<?= ($currentUserStarred) ? '' : 'display:none'?>">
            <?php echo $btnUnstarText; ?>
        </a>
    <?php endif; ?>

</span>