<nav role="navigation" aria-label="Paginação dos resultados">
    <ul class="uk-pagination uk-flex-center">
        {foreach $pagesInRange as $i}
            {if $i === $current}
                <li class="uk-active" aria-current="page" aria-label="Página atual, página {$i}">
                    <span>{$i}</span>
                </li>
            {else}
                <li>
                    <a href="{$this->url(['page' => $i])}" aria-label="Ir para página {$i}">{$i}</a>
                </li>
            {/if}
        {/foreach}
    </ul>
</nav>


{*<nav>*}
{*    <ul class="uk-pagination uk-flex-center" uk-scrollspy="cls: uk-animation-slide-right-medium; target: li; delay: 100">*}
{*        <li>*}
{*            <a href="#"><span uk-pagination-previous></span></a>*}
{*        </li>*}

{*        <li>*}
{*            <a href="#">1</a>*}
{*        </li>*}

{*        <li>*}
{*            <a href="#">2</a>*}
{*        </li>*}

{*        <li>*}
{*            <a href="#">3</a>*}
{*        </li>*}

{*        <li class="uk-active"><span>4</span></li>*}

{*        <li>*}
{*            <a href="#">5</a>*}
{*        </li>*}

{*        <li>*}
{*            <a href="#"><span uk-pagination-next></span></a>*}
{*        </li>*}
{*    </ul>*}
{*</nav>*}