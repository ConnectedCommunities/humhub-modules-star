/*
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
 * Inits the Like Module
 *
 * This function should executed after a new like link appears
 */
function initLikeModule() {

    // Remove Existing Handlers
    $('.starAnchor').off("click");

    // Handle Click on a Like Button
    $('.starAnchor').on("click", function (event) {
        event.preventDefault();

        var self = this;
        $.ajax({
            dataType: "json",
            type: 'POST',
            url: $(this).attr("href")
        }).done(function (data) {

            $(self).parent().find('.starAnchor').hide();

            if (data.currentUserLiked) {
                $(self).parent().find('.unstar').show();
            } else {
                $(self).parent().find('.star').show();
            }

            updateStarCounters(likeContainerDiv, data.starCounter);
        });

    });

}

/**
 * Updates the Like Counters
 *
 * This function will be called by ShowLikesWidget.
 *
 * @param {type} className
 * @param {type} id
 * @param {type} count
 * @returns {undefined}
 */
function updateStarCounters(element, count) {

    if (count != 0) {
        element.find(".starCount").show();
        element.find(".starCount").html('(' + count + ')');
    } else {
        element.find(".starCount").hide();
    }

}
