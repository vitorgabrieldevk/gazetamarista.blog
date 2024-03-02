<main id="site-corpo" class="main-noticias">
    <div class="noticias-container">
        <div class="uk-container">
            <div class="uk-grid uk-flex-middle page-header" uk-grid>
                <div class="uk-width-expand@m">
                    <header class="titulo-pagina">
                        <h1>{$translate['topo']['noticias']}</h1>
                    </header>
                </div>

                <div class="uk-width-1-1 uk-width-auto@m">
                    <form method="post" action="{url('noticias')}" autocomplete="off"
                        class="uk-position-relative form-busca {if !empty($termo)}busca-preenchida{/if}">
                        <input type="text" name="search" class="uk-input" placeholder="{$translate['noticias']['pesquisar']}" value="{$termo}" maxlength="100" required>
                        <button type="submit" class="uk-button uk-position-center-right icon-search-d btn-enviar"></button>
                        <a href="{url('noticias')}" class="uk-button btn-limpar icon-x-c"></a>
                    </form>
                </div>
            </div>
        </div>

        {if !empty($_configuracao->whatsapp)}
            <figure class="bloco-contato">
                <a class="segmento" href="https://wa.me/55{$_configuracao->whatsapp|replace:['(',')','+','-',' ']:''}" target="_blank">
                    <img data-src="common/default/images/icons/whatsapp.png" alt="Whatsapp" uk-img />
                </a>
            </figure>
        {/if}
    </div>

    <div class="uk-container conteudo">
        <div class="uk-grid" uk-grid>
            <article class="uk-width-expand@m coluna-conteudo">
                <div class="lista-itens"
                    uk-scrollspy="target: .lista-item; cls: uk-animation-slide-bottom-medium; delay: 200">
                    <div class="uk-grid uk-child-width-1-2@s uk-child-width-1-3@m conteudo-noticias" uk-grid>
                        {if $paginator->total_items > 0}
                            {foreach from=$paginator item="noticia"}
                                <div>
                                    <a class="lista-item" style="visibility: hidden;"
                                        href="{url('noticia', ['idnoticia'=>$noticia->idblog, 'slug'=>$this->createslug($noticia->titulo{$linguagem_tipo})])}">
                                        <figure>
                                            <img data-src="{$this->url(['tipo'=>'blog', 'crop'=>'1', 'largura'=>380, 'altura'=>280, 'imagem'=>$noticia->imagem|default:'null'], 'imagem', TRUE)}"
                                                alt="{$noticia->titulo{$linguagem_tipo}}" uk-img />
                                        </figure>

                                        {if !empty($noticia->tags{$linguagem_tipo})}
                                            {assign var="tags" value=","|explode:$noticia->tags{$linguagem_tipo}}
                                            {assign var="txt_tag" value=$tags[0]}
                                        {else}
                                            {assign var="txt_tag" value="Sync"}
                                        {/if}
                                        <div class="categoria">{$txt_tag}</div>
                                        <h3>{$noticia->titulo{$linguagem_tipo}}</h3>
                                        <div class="data">{$noticia->data|date_format:"%d/%m/%Y"}</div>

                                        <button class="uk-button uk-button-secondary uk-hidden@m">{$translate['noticias']['ler']} <i class="icon-arrow-b-right"></i></button>
                                    </a>
                                </div>
                            {/foreach}
                        {else}
                            <div class="uk-margin-medium-bottom uk-width-1-1">
                                <span class="uk-display-block uk-text-center uk-text-left@m">
                                    {if !empty($termo)}
                                        {$translate['noticias']['sem_busca']} "{$termo}"
                                    {else}
                                        {$translate['noticias']['inexistente']}
                                    {/if}
                                </span>
                            </div>
                        {/if}
                    </div>
                </div>

                {if $paginator->total_items > 12}
                    {$this->paginationControl($paginator, NULL, 'paginator-site.tpl')}
                {/if}
            </article>
        </div>
    </div>
</main>