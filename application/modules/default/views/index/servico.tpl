<main id="site-corpo" class="main-servico">
    <section class="bloco-header">
        {assign var="banner_existe" value="common/uploads/servico/"|cat:$servico->banner_desktop}
        {if file_exists($banner_existe) && !empty($servico->banner_desktop)}
            {assign var="src" value=$this->url(['tipo'=>'servico', 'crop'=>'1', 'largura'=>1920, 'altura'=>615, 'imagem'=>$servico->banner_desktop], 'imagem', TRUE)}

            {assign var="banner_existe" value="common/uploads/servico/"|cat:$servico->banner_mobile}
            {if file_exists($banner_existe) && !empty($servico->banner_mobile)}
                {assign var="src_mobile" value=$this->url(['tipo'=>'servico', 'crop'=>'1', 'largura'=>520, 'altura'=>615, 'imagem'=>$servico->banner_mobile], 'imagem', TRUE)}
            {else}
                {assign var="src_mobile" value=$this->url(['tipo'=>'servico', 'crop'=>'1', 'largura'=>520, 'altura'=>615, 'imagem'=>$servico->banner_desktop], 'imagem', TRUE)}
            {/if}
            <div class="uk-cover-container">
                <img class="uk-visible@s" data-src="{$src}" data-width="1920" data-height="615" uk-img alt="{$servico->titulo{$linguagem_tipo}}" uk-cover>
                <img class="uk-hidden@s" data-src="{$src_mobile}" data-width="520" data-height="615" uk-img alt="{$servico->titulo{$linguagem_tipo}}" uk-cover>

                <div class="uk-container">
                    <div class="texto">
                        <h1>{$servico->titulo{$linguagem_tipo}}</h1>
                        {if $servico->titulo == 'Taxi aéreo'}
                          <p>{$translate['servicos']['texto01']}</p>
                          <p>{$translate['servicos']['texto02']}</p>
                        {/if}
                    </div>
                </div>
            </div>
        {/if}

        {if !empty($_configuracao->whatsapp)}
            <div class="bloco-contato-whatsapp">
                <figure>
                    <a class="segmento" href="https://wa.me/55{$_configuracao->whatsapp|replace:['(',')','+','-',' ']:''}"
                        target="_blank">
                        <img data-src="common/default/images/icons/whatsapp.png" alt="Whatsapp" uk-img />
                    </a>
                </figure>
            </div>
        {/if}
    </section>

    <section class="bloco-conteudo">
        <div class="uk-container uk-flex uk-flex-center uk-flex-middle uk-flex-column"
            uk-scrollspy="target: .conteudo; cls: uk-animation-slide-bottom-medium; delay: 200">
            {if !empty($servico->texto1{$linguagem_tipo})}<p>{$servico->texto1{$linguagem_tipo}}</p>{/if}

            {foreach from=$itens key="chave" item="row"}
                <div class="uk-flex {if $chave % 2 == 1}uk-flex-row-reverse{/if} uk-margin-large-bottom conteudo"
                    style="visibility: hidden;">
                    {assign var="servico_existe" value="common/uploads/servico/"|cat:$row->img}
                    {if file_exists($servico_existe) && !empty($row->img)}
                        <figure>
                            <img data-src="{$this->url(['tipo'=>'servico', 'crop'=>'1', 'largura'=>590, 'altura'=>360, 'imagem'=>$row->img], 'imagem', TRUE)}"
                                alt="{$row->item{$linguagem_tipo}}" uk-img />
                        </figure>
                    {/if}

                    <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
                        <h3>{$row->item{$linguagem_tipo}}</h3>
                        <p>{$row->descricao{$linguagem_tipo}}</p>
                    </div>
                </div>
            {/foreach}

            <div class="bloco-contato uk-text-center">
                {if !empty($servico->texto2{$linguagem_tipo})}<p>{$servico->texto2{$linguagem_tipo}}</p>{/if}

                <a href="{url('contato')}?assunto={$this->createslug($servico->titulo{$linguagem_tipo})}">
                    <button class="uk-button uk-button-third">{$translate['conteudo']['entrar_contato']}</button>
                </a>
            </div>
        </div>
    </section>
</main>