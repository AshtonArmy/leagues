{assign var='noSidebar' value=true}

{include file='header.tpl' menu='blog'}

<div id="mainpage">
    {*Слайдер и Таблица*}
    <div class="top-block">
        <ul class="colums">
            <li class="colum1">
                {include file='blocks.tpl' group='sliders'}
            </li>
            <li class="colum2">
                {include file='blocks.tpl' group='advertlist'}
            </li>
        </ul>
    </div>

    {*Видео и Новости и Прямой эфир*}
    <div class="center-block">
        <ul class="colums">
            <li class="colum1">
                {include file='blocks.tpl' group='videolist'}
            </li>
            <li class="colum2">
                {include file='blocks.tpl' group='newslist'}
            </li>
            <li class="colum3">
                {include file='blocks.tpl' group='stream'}
            </li>
        </ul>
    </div>

    {*Результаты игр*}
    <div class="bottom-block">
        {include file='blocks.tpl' group='matches'}
    </div>
</div>

{include file='footer.tpl'}