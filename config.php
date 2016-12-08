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

return [
	'id' => 'star',
	'class' => 'humhub\modules\star\Module',
	'namespace' => 'humhub\modules\star',
	'events' => [
		[
			'class' => \humhub\widgets\NotificationArea::className(),
            'event' => \humhub\widgets\NotificationArea::EVENT_INIT,
            'callback' => ['humhub\modules\star\Events', 'onNotificationAddonInit']
        ],
		[
			'class' => humhub\modules\admin\widgets\AdminMenu::className(),
			'event' => humhub\modules\admin\widgets\AdminMenu::EVENT_INIT,
			'callback' => ['humhub\modules\star\Events', 'onAdminMenuInit']
		],
	],
];
?>

