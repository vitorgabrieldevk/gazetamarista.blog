<main id="site-corpo" class="main-error" data-class-body="static-header not-found" style="background-color: #ffffff;">
    <div class="bloco-error">
        <div class="uk-container">
            {if $displayexceptions}
                <section>
                    <h1>An error occurred</h1>
                    <h2>{$message}</h2>
                    <h3>Exception information:</h3>
                    <p>{$exception_message}</p>
                    <h3>Stack trace:</h3>
                    <pre>{$trace}</pre>
                    {if isset($extras)}
                        <h3>Extras:</h3>
                        <pre>{$extras}</pre>
                    {/if}
                    <h3>Request Parameters:</h3>
                    <pre>{$params}</pre>
                </section>
            {/if}
            <div class="uk-text-center uk-padding">
                <a href="{url('home')}">
                    {if $linguagem_tipo == "_en"}
                        <img src="common/default/images/404.png" alt="404 Page not found! We couldn't find that page on our server.">
                    {elseif $linguagem_tipo == "_es"}
                        <img src="common/default/images/404.png" alt="¡404 Pagina no encontrada! No pudimos encontrar esa página en nuestro servidor.">
                    {else}
                        <img src="common/default/images/404.png" alt="404 Página não encontrada! Não encontramos essa página em nosso sevidor.">
                    {/if}
                </a>
            </div>
        </div>
    </div>
</main>