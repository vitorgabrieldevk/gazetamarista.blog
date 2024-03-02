<main id="site-corpo" class="bloco-bases">
    <section class="uk-container">
        <div class="bloco-header">
            <h1>{$translate['bases']['nossas_bases']}</h1>
        </div>

        {if $arr_bases|count > 0}
            <div uk-scrollspy="target: .conteudo; cls: uk-animation-slide-bottom-medium; delay: 200">
                {foreach from=$arr_bases item="base"}
                    <div class="conteudo" style="visibility: hidden;">
                        <div class="uk-child-width-expand@s uk-flex-column" uk-grid>
                            <div class="bloco-base">
                                <div class="uk-card uk-card-default uk-flex uk-flex-between">
                                    <div class="uk-padding base-nome">
                                        <h2>{$base['base']["titulo$linguagem_tipo"]}</h2>

                                        <a class="uk-button uk-border-pill uk-button-third"
                                            href="{url('contato')}?assunto=agendar-atendimento&base={$this->createslug($base['base']["titulo$linguagem_tipo"])}">
                                            {$translate['bases']['agendar_atendimento']}
                                        </a>
                                    </div>

                                    <div class="bloco-informacoes uk-padding">
                                        <h2>{$base['base']["titulo$linguagem_tipo"]}</h2>

                                        {if !empty($base['base']['area_construida'])}
                                            <p>{$translate['bases']['area']} <br /> {$base['base']['area_construida']}</p>
                                        {/if}

                                        <p>{$base['base']["descricao$linguagem_tipo"]}</p>

                                        <a class="uk-button uk-border-pill uk-button-third"
                                            href="{url('contato')}?assunto=agendar-atendimento&base={$this->createslug($base['base']["titulo$linguagem_tipo"])}">
                                            {$translate['bases']['agendar_atendimento']}
                                        </a>
                                    </div>

                                    {assign var="imagem_existe" value="common/uploads/base/"|cat:$base['base']['imagem']}
                                    {if file_exists($imagem_existe) && !empty($base['base']['imagem'])}
                                        <figure>
                                            <img data-src="{$this->url(['tipo'=>'base', 'crop'=>'1', 'largura'=>480, 'altura'=>330, 'imagem'=>$base['base']['imagem']], 'imagem', TRUE)}"
                                                alt="{$base['base']["titulo$linguagem_tipo"]}" uk-img />
                                        </figure>
                                    {/if}
                                </div>
                            </div>

                            {if $base['facilidades']|count > 0}
                                <div class="bloco-facilidades">
                                    <div class="uk-card uk-card-default">
                                        <div class="uk-grid" uk-grid>
                                            <div class="uk-width-auto@s col-titulo">
                                                <h2>{$translate['bases']['facilidade']}{if $base['facilidades']|count > 1}s{/if}</h2>
                                            </div>

                                            <div class="uk-width-expand@s">
                                                <ul class="uk-grid uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>
                                                    {foreach from=$base['facilidades'] item="facilidade"}
                                                        <li>{$facilidade["item$linguagem_tipo"]}</li>
                                                    {/foreach}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {/if}

                            {if $base['servicos']|count > 0}
                                <div class="bloco-servicos">
                                    <div class="uk-card uk-card-default">
                                        <div class="uk-grid" uk-grid>
                                            <div class="uk-width-auto@s col-titulo">
                                                <h2>{$translate['bases']['servico']}{if $base['servicos']|count > 1}s{/if}</h2>
                                            </div>

                                            <div class="uk-width-expand@s">
                                                <ul class="uk-grid uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>
                                                    {foreach from=$base['servicos'] item="servico"}
                                                        <li>{$servico["item$linguagem_tipo"]}</li>
                                                    {/foreach}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {/if}
                        </div>
                    </div>
                {/foreach}
            </div>
        {else}
            <div class="uk-margin-medium-bottom uk-width-1-1">
                <span class="uk-display-block uk-text-center uk-text-left@m">{$translate['bases']['inexistente']}</span>
            </div>
        {/if}

        {if !empty($_configuracao->whatsapp)}
            <figure class="bloco-contato">
                <a class="segmento" href="https://wa.me/55{$_configuracao->whatsapp|replace:['(',')','+','-',' ']:''}" target="_blank">
                    <img data-src="common/default/images/icons/whatsapp.png" alt="Whatsapp" uk-img />
                </a>
            </figure>
        {/if}
    </section>
</main>