{if !aceitou_cookies()}
    <div id="cookies">
        <div>
            <p>{$translate['cookies']['usamos_cookies']} <a class="uk-text-underline uk-text-bold" data-fancybox {literal}data-options='{"baseClass":"modal-cookies", "touch":false}'{/literal} data-src="#modal-politica-privacidade" href="javascript:void(0);">{$translate['cookies']['politica_cookies']}</a> {$translate['cookies']['saber_cookies']} </p>
            <p>{$translate['cookies']['clicar_cookies']}</p>
            <div class="uk-text-right">
                <div class="uk-button aceitar-cookies" data-href="{url('cookies-aceitar')}">{$translate['cookies']['aceitar']}</div>
            </div>
        </div>
    </div>
{/if}
<div style="display:none;" id="modal-politica-privacidade">
    <div class="modal-header uk-flex uk-flex-center uk-flex-middle">
        <h1>{$translate['cookies']['politica_cookies']}</h1>
    </div>
    <div class="modal-conteudo">
        {$_configuracao->politica_cookie_texto{$linguagem_tipo}}
    </div>
    <div class="modal-footer uk-flex uk-flex-center uk-flex-middle">
        {if !aceitou_cookies()}
            <div class="uk-button aceitar-cookies aceitar-cookies-modal" data-href="{url('cookies-aceitar')}">{$translate['cookies']['aceitar']}</div>
        {/if}
    </div>
</div>