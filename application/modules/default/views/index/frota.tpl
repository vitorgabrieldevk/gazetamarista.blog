<main id="site-corpo" class="main-frota">
    <section class="bloco-header">
        {assign var="banner_existe" value="common/uploads/configuracao/"|cat:$_configuracao->frota_banner_desktop}
        {if file_exists($banner_existe) && !empty($_configuracao->frota_banner_desktop)}
            {assign var="src" value=$this->url(['tipo'=>'configuracao', 'crop'=>'1', 'largura'=>1920, 'altura'=>615, 'imagem'=>$_configuracao->frota_banner_desktop], 'imagem', TRUE)}

            {assign var="banner_existe" value="common/uploads/configuracao/"|cat:$_configuracao->frota_banner_mobile}
            {if file_exists($banner_existe) && !empty($_configuracao->frota_banner_mobile)}
                {assign var="src_mobile" value=$this->url(['tipo'=>'configuracao', 'crop'=>'1', 'largura'=>520, 'altura'=>615, 'imagem'=>$_configuracao->frota_banner_mobile], 'imagem', TRUE)}
            {else}
                {assign var="src_mobile" value=$this->url(['tipo'=>'configuracao', 'crop'=>'1', 'largura'=>520, 'altura'=>615, 'imagem'=>$_configuracao->frota_banner_desktop], 'imagem', TRUE)}
            {/if}
            <div class="uk-cover-container">
                <img class="uk-visible@s" data-src="{$src}" data-width="1920" data-height="615" uk-img alt="{$translate['frota']['nossa_frota']}" uk-cover>
                <img class="uk-hidden@s" data-src="{$src_mobile}" data-width="520" data-height="615" uk-img alt="{$translate['frota']['nossa_frota']}" uk-cover>

                <div class="uk-container">
                    <div class="texto">
                        <h1>{$translate['frota']['nossa_frota']}</h1>
                    </div>
                </div>
            </div>
        {/if}

        {if !empty($_configuracao->whatsapp)}
            <div class="bloco-contato-whatsapp">
                <figure>
                    <a class="segmento" href="https://wa.me/55{$_configuracao->whatsapp|replace:['(',')','+','-',' ']:''}" target="_blank">
                        <img data-src="common/default/images/icons/whatsapp.png" alt="Whatsapp" uk-img />
                    </a>
                </figure>
            </div>
        {/if}
    </section>

    <section class="bloco-conteudo">
        <div class="uk-container uk-flex uk-flex-center uk-flex-middle uk-flex-column"
            uk-scrollspy="target: .conteudo; cls: uk-animation-slide-bottom-medium; delay: 200">
            {foreach from=$avioes key="chave" item="row"}
                <a href="{url('frota-detalhe', ['idaviao' => $row->idaviao, 'slug' => $row->titulo{$linguagem_tipo}])}">
                    <div class="uk-flex {if $chave % 2 == 1}uk-flex-row-reverse{/if} uk-margin-large-bottom conteudo"
                        style="visibility: hidden;">
                        {assign var="imagem_existe" value="common/uploads/aviao/"|cat:$row->imagem}
                        {if file_exists($imagem_existe) && !empty($row->imagem)}
                            <figure>
                                <img data-src="{$this->url(['tipo'=>'aviao', 'crop'=>'1', 'largura'=>590, 'altura'=>360, 'imagem'=>$row->imagem], 'imagem', TRUE)}"
                                    alt="{$row->titulo{$linguagem_tipo}}" uk-img />
                            </figure>
                        {/if}

                        <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
                            <h3>{$row->titulo{$linguagem_tipo}}</h3>
                            <p>{$row->descricao{$linguagem_tipo}}</p>

                            <div class="item-detalhe">{$translate['conteudo']['mais_detalhes']}</div>
                        </div>
                    </div>
                </a>
            {/foreach}

            <div class="bloco-contato uk-text-center">
                {if !empty($_configuracao->frota_texto_tela{$linguagem_tipo})}
                    <p>{$_configuracao->frota_texto_tela{$linguagem_tipo}}</p>
                {/if}

                <a href="{url('contato')}?assunto=gestao-de-aeronaves">
                    <button class="uk-button uk-button-third">{$translate['conteudo']['entrar_contato']}</button>
                </a>
            </div>
        </div>
    </section>
</main>