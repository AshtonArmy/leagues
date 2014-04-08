{extends file='_index.tpl'}

{block name="content-bar"}
<div class="btn-group">
        <a class="btn {if $sMode!='new'}active{/if}" href="{router page='admin'}newteams/all/">
            All teams
        </a>
        <a class="btn {if $sMode=='new'}active{/if}" href="{router page='admin'}newteams/new/">
            New Teams
        </a>
    </div>
    {*<div class="btn-group">
        <a href="{router page='admin'}newteamadd/" class="btn btn-primary"><i class="icon-plus-sign"></i></a>
    </div>*}
{/block}

{block name="content-body"}

<div class="span12">

    <div class="b-wbox">
        <div class="b-wbox-content nopadding">

            <table class="table table-striped table-condensed pages-list">
                <thead>
                <tr>
                    <th class="span1">ID</th>
                    <th>Name</th>
                    <th>Brief</th>
					<th>Status</th>
                    <th class="span2"></th>
                </tr>
                </thead>

                <tbody>
					{foreach $aTeams as $oTeam}
                    <tr>
                        <td>
                            {$oTeam->getTeamId()}
                        </td>
						<td>
                            {$oTeam->getName()|strip_tags|escape:'html'}
                        </td>
						<td>
                            {$oTeam->getBrief()|strip_tags|escape:'html'}
                        </td>
						<td>
                            {$oTeam->getStatus()|strip_tags|escape:'html'}
                        </td>
						<td class="center">
                            <a href="{router page='admin'}newteamedit/{$oTeam->getTeamId()}/"
                               title="edit" class="tip-top i-block">
                                <i class="icon-edit"></i>
                            </a>
                            {*<a href="#" title="{$aLang.plugin.seopack.seopack_admin_action_delete}" class="tip-top i-block"
                                  onclick="return admin.confirmDeleteNewTeam('{$oTeam->getTeamId()}', '{cfg name="path.root.web"}{$oTeam->getName()|strip_tags|escape:'html'}'); return false;">
                                <i class="icon-remove"></i>
                            </a>*}
                        </td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>

    {include file="inc.paging.tpl"}

</div>

<script>
    var admin = admin || { };

    admin.confirmDeleteNewTeam = function(id, title) {
        admin.confirm({
            header: 'Delete team',
            content: 'Are you sure whant delete team "' + title + '"',
            onConfirm: function() {
                document.location = "{router page='admin'}newteamdelete/" + id + "/?security_ls_key={$ALTO_SECURITY_KEY}";
            }
        })
    }
</script>

{/block}