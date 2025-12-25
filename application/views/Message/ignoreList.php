<script type="text/javascript">
    window.addEvent('domready', function () {
        $$('.subNavi').each(function (element) {
            new Travian.Game.Menu(element);
        });
    });
</script>
<script>
    function messagesFormSelectAll(checkbox) {
        document.getElementById('messagesForm').getElements('input[type=checkbox]').each(function (element) {
            element.checked = checkbox.checked;
        }, checkbox);
    }
</script><script type="text/javascript">
    window.addEvent('domready', function () {
        "use strict";

        var renderIgnoreList = function () {
            Travian.ajax({
                data: {
                    cmd: 'ignoreList',
                    method: 'render_ignore_list'
                },

                onSuccess: function (response) {
                    if (response.result !== undefined) {
                        $$('#ignore-list').set('html', response.result);
                    }
                }
            });
        };

        renderIgnoreList();
    });

    var unignoreUser = function (targetPlayer) {
        Travian.ajax({
            data: {
                cmd: 'ignoreList',
                method: 'stop_ignore_target_player',
                renderIgnoreList: true,
                params: {
                    targetPlayer: targetPlayer
                }
            },

            onSuccess: function (response) {
                if ((response.error === undefined || !response.error) && response.result !== undefined) {
                    $$('#ignore-list').set('html', response.result);
                }
            }
        });

        return false;
    };
</script>

<div class="ignoreListContainer" id="ignore-list">
</div>