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

/**
 * Shows a  preview of Star
 */
use yii\helpers\Html;
use humhub\widgets\TimeAgo;
use humhub\libs\Helpers;
use humhub\widgets\MarkdownView;

$source = $star->getSource();
?>
<li>
    <a href="http://192.168.99.100/index.php?r=notification%2Fentry&amp;id=4">
        <div class="media">

            <!-- show user image -->
            <img class="media-object img-rounded pull-left" data-src="holder.js/32x32" alt="32x32" style="width: 32px; height: 32px;" src="/uploads/profile_image/0180d85c-ad21-4cfb-b976-45eb39c2bc0b.jpg?m=1465343972">

            <!-- show space image -->

            <!-- show content -->
            <div class="media-body">
                <strong>Sara Schuster</strong> likes Comment "Nike – Just buy it. ".
                <br> <span class="time" title="Jun 7, 2016 - 11:59 PM">about an hour ago</span>
                <span class="label label-danger">New</span>            </div>

        </div>
    </a>
</li>