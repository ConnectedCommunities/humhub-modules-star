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
?>
<?php if (count($userMessages) != 0) : ?>

    <?php
    foreach($userMessages as $userMessage) {

        $star = $userMessage;

        $objectModel = $star->object_model;
        $objectId = $star->object_id;

        $object = $objectModel::get($objectId);

        $star->starredItemClass = $object->starredItemClass;
        echo $star->getStarredItemWidget([
            'object' => $object,
            'star' => $star,
        ]);

    }
    ?>

<?php else: ?>
    <li class="placeholder"> <?php echo "No starred items." ?></li>
<?php endif; ?>