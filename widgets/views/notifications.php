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
use yii\helpers\Url;
use humhub\modules\mail\Assets;

$this->registerjsVar('mail_loadMessageUrl', Url::to(['/mail/mail/show', 'id' => '-messageId-']));
$this->registerjsVar('mail_viewMessageUrl', Url::to(['/mail/mail/index', 'id' => '-messageId-']));

\humhub\modules\star\StarAsset::register($this);
?>
<div class="btn-group">
    <a href="#" id="icon-star-module" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-star"></i>
    </a>
    <span id="badge-count" style="display:none;" class="label label-danger label-notification">1</span>
    <ul id="dropdown-star-list" class="dropdown-menu">
    </ul>
</div>

<script type="text/javascript">

    /**
     * Refresh New Mail Message Count (Badge)
     */
    reloadInterval = 60000;
    setInterval(function () {
        jQuery.getJSON("<?php echo Url::to(['/mail/mail/get-new-message-count-json']); ?>", function (json) {
            setBadgeCount(parseInt(json.newMessages));
        });
    }, reloadInterval);

    setBadgeCount(<?php echo $badgeCount; ?>);


    /**
     * Sets current message count
     */
    function setBadgeCount(count) {
        // show or hide the badge for new messages
        if (count == 0) {
            $('#badge-count').css('display', 'none');
        } else {
            $('#badge-count').empty();
            $('#badge-count').append(count);
            $('#badge-count').fadeIn('fast');
        }
    }



    // open the messages menu
    $('#icon-star-module').click(function () {

        // remove all <li> entries from dropdown
        $('#dropdown-star-list').find('li').remove();
        $('#dropdown-star-list').find('ul').remove();

        // append title and loader to dropdown
        $('#dropdown-star-list').append('<li class="dropdown-header"><div class="arrow"></div><?php echo "Starred by you"; ?></li> <ul class="media-list"><li id="loader_messages"><div class="loader"></div></li></ul><li><div class="dropdown-footer"><a class="btn btn-default col-md-12" href="<?php echo Url::to(['/mail/mail/index']); ?>"><?php echo "View all"; ?></a></div></li>');

        $.ajax({
            'type': 'GET',
            'url': '<?php echo Url::to(['/star/default/notification-list']); ?>',
            'cache': false,
            'data': jQuery(this).parents("form").serialize(),
            'success': function (html) {
                jQuery("#loader_messages").replaceWith(html)
            }});
    })
</script>

