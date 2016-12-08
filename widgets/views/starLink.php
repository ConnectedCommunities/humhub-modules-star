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

humhub\modules\star\Assets::register($this);
?>

<div class="starLinkContainer" id="starLinkContainer_<?= $id ?>">

    <?php if (Yii::$app->user->isGuest): ?>
        <?php echo Html::a('Star', Yii::$app->user->loginUrl, array('data-target' => '#globalModal')); ?>
    <?php else: ?>
        <?php echo Html::a('<i class="fa fa-heart"></i>', $starUrl, ['style' => 'display:' . ((!$currentUserStarred) ? 'inline-block' : 'none'), 'class' => 'btn btn-default star starAnchor', 'data-objectId' => $id]); ?>
        <?php echo Html::a('<i class="fa fa-heart" style="color: red;"></i>', $unstarUrl, ['style' => 'display:' . (($currentUserStarred) ? 'inline-block' : 'none'), 'class' => 'btn btn-default unstar starAnchor', 'data-objectId' => $id]); ?>
    <?php endif; ?>

    <!-- We don't need to show the count for now -->
    <div style="display:none; visibility: hidden;">
        <?php if (count($stars) > 0) { ?>
            <!-- Create link to show all users, who liked this -->
            <a href="<?php echo $userListUrl; ?>" data-target="#globalModal"><span class="starCount tt" data-placement="top" data-toggle="tooltip"
                                                                                   title="<?= $title ?>"></span></a>
        <?php } else { ?>
            <span class="starCount"></span>
        <?php } ?>
    </div>

</div>

<script>
    $(function () {
        updateStarCounters($("#starLinkContainer_<?= $id ?>"), <?= count($stars); ?>);
        initLikeModule();

        // show Tooltips on elements inside the views, which have the class 'tt'
        $('.tt').tooltip({
            html: false,
            container: 'body'
        });

    });
</script>