<main id="site-corpo" class="bloco-historia">
    <section class="bloco-header">
        {assign var="banner_existe" value="common/uploads/sobre/"|cat:$sobre->banner_desktop}
        {if file_exists($banner_existe) && !empty($sobre->banner_desktop)}
            {assign var="src" value=$this->url(['tipo'=>'sobre', 'crop'=>'1', 'largura'=>1920, 'altura'=>615, 'imagem'=>$sobre->banner_desktop], 'imagem', TRUE)}

            {assign var="banner_existe" value="common/uploads/sobre/"|cat:$servico->banner_mobile}
            {if file_exists($banner_existe) && !empty($sobre->banner_mobile)}
                {assign var="src_mobile" value=$this->url(['tipo'=>'sobre', 'crop'=>'1', 'largura'=>520, 'altura'=>615, 'imagem'=>$sobre->banner_mobile], 'imagem', TRUE)}
            {else}
                {assign var="src_mobile" value=$this->url(['tipo'=>'sobre', 'crop'=>'1', 'largura'=>520, 'altura'=>615, 'imagem'=>$sobre->banner_desktop], 'imagem', TRUE)}
            {/if}
            <div class="uk-cover-container">
                <img class="uk-visible@s" data-src="{$src}" data-width="1920" data-height="615" uk-img alt="{$translate['topo']['quemsomos']}" uk-cover>
                <img class="uk-hidden@s" data-src="{$src_mobile}" data-width="520" data-height="615" uk-img alt="{$translate['topo']['quemsomos']}" uk-cover>

                <div class="uk-container">
                    <div class="texto ">
                        <h1 class="uk-visible@s">{$translate['topo']['quemsomos']}</h1>

                        <p class="uk-visible@s">{$sobre->frase_banner{$linguagem_tipo}}</p>
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

    <section class="bloco-historia">
        <div class="header-mobile">
            <h1>{$translate['topo']['quemsomos']}</h1>

            <p>{$sobre->frase_banner{$linguagem_tipo}}</p>
        </div>

        <div class="uk-flex uk-flex-center">
            {assign var="imagem_existe" value="common/uploads/sobre/"|cat:$sobre->imagem_texto}
            {if file_exists($imagem_existe) && !empty($sobre->imagem_texto)}
                <figure>
                    <img data-src="{$this->url(['tipo'=>'sobre', 'crop'=>'1', 'largura'=>580, 'altura'=>670, 'imagem'=>$sobre->imagem_texto], 'imagem', TRUE)}" alt="{$translate['topo']['quemsomos']}" uk-img />
                </figure>
            {/if}

            <div class="uk-card uk-card-default uk-card-body uk-width-1-2">
                <div class="bloco-conteudo">
                    <h2>{$translate['topo']['quemsomos']|upper}</h2>

                    <p>{$sobre->historia_texto{$linguagem_tipo}}</p>

                    {if !empty($sobre->frase_inauguracao{$linguagem_tipo})}
                        <img class="linha-preta" data-src="common/default/images/icons/linha-preta.png" alt="{$sobre->frase_inauguracao{$linguagem_tipo}}" uk-img />
                        <div class="frase-inauguracao">{$sobre->frase_inauguracao{$linguagem_tipo}}</div>
                    {/if}
                </div>
            </div>
        </div>
    </section>

    <section class="bloco-missao-visao-valores">
        <div class="uk-container">
            <div class="slides tema-claro tipo-grid"
                {literal}data-slide='{"autoplay":{"delay":4000}, "watchOverflow":true, "spaceBetween":20, "slidesPerView": 1, "breakpoints":{"768":{"slidesPerView":2, "slidesPerGroup":2}, "960":{"slidesPerView":3, "slidesPerGroup":3}}}'
                {/literal} uk-scrollspy="cls: uk-animation-slide-bottom-medium;" style="visibility: hidden;">
                <div class="swiper-container">
                    <div class="swiper-wrapper" uk-height-match="target: .uk-card">
                        {if !empty($sobre->texto_visao{$linguagem_tipo})}
                            <div class="swiper-slide">
                                <div class="uk-card uk-card-default uk-card-body">
                                    <h2 class="uk-card-title">{$translate['historia']['visao']}</h2>

                                    <p>{$sobre->texto_visao{$linguagem_tipo}}</p>
                                </div>
                            </div>
                        {/if}

                        {if !empty($sobre->texto_missao{$linguagem_tipo})}
                            <div class="swiper-slide">
                                <div class="uk-card uk-card-default uk-card-body">
                                    <h2 class="uk-card-title">{$translate['historia']['missao']}</h2>

                                    <p>{$sobre->texto_missao{$linguagem_tipo}}</p>
                                </div>
                            </div>
                        {/if}

                        {if !empty($sobre->texto_valores{$linguagem_tipo})}
                            <div class="swiper-slide">
                                <div class="uk-card uk-card-default uk-card-body valores">
                                    <h2 class="uk-card-title">{$translate['historia']['valores']}</h2>

                                    <p>{$sobre->texto_valores{$linguagem_tipo}}</p>
                                </div>
                            </div>
                        {/if}
                    </div>

                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>

    {if $dna|count > 0}
        <section class="bloco-dna">
            <div class="uk-container">
                <div class="uk-width-expand@m">
                    <header class="titulo-pagina uk-text-center">
                        <h2>{$translate['historia']['dna']}</h2>
                    </header>
                </div>

                <div class="slides tema-claro tipo-grid"
                    {literal}data-slide='{"autoplay":{"delay":4000},"watchOverflow":true, "spaceBetween":20, "slidesPerView": 1, "breakpoints":{"768":{"slidesPerView":2, "slidesPerGroup":2}, "960":{"slidesPerView":4, "slidesPerGroup":4}}}'
                    {/literal} uk-scrollspy="cls: uk-animation-slide-bottom-medium;" style="visibility: hidden;">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            {foreach from=$dna item="row"}
                                <div class="swiper-slide">
                                    <div class="uk-card uk-card-default uk-card-body">
                                        <h2 class="uk-card-title">{$row->titulo{$linguagem_tipo}}</h2>
                                        <p>-<br>{$row->texto{$linguagem_tipo}}</p>
                                    </div>
                                </div>
                            {/foreach}
                        </div>

                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>

            <div class="uk-container">
                <div class="uk-grid-small uk-child-width-1-4@s uk-flex-center" uk-grid></div>
            </div>
        </section>
    {/if}

    <section class="bloco-atendimento">
        <div class="uk-flex uk-flex-center">
            {assign var="imagem_existe" value="common/uploads/sobre/"|cat:$sobre->comoatendemos_imagem}
            {if file_exists($imagem_existe) && !empty($sobre->comoatendemos_imagem)}
                <figure>
                    <img data-src="{$this->url(['tipo'=>'sobre', 'crop'=>'1', 'largura'=>580, 'altura'=>670, 'imagem'=>$sobre->comoatendemos_imagem], 'imagem', TRUE)}"
                         alt="{$translate['historia']['atendemos']}" uk-img />
                </figure>
            {/if}

            <div class="uk-card uk-card-default uk-card-body uk-width-1-2">
                <div class="bloco-conteudo">
                    <h2>{$translate['historia']['atendemos']}</h2>

                    <p>{$sobre->comoatendemos_texto{$linguagem_tipo}}</p>

                    {if !empty($sobre->comoatendemos_titulo_imagem{$linguagem_tipo})}
                        <img class="linha-branca" data-src="common/default/images/icons/linha-branca.png" alt="Linha branca" uk-img />
                        <div class="comoatendemos-titulo">{$sobre->comoatendemos_titulo_imagem{$linguagem_tipo}}</div>
                    {/if}
                </div>
            </div>
        </div>
    </section>

    <section class="bloco-servicos">
        <div class="uk-container">
            <div class="uk-text-center">
                <h2>{$translate['historia']['servicos']}</h2>
            </div>

            {if $_servicos|count > 0}
                {foreach from=$_servicos key="chaveMenu" item="menuServico"}
                    <div class="slides tema-claro tipo-grid"
                        {literal}data-slide='{"autoplay":{"delay":2000},"watchOverflow":true, "spaceBetween":20, "slidesPerView": 1, "breakpoints":{"768":{"slidesPerView":2, "slidesPerGroup":2}, "960":{"slidesPerView":3, "slidesPerGroup":3}}}'
                        {/literal} uk-scrollspy="cls: uk-animation-slide-bottom-medium;" style="visibility: hidden;">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                {foreach from=$_servicos key="chaveMenu" item="menuServico"}
                                    <div class="swiper-slide">
                                        <a class="item-servicos"
                                            href="{url('servico', ['idservico' => $menuServico->idservico, 'slug' => $menuServico->titulo{$linguagem_tipo}])}">
                                            <figure>
                                                <img data-src="{$this->url(['tipo'=>'servico', 'crop'=>'1', 'largura'=>380, 'altura'=>200, 'imagem'=>$menuServico->imagem|default:'null'], 'imagem', TRUE)}"
                                                    alt="{$menuServico->titulo{$linguagem_tipo}}" uk-img />
                                            </figure>

                                            <div class="uk-card">
                                                <p>{$menuServico->titulo{$linguagem_tipo}}</p>
                                            </div>
                                        </a>
                                    </div>
                                {/foreach}
                            </div>

                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                {/foreach}
            {/if}
        </div>
    </section>

    <section class="bloco-receber-novidades">
        <div class="uk-container">
            <form method="post" action="{url('ajax-newsletter')}" autocomplete="off" class="uk-flex uk-flex-middle" data-validate="ajax">
                <p>{$translate['conteudo']['receber_novidades']}</p>

                <div class="uk-margin">
                    <input type="email" name="email" class="uk-input" placeholder="{$translate['conteudo']['informe_email']}" required>
                </div>

                <button type="submit" class="uk-button uk-border-pill btn-enviar">{$translate['conteudo']['inscrever']}</button>
            </form>
        </div>
    </section>
</main>